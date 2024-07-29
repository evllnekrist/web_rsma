<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use OpenApi\Annotations as OA;

/**
 * Class ResourceDetailController.
 *
 * @author  Evelline <ev.attoff@gmail.com>
 */
class ResourceDetailController extends APIController
{
    protected $model = 'ResourceDetail';
    /**
     * @OA\Get(
     *     path="/api/resourceDetail",
     *     tags={"Resource Detail"},
     *     summary="Display a listing of items",
     *     operationId="resourceDetailIndex",
     *     @OA\Response(
     *         response=200,
     *         description="successful",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Parameter(
     *         name="_page",
     *         in="query",
     *         description="current page",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *             example=1
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="_limit",
     *         in="query",
     *         description="max item in a page",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *             example=10
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="_search",
     *         in="query",
     *         description="word to search",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="_dir",
     *         in="query",
     *         description="order by direction",
     *         required=false,
     *         @OA\Schema(
     *             type="object",
     *         )
     *     ),
     * )
     */
    public function index(Request $request)
    {
        // $filter['equal']  = [];
        $filter['search'] = ['key','name','description'];
        return $this->get_list_common($request, $this->model, $filter, ['summary','schedule']);
    }

    /**
     * @OA\Post(
     *     path="/api/resourceDetail",
     *     tags={"Resource Detail"},
     *     summary="Store a newly created item",
     *     operationId="resourceDetailStore",
     *     @OA\MediaType(mediaType="multipart/form-data"),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful",
     *         @OA\JsonContent()
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="key",
     *                     type="string",
     *                     example="dokter-umum",
     *                 ),
     *                 @OA\Property(
     *                     property="name",
     *                     type="string",
     *                     example="Person 1",
     *                 ),
     *                 @OA\Property(
     *                     property="description",
     *                     type="string",
     *                     example=""
     *                 ),
     *                 @OA\Property(
     *                     property="link",
     *                     type="string",
     *                     example=""
     *                 ),
     *                 @OA\Property(
     *                     property="sequence",
     *                     type="integer",
     *                     example=""
     *                 ),
     *                 required={"name"}
     *             )
     *         )
     *     ),
     *     security={{"passport_token_ready":{},"passport":{}}}
     * )
     */
    public function store(Request $request)
    {
        $rules = [
            'name'  => 'required',
        ];
        return $this->post_common($request, $this->model, $rules,['img_main']);
    }

    /**
     * @OA\Get(
     *     path="/api/resourceDetail/{id}",
     *     tags={"Resource Detail"},
     *     summary="Display the specified item",
     *     operationId="resourceDetailShow",
     *     @OA\Response(
     *         response=404,
     *         description="Item not found",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Identifier of item that needs to be displayed",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     * )
     */
    public function show($id)
    {
        return $this->get_single_common($id, $this->model, ['schedule']);
    }

    /**
     * @OA\Post(
     *     path="/api/resourceDetail/{id}",
     *     tags={"Resource Detail"},
     *     summary="Update the specified item",
     *     operationId="resourceDetailUpdate",
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
     *                 @OA\Property(
     *                     property="key",
     *                     type="string",
     *                     example="dokter-umum-edited",
     *                 ),
     *                 @OA\Property(
     *                     property="name",
     *                     type="string",
     *                     example="[EDITED] Person 1",
     *                 ),
     *                 @OA\Property(
     *                     property="description",
     *                     type="string",
     *                     example=""
     *                 ),
     *                 @OA\Property(
     *                     property="link",
     *                     type="string",
     *                     example=""
     *                 ),
     *                 @OA\Property(
     *                     property="sequence",
     *                     type="integer",
     *                     example=""
     *                 ),
     *                 required={"name"}
     *             )
     *         )
     *     ),
     *     security={{"passport_token_ready":{},"passport":{}}}
     * )
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name'  => 'required',
        ];
        return $this->put_common($request, $id, $this->model, $rules, ['img_main']);

    }
    
    /**
     * @OA\Delete(
     *     path="/api/resourceDetail/{id}",
     *     tags={"Resource Detail"},
     *     summary="Remove the specified item",
     *     operationId="resourceDetailDestroy",
     *     @OA\Response(
     *         response=404,
     *         description="Item not found",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Identifier of item that needs to be removed",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     security={{"passport_token_ready":{},"passport":{}}}
     * )
     */
    public function destroy($id)
    {
        return $this->delete_common($id, $this->model, []);
    }

    /**
     * @OA\Post(
     *     path="/api/resourceDetail/schedule",
     *     tags={"Resource Detail"},
     *     summary="Update the specified item",
     *     operationId="resourceDetailUpdateSchedule",
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
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="ref_id",
     *                     type="number",
     *                     example=1,
     *                 ),
     *                 @OA\Property(
     *                     property="schedule",
     *                     type="object",
     *                     example={}
     *                 ),
     *                 required={"resource_id"}
     *             )
     *         )
     *     ),
     *     security={{"passport_token_ready":{},"passport":{}}}
     * )
     */
    public function updateSchedule(Request $request)
    {
        // return $request->all();
        $rules = [
            'ref_id'  => 'required',
        ];
        $validator = Validator::make($request->all(), $rules); 
        if ($validator->fails()) {
            // throw new HttpException(400, $validator->messages()->first());
            return response()->json(array('message'=>$validator->messages()->first()),400);
        }
        
        try {
            $model              = 'App\Models\ResourceDetailSchedule';
            $body               = $request->all();
            if(@$body['schedule']){
                $item_destroy       = $model::where('resource_id',$body['ref_id'])->delete();
                foreach ($body['schedule'] as $key => $value) {
                    for ($i=0; $i < sizeof($value['from']); $i++) { 
                        $item[$key][$i] = $model::create(array(
                            'resource_id'   => $body['ref_id'],
                            'day'           => $key,
                            'time_start'    => $value['from'][$i],
                            'time_end'      => $value['to'][$i],
                        ));
                    }
                }

                return response()->json(array('data'=>$item,'message'=>'Berhasil ditambahkan!'), 200);
            }else{
                return response()->json(array('data'=>[],'message'=>'Tidak ada jadwal'), 200);
            }
        } catch(\Exception $exception) {
            return response()->json(array('message'=>"Invalid data : {$exception->getMessage()}"),400);
        }
    }
}
