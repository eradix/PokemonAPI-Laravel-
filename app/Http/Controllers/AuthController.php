<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(LoginUserRequest $request){

        # validate login request
        $request->validated($request->all());

        # check credentials
        if(!Auth::attempt($request->only(['email', 'password']))){
            return $this->error('', 'Credentials do not match', 401);
        }

        # fetch the user
        $user = User::where('email', $request->email)->first();

        return $this->success([
            'user' => $user,
            'token' => $user->createToken("API token of {$user->name}")->plainTextToken
        ]);
    }

    public function register(StoreUserRequest $request) {

        # validate user request
        $request->validated($request->all());

        # create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return $this->success([
            'user' => $user,
            'token' => $user->createToken("API token of {$user->name}")->plainTextToken
        ]);
    }

    public function logout(Request $request){
        // Auth::user()->currentAccessToken()->delete();
        // delete current user token
        $request->user()->currentAccessToken()->delete();

        return $this->success([
            'message' => 'You have successfully logged out and your api token has been deleted.'
        ]);
    }
}
