<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
	public function register(RegisterRequest $request)
	{
		$data = $request->validated();
		if ($data['isCompany'] === false) {
			$user = User::create([
				'name' => $data['name'],
				'surname' => $data['surname'],
				'email' => $data['email'],
				'city' => $data['city'],
				'password' => bcrypt($data['password']),
				'isCompany' => $data['isCompany']
			]);
		} else {
			$user = User::create([
				'name' => $data['name'],
				'email' => $data['email'],
				'city' => $data['city'],
				'password' => bcrypt($data['password']),
				'isCompany' => $data['isCompany']
			]);
		}

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
