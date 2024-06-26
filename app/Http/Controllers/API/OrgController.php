<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Org;
use OpenApi\Annotations as OA;

/**
 * Class OrgController.
 *
 * @author  Evelline <ev.attoff@gmail.com>
 */
class OrgController extends APIController
{
    protected $model = 'Org';
    /**
     * @OA\Get(
     *     path="/api/org",
     *     tags={"Organizational Structure"},
     *     summary="Display a listing of items",
     *     operationId="orgIndex",
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
        $filter['search'] = ['name','job_title'];
        return $this->get_list_common($request, $this->model, $filter, []);
    }

    /**
     * @OA\Post(
     *     path="/api/org",
     *     tags={"Organizational Structure"},
     *     summary="Store a newly created item",
     *     operationId="orgStore",
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
     *                     property="parent_id",
     *                     type="integer",
     *                 ),
     *                 @OA\Property(
     *                     property="name",
     *                     type="string",
     *                     example="Rhenald Kasali",
     *                 ),
     *                 @OA\Property(
     *                     property="job_title",
     *                     type="string",
     *                     example="Head of ABC",
     *                 ),
     *                 @OA\Property(
     *                     description="Image to upload",
     *                     property="img_main",
     *                     type="file",
     *                 ),
     *                 @OA\Property(
     *                     property="desc_title",
     *                     type="string",
     *                     example="<b>The Desc Title</b>"
     *                 ),
     *                 @OA\Property(
     *                     property="desc_body",
     *                     type="string",
     *                     example="<p><i>`Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...`</i></p>"
     *                 ),
     *                 required={"job_title"}
     *             )
     *         )
     *     ),
     *     security={{"passport_token_ready":{},"passport":{}}}
     * )
     */
    public function store(Request $request)
    {
        $rules = [
            'job_title'  => 'required|unique:orgs',
        ];
        return $this->post_common($request, $this->model, $rules, ['img_main']);
    }

    /**
     * @OA\Get(
     *     path="/api/org/{id}",
     *     tags={"Organizational Structure"},
     *     summary="Display the specified item",
     *     operationId="orgShow",
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
     *     path="/api/org/{id}",
     *     tags={"Organizational Structure"},
     *     summary="Update the specified item",
     *     operationId="orgUpdate",
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
     *                     property="parent_id",
     *                     type="integer",
     *                 ),
     *                 @OA\Property(
     *                     property="name",
     *                     type="string",
     *                     example="[EDITED] Rhenald Kasali",
     *                 ),
     *                 @OA\Property(
     *                     property="job_title",
     *                     type="string",
     *                     example="[EDITED] Head of ABC",
     *                 ),
     *                 @OA\Property(
     *                     description="Image to upload",
     *                     property="img_main",
     *                     type="file",
     *                 ),
     *                 @OA\Property(
     *                     property="desc_title",
     *                     type="string",
     *                     example="<b>[EDITED] The Desc Title</b>"
     *                 ),
     *                 @OA\Property(
     *                     property="desc_body",
     *                     type="string",
     *                     example="<p>[EDITED]</p><p><i>`Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...`</i></p>"
     *                 ),
     *                 required={"job_title"}
     *             )
     *         )
     *     ),
     *     security={{"passport_token_ready":{},"passport":{}}}
     * )
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'job_title'  => 'required|unique:orgs',
        ];
        return $this->put_common($request, $id, $this->model, $rules, ['img_main']);

    }
    
    /**
     * @OA\Delete(
     *     path="/api/org/{id}",
     *     tags={"Organizational Structure"},
     *     summary="Remove the specified item",
     *     operationId="orgDestroy",
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
