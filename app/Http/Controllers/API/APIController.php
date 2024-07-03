<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
// use Symfony\Component\HttpKernel\Exception\HttpException;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *      version="VER 1.0",
 *      title="RS Mas Amsyar WEB API", 
 *      description="
 * > Footprint 1.0 (2024 June 25) `Developed along with the web frontend to be consumed by and also enabled integration with 3rd party API in the future`
 * > Footprint x (2024 xx xx) `this-is-footnote-format-please-continue-on-next-dev`",
 *      x={
 *          "logo": {
 *              "url": "https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Laravel.svg/985px-Laravel.svg.png"
 *          }
 *      },
 *      @OA\Contact(
 *          name="Evelline Krist.",
 *          email="ev.attoff@gmail.com"
 *      ),
 * )
 */
class APIController extends Controller
{
    public function get_list_common(Request $request, $model, $filter, $with){
      // return json_encode(\Auth::user());
      try {
        $data['filter']       = $request->all();
        $model                = 'App\Models\\'.$model;
        $page                 = $data['filter']['_page']  = (@$data['filter']['_page'] ? intval($data['filter']['_page']) : 1);
        $limit                = $data['filter']['_limit'] = (@$data['filter']['_limit'] ? intval($data['filter']['_limit']) : 1000);
        $offset               = ($page?($page-1)*$limit:0);
        $data['products']     = $model::with($with);
        
        if(!empty($filter)){ // check if there is filter/s
          if(isset($filter['equal'])){ // for the case of equal value
            foreach ($filter['equal'] as $key => $value) { // loop of the same case
              if(isset($data['filter']['_'.$value]) && $data['filter']['_'.$value]!="all"){ // check if filter have value
                  $data['products'] = $data['products']->where($value,'=',$data['filter']['_'.$value]);
              }
            }
          }
          if(isset($filter['search'])){
            foreach ($filter['search'] as $key => $value) {
              if(isset($data['filter']['_'.$value])){ 
                  $data['products'] = $data['products']->whereRaw("LOWER(".$value.") LIKE '%".strtolower($data['filter']['_'.$value])."%'");
              }
            }
          }
          // if(isset($filter['single_search'])){ // enable for db multi column single input search
          //     if(isset($data['filter']['_search'])){
          //         $query = "(";
          //         for ($i=0; $i < sizeof($filter['single_search']); $i++) { 
          //             $query .= "LOWER(".($filter['single_search'][$i]).") LIKE '%".strtolower($data['filter']['_search'])."%'";
          //             if($i+1 < sizeof($filter['single_search'])){
          //                 $query .= " or ";
          //             }
          //         }
          //         $query .= ')';
          //         $data['products'] = $data['products']->whereRaw($query);
          //     }
          // }
          if(isset($filter['search_jsonb'])){
              if(isset($data['filter']['_search'])){
                  $query = "("; $i = 0;
                  foreach ($filter['search_jsonb'] as $key => $value) {
                      $query .= "LOWER(".$key."->>'".$value."') LIKE '%".strtolower($data['filter']['_search'])."%'";
                      if($i+1 < sizeof($filter['search_jsonb'])){
                          $query .= " or ";
                      }$i++;
                  }
                  $query .= ')';
                  $data['products'] = $data['products']->orWhereRaw($query);
              }
          }
          if(isset($filter['permission']) && \Auth::user()->role_id != 1){
            for ($i=0; $i < sizeof($filter['permission']); $i++) { 
              $data['products'] = $data['products']->whereRaw("(".$filter['permission'][$i]." = 'public' OR (".$filter['permission'][$i]." = 'user_group' AND user_group_id = ".\Auth::user()->user_group_id."))");
              if($i+1 < sizeof($filter['permission'])){
                  $query .= " or ";
              }
            }
          }
          if(!empty($data['filter']['_dir'])){
            foreach ($data['filter']['_dir'] as $key => $value) {
              if($value){
                $data['products'] = $data['products']->orderBy($key,$value);
              }
            }
          }else{
            $data['products'] = $data['products']->orderBy(app($model)->getKeyName(),'desc');
          }
        }
      
        $data['products_count_total']   = $data['products']->count();
        $data['products']               = ($limit==0 && $offset==0)?$data['products']:$data['products']->limit($limit)->offset($offset);
        $data['products_raw_sql']       = $data['products']->toSql();
        $data['products']               = $data['products']->get();
        $data['products_count_start']   = ($data['products_count_total'] == 0 ? 0 : (($page-1)*$limit)+1);
        $data['products_count_end']     = ($data['products_count_total'] == 0 ? 0 : (($page-1)*$limit)+sizeof($data['products']));
        return json_encode(array('status'=>true, 'message'=>'Berhasil mengambil data', 'data'=>$data));
      } catch (Exception $e) {
        return json_encode(array('status'=>false, 'message'=>$e->getMessage(), 'data'=>null));
      }
    }

    public function post_common(Request $request, $model, $rules, $file_indexes){
        try {
            $validator = Validator::make($request->all(), $rules); 
            if ($validator->fails()) {
                // throw new HttpException(400, $validator->messages()->first());
                return response()->json(array('message'=>$validator->messages()->first()),400);
            }
            $default_folder     = strtolower($model);
            $model              = 'App\Models\\'.$model;
            $body               = $request->all();
            foreach (array_map('gettype', $body) as $key => $value) { // to find explodes value to be imploded before further action
              if($value == 'array'){
                $body[$key] = implode(',',$body[$key]);
              }
            }
            // dump($body);return;
            $body['created_by'] = \Auth::user()->id;
            $body['created_at'] = new \DateTime();
            $item2              = null;
            $item               = app($model)->create($body);
            $pk                 = app($model)->getKeyName();
            if($pk != 'id'){ 
                $id = $request->get($pk);
            }else{
                $id = $item->$pk;
            }
            
            if(!empty($file_indexes)){
                if($request->file($file_indexes[0])){
                  $body2          = array();
                }
                foreach($file_indexes as $index){ // https://laracasts.com/discuss/channels/laravel/how-direct-upload-file-in-storage-folder
                  if($request->file($index)){
                    $filename_with_ext = $request->file($index)->getClientOriginalName(); // Get filename with the extension
                    $filename = pathinfo($filename_with_ext, PATHINFO_FILENAME); // Get just filename
                    $extension = $request->file($index)->getClientOriginalExtension(); // Get just ext
                    $filename_to_store = $id.'-'.$index.'.'.$extension;
                    $path = $request->file($index)->storeAs('public/'.$default_folder,$filename_to_store); // Upload Image
                    $body2[$index] = '/storage/'.$default_folder.'/'.$filename_to_store;
                  }
                }
                if($request->file($file_indexes[0])){
                  $item2          = $model::where($pk,$id)->first();
                  $item2->fill($body2)->save();
                }
            }

            return response()->json(array('data'=>($item2?$item2:$item),'message'=>'Berhasil ditambahkan!'), 200);
        } catch(\Exception $exception) {
            // throw new HttpException(400, "Invalid data : {$exception->getMessage()}");
            return response()->json(array('message'=>"Invalid data : {$exception->getMessage()}"),400);
        }
    }

    public function get_single_common($id, $model){
        $model  = 'App\Models\\'.$model;
        $item   = $model::where(app($model)->getKeyName(),$id)->first();
        if(!$item){
            // throw new HttpException(404, 'Item tidak ditemukan');
            return response()->json(array('message'=>'Item tidak ditemukan'),404);
        }
        return $item;
    }

    public function put_common(Request $request, $id, $model, $rules, $file_indexes){
        $default_folder     = strtolower($model);
        $model              = 'App\Models\\'.$model;
        $item               = $model::where(app($model)->getKeyName(),$id)->first();
        if(!$item){
            return response()->json(array('message'=>'Item tidak ditemukan'),404);
        }
        // dd($request->all());
        try {
            $body               = $request->all();
            foreach (array_map('gettype', $body) as $key => $value) { // to find explodes value to be imploded before further action
              if($value == 'array'){
                $body[$key] = implode(',',$body[$key]);
              }
            }
            // dump($body);return;
            $validator = Validator::make($body, $rules); 
            if ($validator->fails()) {
                return response()->json(array('message'=>$validator->messages()->first()),400);
            }
            $body['updated_by'] = \Auth::user()->id;
            $body['updated_at'] = new \DateTime();

            if(!empty($file_indexes)){
                foreach($file_indexes as $index){ // https://laracasts.com/discuss/channels/laravel/how-direct-upload-file-in-storage-folder
                  if($request->file($index)){
                    $filename_with_ext = $request->file($index)->getClientOriginalName(); // Get filename with the extension
                    $filename = pathinfo($filename_with_ext, PATHINFO_FILENAME); // Get just filename
                    $extension = $request->file($index)->getClientOriginalExtension(); // Get just ext
                    $filename_to_store = $id.'-'.$index.'.'.$extension;
                    $path = $request->file($index)->storeAs('public/'.$default_folder,$filename_to_store); // Upload Image
                    $body[$index] = '/storage/'.$default_folder.'/'.$filename_to_store;
                  }
                }
            }
            $item->fill($body)->save();
            return response()->json(array('data'=>$item,'message'=>'Berhasil diubah!'), 200);

        } catch(\Exception $exception) {
          return response()->json(array('message'=>"Invalid data : {$exception->getMessage()}"),400);
        }
    }

    public function delete_common($id, $model){
        $model  = 'App\Models\\'.$model;
        $item   = $model::where(app($model)->getKeyName(),$id)->first();
        if(!$item){
            return response()->json(array('message'=>'Item tidak ditemukan'),404);
        }

        try {
            $item->deleted_by = \Auth::user()->id;
            $item->save();
            $item->delete();
            return response()->json(array('message'=>'Berhasil dihapus!'), 200);

        } catch(\Exception $exception) {
          return response()->json(array('message'=>"Invalid data : {$exception->getMessage()}"),400);
        }
    }
}
