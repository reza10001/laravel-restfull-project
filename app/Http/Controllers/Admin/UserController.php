<?php

namespace App\Http\Controllers\Admin;

use App\Http\ApiRequest\Admin\User\UserStoreApiRequest;
use App\Http\ApiRequest\Admin\User\UserUpdateApiRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\User\UserDetailsApiResource;
use App\Http\Resources\Admin\User\UsersListApiResource;
use App\Models\User;
use App\RestfulApi\ApiResponse;
use App\RestfulApi\Facades\ApiResponse as FacadesApiResponse;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function __construct(private UserService $userService)
    {
        
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $result = $this->userService->getAllUsers($request->all());
        if(!$result->ok)
             return FacadesApiResponse::withMessage('Something is wrong. try again later')
            ->withStatus(500)->Build()->response();

         return FacadesApiResponse::withData(UsersListApiResource::collection($result->data)->resource)->build()->response();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreApiRequest $request)
    {

     
       $result = $this->userService->registerUser($request->validated());
       if(!$result->ok)
             return FacadesApiResponse::withMessage('Something is wrong. try again later')
             ->withStatus(500)->Build()->response();

        return FacadesApiResponse::withMessage('User created successfully')
        ->withData($result->data)->build()->response();
        
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $result = $this->userService->getUserInfo($user);
        if(!$result->ok)
             return FacadesApiResponse::withMessage('Something is wrong. try again later')
            ->withStatus(500)->Build()->response();
         return FacadesApiResponse::withData(new UserDetailsApiResource($result->data))->build()->response();
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateApiRequest $request, User $user)
    {
        try{
        $inputs = $request->validated();

        if(isset($inputs['password']))
             $inputs['password'] = Hash::make($inputs['password']);
            
        $user->update($inputs);      
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Something is wrong. try again later' 
            ],500);
        }
        return response()->json([
            'message' => 'User updated successfully',
            'data' => $user
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
          
      $user->delete();     
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Something is wrong. try again later' 
            ],500);
        }
        return response()->json([
            'message' => 'User deleted successfully'            
        ]);
    }

    private function apiResource($message=null, $data=null, $status=200){
        $body=[];
        !is_null($message) && $body['message']=$message;
        !is_null($data) && $body['data']=$data;
        return response()->json($body,$status);

    }
}
