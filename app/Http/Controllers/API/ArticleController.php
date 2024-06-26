<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use OpenApi\Annotations as OA;

/**
 * Class ArticleController.
 *
 * @author  Evelline <evelline.kristiani@ukrida.ac.id>
 */
class ArticleController extends APIController
{
    protected $model = 'Article';
    /**
     * @OA\Get(
     *     path="/api/article",
     *     tags={"Article", "News"},
     *     summary="Display a listing of items",
     *     operationId="articleIndex",
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
        $filter['equal']  = ['id'];
        $filter['search'] = ['title','caption'];
        $filter['search_comma'] = ['keywords'];
        return $this->get_list_common($request, $this->model, $filter, []);
    }

    /**
     * @OA\Post(
     *     path="/api/article",
     *     tags={"Article", "News"},
     *     summary="Store a newly created item",
     *     operationId="articleStore",
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
     *                     property="portal_user_id",
     *                     type="integer",
     *                     example=""
     *                 ),
     *                 @OA\Property(
     *                     property="sequence",
     *                     type="integer",
     *                     example=""
     *                 ),
     *                 @OA\Property(
     *                     property="type",
     *                     type="string",
     *                     example="news",
     *                 ),
     *                 @OA\Property(
     *                     property="status",
     *                     type="string",
     *                     example="submited",
     *                 ),
     *                 @OA\Property(
     *                     property="slug",
     *                     type="string",
     *                     example="title-of-the-news",
     *                 ),
     *                 @OA\Property(
     *                     property="title",
     *                     type="string",
     *                     example="Title of The News",
     *                 ),
     *                 @OA\Property(
     *                     property="keywords",
     *                     type="string",
     *                     example="keyword,keyword2,keyword3"
     *                 ),
     *                 @OA\Property(
     *                     property="content",
     *                     type="string",
     *                     example="<p><i>`Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...`</i></p>"
     *                 ),
     *                 @OA\Property(
     *                     description="Image to upload",
     *                     property="img_main",
     *                     type="file",
     *                 ),
     *                 @OA\Property(
     *                     property="caption",
     *                     type="string",
     *                     example="here is the caption..."
     *                 ),
     *                 @OA\Property(
     *                     property="post_at",
     *                     type="string",
     *                     example="2024-06-28 08:00:00"
     *                 ),
     *                 @OA\Property(
     *                     property="publish_at",
     *                     type="string",
     *                     example="2024-06-28 08:00:00"
     *                 ),
     *                 required={"type","title"}
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
            'title'  => 'required|unique:articles',
        ];
        return $this->post_common($request, $this->model, $rules, ['img_main']);
    }

    /**
     * @OA\Get(
     *     path="/api/article/{id}",
     *     tags={"Article", "News"},
     *     summary="Display the specified item",
     *     operationId="articleShow",
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
     *     path="/api/article/{id}",
     *     tags={"Article", "News"},
     *     summary="Update the specified item",
     *     operationId="articleUpdate",
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
     *                     property="portal_user_id",
     *                     type="integer",
     *                     example=""
     *                 ),
     *                 @OA\Property(
     *                     property="sequence",
     *                     type="integer",
     *                     example=""
     *                 ),
     *                 @OA\Property(
     *                     property="type",
     *                     type="string",
     *                     example="news",
     *                 ),
     *                 @OA\Property(
     *                     property="status",
     *                     type="string",
     *                     example="submited",
     *                 ),
     *                 @OA\Property(
     *                     property="slug",
     *                     type="string",
     *                     example="title-of-the-news-edited",
     *                 ),
     *                 @OA\Property(
     *                     property="title",
     *                     type="string",
     *                     example="[EDITED] Title of The News",
     *                 ),
     *                 @OA\Property(
     *                     property="keywords",
     *                     type="string",
     *                     example="keyword,keyword2,keyword3,some-new-keyword-because-now-its-edited"
     *                 ),
     *                 @OA\Property(
     *                     property="content",
     *                     type="string",
     *                     example="<p>[EDITED]</p><p><i>`Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...`</i></p>"
     *                 ),
     *                 @OA\Property(
     *                     description="Image to upload",
     *                     property="img_main",
     *                     type="file",
     *                 ),
     *                 @OA\Property(
     *                     property="caption",
     *                     type="string",
     *                     example="[EDITED] here is the caption..."
     *                 ),
     *                 @OA\Property(
     *                     property="post_at",
     *                     type="string",
     *                     example="2024-06-28 08:00:00"
     *                 ),
     *                 @OA\Property(
     *                     property="publish_at",
     *                     type="string",
     *                     example="2024-06-28 08:00:00"
     *                 ),
     *                 required={"type","title"}
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
            'title'  => 'required|unique:articles',
        ];
        return $this->put_common($request, $id, $this->model, $rules, ['img_main']);

    }
    
    /**
     * @OA\Delete(
     *     path="/api/article/{id}",
     *     tags={"Article", "News"},
     *     summary="Remove the specified item",
     *     operationId="articleDestroy",
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
