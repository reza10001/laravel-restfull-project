<?php

namespace App\Services;

use App\Base\ServiceResult;
use App\Base\ServiceWrapper;
use App\Models\User;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\Facades\Hash;

class UserService{

    public function getAllUsers(array $inputs): ServiceResult{
        return app(ServiceWrapper::class)(function() use ($inputs){
            return User::paginate();
        });
    }
    public function getUserInfo(User $user){
        return app(ServiceWrapper::class)(function() use ($user){
            return $user;
        });
    }
    public function registerUser(array $inputs): ServiceResult{
        return app(ServiceWrapper::class)(function() use ($inputs){
            $inputs['password'] = Hash::make($inputs['password']);
            $user = User::create($inputs); 
        });
    }
}