<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Satisfaction;
use OpenApi\Annotations as OA;

/**
 * Class SatisfactionController.
 *
 * @author  Evelline <ev.attoff@gmail.com>
 */
class SatisfactionController extends APIController
{
    protected $model = 'Satisfaction';
    /**
     * @OA\Get(
     *     path="/api/satisfaction",
     *     tags={"Satisfaction"},
     *     summary="Display a listing of items",
     *     operationId="satisfactionIndex",
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
        // $filter['range']  = ['star'];
        $filter['equal']  = ['star'];
        $filter['search'] = ['name','title'];
        return $this->get_list_common($request, $this->model, $filter, []);
    }

    /**
     * @OA\Post(
     *     path="/api/satisfaction",
     *     tags={"Satisfaction"},
     *     summary="Store a newly created item",
     *     operationId="satisfactionStore",
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
     *                     property="star",
     *                     type="integer",
     *                     example=4,
     *                 ),
     *                 @OA\Property(
     *                     property="name",
     *                     type="string",
     *                     example="Nadjwa Shihab",
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string",
     *                     example="nadjwa172@narasi.co.id",
     *                 ),
     *                 @OA\Property(
     *                     property="title",
     *                     type="string",
     *                     example="Nice!"
     *                 ),
     *                 @OA\Property(
     *                     property="description",
     *                     type="string",
     *                     example="Saya suka pelayanannya cepat. Saya jalur tunai sih."
     *                 ),
     *                 required={"star"}
     *             )
     *         )
     *     ),
     *     security={{"passport_token_ready":{},"passport":{}}}
     * )
     */
    public function store(Request $request)
    {
        $rules = [
            'star'  => 'required',
        ];
        return $this->post_common($request, $this->model, $rules, []);
    }

    /**
     * @OA\Get(
     *     path="/api/satisfaction/{id}",
     *     tags={"Satisfaction"},
     *     summary="Display the specified item",
     *     operationId="satisfactionShow",
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
     *     path="/api/satisfaction/{id}",
     *     tags={"Satisfaction"},
     *     summary="Update the specified item",
     *     operationId="satisfactionUpdate",
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
     *                     property="star",
     *                     type="integer",
     *                     example=4,
     *                 ),
     *                 @OA\Property(
     *                     property="name",
     *                     type="string",
     *                     example="[EDITED] Nadjwa Shihab",
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string",
     *                     example="nadjwa172@narasi.co.id",
     *                 ),
     *                 @OA\Property(
     *                     property="title",
     *                     type="string",
     *                     example="[EDITED] Nice!"
     *                 ),
     *                 @OA\Property(
     *                     property="description",
     *                     type="string",
     *                     example="[EDITED] Saya suka pelayanannya cepat. Saya jalur tunai sih."
     *                 ),
     *                 required={"star"}
     *             )
     *         )
     *     ),
     *     security={{"passport_token_ready":{},"passport":{}}}
     * )
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'star'  => 'required',
        ];
        return $this->put_common($request, $id, $this->model, $rules);

    }
    
    /**
     * @OA\Delete(
     *     path="/api/satisfaction/{id}",
     *     tags={"Satisfaction"},
     *     summary="Remove the specified item",
     *     operationId="satisfactionDestroy",
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
