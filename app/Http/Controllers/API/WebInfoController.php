<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Option;
use OpenApi\Annotations as OA;

/**
 * Class WebInfoController.
 *
 * @author  Evelline <ev.attoff@gmail.com>
 */
class WebInfoController extends APIController
{
    protected $model = 'Option';
    protected $payload = array(
        'one_liner'     => array('desc'=>array('idx'=>'description','type'=>'WEB_DESC'),
                                'contact_phone'=>array('idx'=>'value','type'=>'WEB_CONTACT_PHONE'),
                                'contact_email'=>array('idx'=>'value','type'=>'WEB_CONTACT_EMAIL'),
                                'contact_address'=>array('idx'=>'description','type'=>'WEB_CONTACT_ADDRESS'),
                                'socmed_fb'=>array('idx'=>'value','type'=>'WEB_SOCMED_FB'),
                                'socmed_twitter'=>array('idx'=>'value','type'=>'WEB_SOCMED_TWITTER'),
                                'socmed_ig'=>array('idx'=>'value','type'=>'WEB_SOCMED_IG')),
        'array_to_json' => array('schedule'=>array('idx'=>'description','type'=>'WEB_SCHEDULE')),
        'single_image'  => array('logo'=>array('idx'=>'img_main','type'=>'WEB_LOGO')),
        'multi_image'   => array('related_links'=>array('idx'=>'img_main','type'=>'WEB_RELINK'),'sliders'=>array('idx'=>'img_main','type'=>'WEB_SLIDER_CONTENT'))
    );

    /**
     * @OA\Post(
     *     path="/api/web-info/manage",
     *     tags={"WebInfo"},
     *     summary="Update the specified item",
     *     operationId="WebInfoUpdate",
     *     @OA\MediaType(mediaType="multipart/form-data"),
     *     @OA\Response(
     *         response=404,
     *         description="Item not found",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="invalid input",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Identifier of item that needs to be updated",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             example="clean-eating"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *             )
     *         )
     *     ),
     *     security={{"passport_token_ready":{},"passport":{}}}
     * )
     */

    public function update(Request $request)
    {
        $default_folder     = strtolower($this->model);
        $data               = $request->all();
        DB::beginTransaction();
        // try {
            
            $body['updated_by'] = \Auth::user()?\Auth::user()->id:'unknown';
            $body['updated_at'] = new \DateTime();
            $item = array();
            // echo "ALL";
            // dump($data);
            // echo "<hr>";
            foreach ($this->payload['one_liner'] as $key => $value) {
                $item[$key] = Option::where('type',$value['type'])->update([$value['idx']=>$data[$key]]);
                // echo "ONE LINER";
                // dump($value);
                // dump($data[$key]);
                // echo "<hr>";
            }
            foreach ($this->payload['array_to_json'] as $key => $value) {
                $item[$key] = Option::where('type',$value['type'])->update([$value['idx']=>json_encode($data[$key])]);
                // echo "ARRAY TO JSON";
                // dump($value);
                // dump($data[$key]);
                // echo "<hr>";
            }

            foreach($this->payload['single_image'] as $key => $value){
                // echo "SINGLE IMAGE";
                // dump($value);
                // echo '<br>>>>>value BFR';// dump(@$data[$key]);
                $index_img = $key.'.img_main';
                if($request->file($index_img)){
                    // echo '<br>>>>>>>exist';
                    $filename_with_ext = $request->file($index_img)->getClientOriginalName(); // Get filename with the extension
                    $filename = pathinfo($filename_with_ext, PATHINFO_FILENAME); // Get just filename
                    $extension = $request->file($index_img)->getClientOriginalExtension(); // Get just ext
                    $filename_to_store = $key.'-img_main'.'.'.$extension;// date('Ymd-His')
                    $path = $request->file($index_img)->storeAs('public/'.$default_folder,$filename_to_store); // Upload Image
                    $data[$key]['img_main'] = '/storage/'.$default_folder.'/'.$filename_to_store;
                    $item[$key][$key2] = Option::where('type',$value['type'])->update($data[$key]);
                }
                // echo '<br>>>>>value AFTER';// dump(@$data[$key]);
                // echo "<hr>";
            }

            foreach($this->payload['multi_image'] as $key => $value){
                // echo "MULTI IMAGE";
                // dump($value);
                $multi_image_id_exist = array();
                foreach($data[$key] as $key2 => $value2){ 
                    // echo '<br>>>INSPECTING '.$key.' - '.$key2;
                    // echo '<br>>>>>value BFR';// dump($value2);
                    $index_img = $key.'.'.$key2.'.img_main';
                    if($request->file($index_img)){
                        // echo '<br>>>>>>>exist';
                        $filename_with_ext = $request->file($index_img)->getClientOriginalName(); // Get filename with the extension
                        $filename = pathinfo($filename_with_ext, PATHINFO_FILENAME); // Get just filename
                        $extension = $request->file($index_img)->getClientOriginalExtension(); // Get just ext
                        $filename_to_store = $key.'-'.$key2.'-img_main'.'.'.$extension;// date('Ymd-His')
                        $path = $request->file($index_img)->storeAs('public/'.$default_folder,$filename_to_store); // Upload Image
                        $value2['img_main'] = '/storage/'.$default_folder.'/'.$filename_to_store;
                    }
                    // echo '<br>>>>>value AFTER';// dump($value2);
                    // NOW
                    if(@$value2['id']){
                        array_push($multi_image_id_exist,$value2['id']);
                        $item[$key][$key2] = Option::where('type',$value['type'])->where('id',$value2['id'])
                                                    ->update($value2);
                    }else{
                        $value2['type'] = $value['type'];
                        $item[$key][$key2] = Option::create($value2);
                        array_push($multi_image_id_exist,$item[$key][$key2]['id']);
                    }
                }
                // DELETED
                // echo "MULTI IMAGE (DELETED)"; 
                // dump($multi_image_id_exist);
                $item[$key]['destroyed'] = Option::where('type',$value['type'])->whereNotIn('id', $multi_image_id_exist)->delete();
                // echo "<hr>";
            }
            $item['update_time'] = Option::where('type','WEB_INFO_UPDATE')->update(['value'=>time()]);
            DB::commit();
            return response()->json(array('data'=>$item,'message'=>'Berhasil diubah!'), 200);

        // } catch(\Exception $exception) {
        //     DB::rollBack();
        //     return response()->json(array('message'=>"Invalid data : {$exception->getMessage()}"),400);
        // }
    }
}
