<?php

namespace App\Http\Controllers;

use App\Models\EscapeRoom;
use App\Models\User;
use Illuminate\Http\Request;

class EscapeRoomController extends Controller
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
