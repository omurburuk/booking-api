<?php

namespace App\Http\Controllers;

use App\Models\EscapeRoom;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EscapeRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
	{
		$rooms = EscapeRoom::paginate(10);

		return response([
			"status"	=>	"success",
			"data"		=>	$rooms
		]);
	}

    /**
     * Display the specified resource.
     */
    public function show(EscapeRoom $escapeRoom)
    {
        //
    }

}
