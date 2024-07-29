<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\User;
use OpenApi\Annotations as OA;

/**
 * Class AuthController.
 *
 * @author  Evelline <ev.attoff@gmail.com>
 */
class AuthController extends APIController
{

    /**
     * @OA\Post(
     *     path="/api/user/register",
     *     tags={"User Authentication"},
     *     summary="Register new user & get token",
     *     operationId="register",
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
     *         description="Request body description",
     *         @OA\JsonContent(
     *             ref="#/components/schemas/User",
     *             example={"name": "Augusta Ada Byron", "email": "ada.lovelace@gmail.com", "password": "Ba88a93$", "password_confirmation": "Ba88a93$123"}
     *         ),
     *     )
     * )
     */
    public function register(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
            ]);
            if ($validator->fails()) {
                throw new HttpException(400, $validator->messages()->first());
            }
            $request['password']        =   Hash::make($request['password']);
            $request['remember_token']  =   \Illuminate\Support\Str::random(10);
            $user       = User::create($request->toArray());
            $token      = $user->createToken('Laravel Password Grant Client')->accessToken; // string inside createToken is the token name
            return response()->json(
                array('name' => $request->name, 'email' => $request->get('email'), 'token' => $token), 
                200
            );
        } catch(\Exception $exception) {
            throw new HttpException(400, "Invalid data : {$exception->getMessage()}");
        }
    }

    /**
     * @OA\Post(
     *     path="/api/user/login",
     *     tags={"User Authentication"},
     *     summary="Log in to existing user & get token",
     *     operationId="login",
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful",
     *         @OA\JsonContent()
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Request body description",
     *         @OA\JsonContent(
     *             ref="#/components/schemas/User",
     *             example={"email": "ada.lovelace@gmail.com", "password": "Ba88a93$"}
     *         ),
     *     )
     * )
     */
    public function login(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:6',
            ]);
            if ($validator->fails()) {
                throw new HttpException(400, $validator->messages()->first());
            }
            $user = User::where('email', $request->email)->first();
            if ($user) {
                if (Hash::check($request->password, $user->password)) {
                    $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                    return response()->json(
                        array('data' => $user, 'token' => $token), 
                        200
                    );
                } else {
                    return response()->json(array('message' => 'Password mismatch'), 400);
                }
            } else {
                return response()->json(array('message' => 'User does not exist'), 400);
            }
        } catch(\Exception $exception) {
            throw new HttpException(400, "Invalid data : {$exception->getMessage()}");
        }
    }

    /**
     * @OA\Post(
     *     path="/api/user/logout",
     *     tags={"User Authentication"},
     *     summary="Log out & destroy self token",
     *     operationId="logout",
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful",
     *         @OA\JsonContent()
     *     ),
     *     security={{"passport_token_ready":{},"passport":{}}}
     * )
     */
    public function logout (Request $request) {
        try {
            $token = $request->user()->token();
            $token->revoke();
            return response()->json(array('message' => 'You have been successfully logged out!'), 200);
        } catch(\Exception $exception) {
            throw new HttpException(400, "Invalid data : {$exception->getMessage()}");
        }
    }

    // --------------------------------------START::Basic-API--------------------------------------
        protected $model = 'User';
        /**
         * @OA\Get(
         *     path="/api/user",
         *     tags={"User Authentication - CRUD"},
         *     summary="Display a listing of items",
         *     operationId="userIndex",
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
            $filter['search'] = ['name','email'];
            return $this->get_list_common($request, $this->model, $filter, []);
        }

        /**
         * @OA\Post(
         *     path="/api/user",
         *     tags={"User Authentication - CRUD"},
         *     summary="Store a newly created item",
         *     operationId="userStore",
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
         *                     property="name",
         *                     type="string",
         *                     example="Rhenald Kasali",
         *                 ),
         *                 @OA\Property(
         *                     property="email",
         *                     type="string",
         *                     example="rheinald@myorg.com",
         *                 ),
         *                 @OA\Property(
         *                     property="password",
         *                     type="string",
         *                     example="mypass123",
         *                 ),
         *                 @OA\Property(
         *                     property="password_confirmation",
         *                     type="string",
         *                     example="mypass123",
         *                 ),
         *                 required={"name","email","password"}
         *             )
         *         )
         *     ),
         *     security={{"passport_token_ready":{},"passport":{}}}
         * )
         */
        public function store(Request $request)
        {
            $rules = [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
            ];
            if($request->get('password') && strlen($request->get('password')) > 5){
                if($request->get('password') != $request->get('password_confirmation')){
                    return response()->json(array('message'=>"Konfirmasi password tidak sama"),400);
                }
            }else{
                return response()->json(array('message'=>"Password harus ada dan lebih dari 5 karakter"),400);
            }
            $request['password']        =   Hash::make($request['password']);
            $request['remember_token']  =   \Illuminate\Support\Str::random(10);
            return $this->post_common($request, $this->model, $rules, []);
        }

        /**
         * @OA\Get(
         *     path="/api/user/{id}",
         *     tags={"User Authentication - CRUD"},
         *     summary="Display the specified item",
         *     operationId="userShow",
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
         *     path="/api/user/{id}",
         *     tags={"User Authentication - CRUD"},
         *     summary="Update the specified item",
         *     operationId="userUpdate",
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
         *                     property="name",
         *                     type="string",
         *                     example="Rhenald Kasali",
         *                 ),
         *                 @OA\Property(
         *                     property="email",
         *                     type="string",
         *                     example="rheinald@myorg.com",
         *                 ),
         *                 @OA\Property(
         *                     property="password",
         *                     type="string",
         *                     example="mypass123",
         *                 ),
         *                 @OA\Property(
         *                     property="password_confirmation",
         *                     type="string",
         *                     example="mypass123",
         *                 ),
         *                 required={"name","email"}
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
                'email'  => 'required',
            ];
            if($request->get('password') && ($request->get('password') != $request->get('password_confirmation'))){
                return response()->json(array('message'=>"Konfirmasi password tidak sama"),400);
            }else if($request->get('password') == ''){
                unset($request['password']);
            }
            return $this->put_common($request, $id, $this->model, $rules, ['img_main']);

        }
        
        /**
         * @OA\Delete(
         *     path="/api/user/{id}",
         *     tags={"User Authentication - CRUD"},
         *     summary="Remove the specified item",
         *     operationId="userDestroy",
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
    // ----------------------------------------END::Basic-API--------------------------------------
}
