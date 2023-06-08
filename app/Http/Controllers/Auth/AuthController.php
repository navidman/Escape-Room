<?php

namespace App\Http\Controllers\Auth;

use App\Facades\AuthFacade;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => ['required', 'string', 'min:3', 'max:90'],
            'password' => ['required', 'min:8', 'max:90'],
        ]);
        if ($validator->fails()) {
            return response($validator->errors(), Response::HTTP_BAD_REQUEST);
        }
        $user = User::where('username', $request->username)->first();
        if (!$user) {
            $validator->errors()->add('username', 'Username does not found!');
            return response($validator->errors(), Response::HTTP_BAD_REQUEST);
        }
        if (!config('app.debug') or $user->checkPassword($request->password)) {
            try {
                $tokenInfo = AuthFacade::token($user, $request);
                return response($tokenInfo, Response::HTTP_OK);
            } catch (\Throwable $throwable) {
                report($throwable);
                return response('Internal server error!', Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        } else {
            $validator->errors()->add('code', 'Password is incorrect!');
            return response($validator->errors(), Response::HTTP_UNAUTHORIZED);
        }
    }

    public function revoke(Request $request)
    {
        try {
            AuthFacade::revoke($request);
            return response('Successfully logged out!', Response::HTTP_OK);
        } catch (\Throwable $throwable) {
            report($throwable);
        }
    }
}
