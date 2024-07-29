<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use OpenApi\Annotations as OA;

/**
 * Class PageController.
 *
 * @author  Evelline <ev.attoff@gmail.com>
 */
class PageController extends APIController
{
    protected $model = 'Page';
    /**
     * @OA\Get(
     *     path="/api/page",
     *     tags={"Page"},
     *     summary="Display a listing of items",
     *     operationId="pageIndex",
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
        $filter['search'] = ['slug','title','layout'];
        return $this->get_list_common($request, $this->model, $filter, []);
    }

    /**
     * @OA\Post(
     *     path="/api/page",
     *     tags={"Page"},
     *     summary="Store a newly created item",
     *     operationId="pageStore",
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
     *                     property="slug",
     *                     type="string",
     *                     example="clean-eating",
     *                 ),
     *                 @OA\Property(
     *                     property="title",
     *                     type="string",
     *                     example="Clean Eating",
     *                 ),
     *                 @OA\Property(
     *                     property="layout",
     *                     type="string",
     *                     example="img_body",
     *                 ),
     *                 @OA\Property(
     *                     description="Image to upload",
     *                     property="img_main",
     *                     type="file",
     *                 ),
     *                 @OA\Property(
     *                     description="File to upload",
     *                     property="file_main",
     *                     type="file",
     *                 ),
     *                 @OA\Property(
     *                     property="file_link",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="body",
     *                     type="string",
     *                     example="<p>Menjadi sehat adalah impian semua orang. Makanan yang selama ini kita pikir sehat ternyata belum tentu <i>`sehat`</i> bagi tubuh kita.</p>"
     *                 ),
     *                 required={"slug","title","layout"}
     *             )
     *         )
     *     ),
     *     security={{"passport_token_ready":{},"passport":{}}}
     * )
     */
    public function store(Request $request)
    {
        $rules = [
            'slug'  => 'required|unique:pages',
            'title'  => 'required|unique:pages',
            'layout'  => 'required',
        ];
        return $this->post_common($request, $this->model, $rules, ['img_main','file_main']);
    }

    /**
     * @OA\Get(
     *     path="/api/page/{id}",
     *     tags={"Page"},
     *     summary="Display the specified item",
     *     operationId="pageShow",
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
     *     path="/api/page/{id}",
     *     tags={"Page"},
     *     summary="Update the specified item",
     *     operationId="pageUpdate",
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
     *                     property="title",
     *                     type="string",
     *                     example="[EDITED] Clean Eating",
     *                 ),
     *                 @OA\Property(
     *                     property="layout",
     *                     type="string",
     *                     example="img_body",
     *                 ),
     *                 @OA\Property(
     *                     description="Image to upload",
     *                     property="img_main",
     *                     type="file",
     *                 ),
     *                 @OA\Property(
     *                     description="File to upload",
     *                     property="file_main",
     *                     type="file",
     *                 ),
     *                 @OA\Property(
     *                     property="file_link",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="body",
     *                     type="string",
     *                     example="<p>[EDITED]</p><p>Menjadi sehat adalah impian semua orang. Makanan yang selama ini kita pikir sehat ternyata belum tentu <i>`sehat`</i> bagi tubuh kita.</p>"
     *                 ),
     *                 required={"title","layout"}
     *             )
     *         )
     *     ),
     *     security={{"passport_token_ready":{},"passport":{}}}
     * )
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'title'  => 'required',
            'layout'  => 'required',
        ];
        return $this->put_common($request, $id, $this->model, $rules, ['img_main','file_main']);

    }
    
    /**
     * @OA\Delete(
     *     path="/api/page/{id}",
     *     tags={"Page"},
     *     summary="Remove the specified item",
     *     operationId="pageDestroy",
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
