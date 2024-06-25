<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *      version="1.0",
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
 *          name="Evelline UKRIDA",
 *          email="evelline.kristiani@ukrida.ac.id"
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
          if(isset($filter['equal_comma'])){ 
            foreach ($filter['equal_comma'] as $key => $value) {
              if(isset($data['filter']['_'.$value])){ 
                  $data['products'] = $data['products']->whereRaw($value." LIKE '%".$data['filter']['_'.$value]."%'");
              }
            }
          }
          if(isset($filter['search'])){
              if(isset($data['filter']['_search'])){
                  $query = "(";
                  for ($i=0; $i < sizeof($filter['search']); $i++) { 
                      $query .= "LOWER(".($filter['search'][$i]).") LIKE '%".strtolower($data['filter']['_search'])."%'";
                      if($i+1 < sizeof($filter['search'])){
                          $query .= " or ";
                      }
                  }
                  $query .= ')';
                  $data['products'] = $data['products']->whereRaw($query);
              }
          }
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

    public function post_common(Request $request, $model, $rules){
        try {
            $validator = Validator::make($request->all(), $rules); 
            if ($validator->fails()) {
                throw new HttpException(400, $validator->messages()->first());
            }
            $model  = 'App\Models\\'.$model;
            $body = $request->all();
            $body['created_by'] = \Auth::user()->id;
            $body['created_at'] = new \DateTime();
            $item = app($model)->create($body);
            return response()->json(array('data'=>$item,'message'=>'Created successfully'), 200);
        } catch(\Exception $exception) {
            throw new HttpException(400, "Invalid data : {$exception->getMessage()}");
        }
    }

    public function get_single_common($id, $model){
        $model  = 'App\Models\\'.$model;
        $item   = $model::where(app($model)->getKeyName(),$id)->first();
        if(!$item){
            throw new HttpException(404, 'Item not found');
        }
        return $item;
    }

    public function put_common(Request $request, $id, $model, $rules){
        $model  = 'App\Models\\'.$model;
        $item   = $model::where(app($model)->getKeyName(),$id)->first();
        if(!$item){
            throw new HttpException(404, 'Item not found');
        }

        try {
            $validator = Validator::make($request->all(), $rules); 
            if ($validator->fails()) {
                throw new HttpException(400, $validator->messages()->first());
            }
           $item->fill($request->all())->save();
           return response()->json(array('data'=>$item,'message'=>'Updated successfully'), 200);

        } catch(\Exception $exception) {
           throw new HttpException(400, "Invalid data : {$exception->getMessage()}");
        }
    }

    public function delete_common($id, $model){
        $model  = 'App\Models\\'.$model;
        $item   = $model::where(app($model)->getKeyName(),$id)->first();
        if(!$item){
            throw new HttpException(404, 'Item not found');
        }

        try {
            $item->delete();
            return response()->json(array('message'=>'Deleted successfully'), 200);

        } catch(\Exception $exception) {
            throw new HttpException(400, "Invalid data : {$exception->getMessage()}");
        }
    }
}
