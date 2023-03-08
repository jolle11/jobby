<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
	public function register(RegisterRequest $request)
	{
		$data = $request->validated();

		/** @var \App\Models\User $user */
		$user = User::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
		]);

		$token = $user->createToken('main')->plainTextToken;

		return response(compact('user', 'token'));
	}

	public function login(LoginRequest $request)
	{
		$credentials = $request->validated();

		if (!Auth::attempt($credentials)) {
			return response(['message' => 'Provided email address or password is incorrect'], 422);
		}

		/** @var User $user */
		$user = Auth::user();
		$token = $user->createToken('main')->plainTextToken;
		return response(compact('user', 'token'));
	}


	public function logout(Request $request)
	{
		/** @var \App\Models\User $user */
		$user = $request->user();
		$user->currentAccessToken()->delete();
		return response('', status: 204);
	}
}
