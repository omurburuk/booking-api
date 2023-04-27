<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function show($email)
	{
		$user = User::where('email', $email)->firstOrFail();

		return response([
			"status"	=>	"success",
			"data"		=>	[
				...$user->toArray(),
				"bookings"	=>	$user->bookings
			]
		]);
	}
}
