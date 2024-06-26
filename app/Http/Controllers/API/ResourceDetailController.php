<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ResourceDetail;
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
     *     path="/api/resource-detail",
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
        $filter['equal']  = ['key'];
        $filter['search'] = ['name'];
        return $this->get_list_common($request, $this->model, $filter, []);
    }

    /**
     * @OA\Post(
     *     path="/api/resource-detail",
     *     tags={"Resource Detail"},
     *     summary="Store a newly created item",
     *     operationId="resource-detailStore",
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
     *                     example="dokter-tht",
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
        return $this->post_common($request, $this->model, $rules);
    }

    /**
     * @OA\Get(
     *     path="/api/resource-detail/{id}",
     *     tags={"Resource Detail"},
     *     summary="Display the specified item",
     *     operationId="resource-detailShow",
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
        return $this->get_single_common($id, $this->model);
    }

    /**
     * @OA\Post(
     *     path="/api/resource-detail/{id}",
     *     tags={"Resource Detail"},
     *     summary="Update the specified item",
     *     operationId="resource-detailUpdate",
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
     *                     example="dokter-tht-edited",
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
        return $this->put_common($request, $id, $this->model, $rules);

    }
    
    /**
     * @OA\Delete(
     *     path="/api/resource-detail/{id}",
     *     tags={"Resource Detail"},
     *     summary="Remove the specified item",
     *     operationId="resource-detailDestroy",
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
        return $this->delete_common($id, $this->model);
    }
}
