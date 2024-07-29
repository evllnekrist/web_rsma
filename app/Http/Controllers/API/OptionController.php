<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Option;
use OpenApi\Annotations as OA;

/**
 * Class OptionController.
 *
 * @author  Evelline <ev.attoff@gmail.com>
 */
class OptionController extends APIController
{
    protected $model = 'Option';
    /**
     * @OA\Get(
     *     path="/api/option",
     *     tags={"Option"},
     *     summary="Display a listing of items",
     *     operationId="optionIndex",
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
        $filter['equal']  = ['type','value','value2'];
        $filter['search'] = ['label'];
        return $this->get_list_common($request, $this->model, $filter, []);
    }

    /**
     * @OA\Post(
     *     path="/api/option",
     *     tags={"Option"},
     *     summary="Store a newly created item",
     *     operationId="optionStore",
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
     *                     property="type",
     *                     type="string",
     *                     example="PAGE_LAYOUT_FORMAT",
     *                 ),
     *                 @OA\Property(
     *                     property="value",
     *                     type="string",
     *                     example="body",
     *                 ),
     *                 @OA\Property(
     *                     property="value2",
     *                     type="string",
     *                     example="",
     *                 ),
     *                 @OA\Property(
     *                     property="label",
     *                     type="string",
     *                     example="konten editor saja",
     *                 ),
     *                 @OA\Property(
     *                     property="description",
     *                     type="string",
     *                     example="",
     *                 ),
     *                 @OA\Property(
     *                     description="Image to upload",
     *                     property="img_main",
     *                     type="file",
     *                 ),
     *                 required={"type","value"}
     *             )
     *         )
     *     ),
     *     security={{"passport_token_ready":{},"passport":{}}}
     * )
     */
    public function store(Request $request)
    {
        $rules = [
            'type'  => 'required',
            'value'  => 'required',
        ];
        return $this->post_common($request, $this->model, $rules, ['img_main']);
    }

    /**
     * @OA\Get(
     *     path="/api/option/{id}",
     *     tags={"Option"},
     *     summary="Display the specified item",
     *     operationId="optionShow",
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
        return $this->get_single_common($id, $this->model, []);
    }

    /**
     * @OA\Post(
     *     path="/api/option/{id}",
     *     tags={"Option"},
     *     summary="Update the specified item",
     *     operationId="optionUpdate",
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
     *                     property="type",
     *                     type="string",
     *                     example="PAGE_LAYOUT_FORMAT_EDITED",
     *                 ),
     *                 @OA\Property(
     *                     property="value",
     *                     type="string",
     *                     example="body-edited",
     *                 ),
     *                 @OA\Property(
     *                     property="value2",
     *                     type="string",
     *                     example="",
     *                 ),
     *                 @OA\Property(
     *                     property="label",
     *                     type="string",
     *                     example="[EDITED] konten editor saja",
     *                 ),
     *                 @OA\Property(
     *                     property="description",
     *                     type="string",
     *                     example="",
     *                 ),
     *                 @OA\Property(
     *                     description="Image to upload",
     *                     property="img_main",
     *                     type="file",
     *                 ),
     *                 required={"type","value"}
     *             )
     *         )
     *     ),
     *     security={{"passport_token_ready":{},"passport":{}}}
     * )
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'type'  => 'required',
            'value'  => 'required',
        ];
        return $this->put_common($request, $id, $this->model, $rules, ['img_main']);

    }
    
    /**
     * @OA\Delete(
     *     path="/api/option/{id}",
     *     tags={"Option"},
     *     summary="Remove the specified item",
     *     operationId="optionDestroy",
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
}
