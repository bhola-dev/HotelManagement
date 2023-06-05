<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use App\Traits\HMResponse;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use HMResponse;

    public function user(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = auth()->user();
        $response['user'] = $user;
        return response()->json($response);
    }

    public function login(Request $request): \Illuminate\Http\JsonResponse | Response
    {
        $validation = Validator::make($request->all(), [
            'email' => ['required', 'exists:users,email'],
            'password' => ['required', 'string', 'min:6']
        ]);

        if ($validation->fails()) {
            return $this->validationError($validation->errors()->first());
        }

        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken("HM-Application");
                return response()->json(array('token' => $token->plainTextToken));
            }
        }
    }

    public function logout(Request $request): Response
    {
        $user = $request->user();
        // Revoke all tokens...
        $user->tokens()->delete();

        // Revoke the token that was used to authenticate the current request...
        //$request->user()->currentAccessToken()->delete();
        return $this->success("Logout successful");
    }
}
