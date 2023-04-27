<?php

namespace App\Http\Controllers\Api;

use App\Http\Repository\IEscapeRoomRepository;
use App\Models\EscapeRoom;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class EscapeRoomController extends Controller
{
    private IEscapeRoomRepository $repo;
    public function __construct()
    {
        $this->repo = app()->make(IEscapeRoomRepository::class);
    }

    /**
     * @SWG\Get(
     *   path="/api/escape-rooms",
     *   summary="Escape room list",
     *   @SWG\Response(response=200, description="successful operation")
     * )
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
	{
		$rooms = $this->repo->get($request,$request->input("page"));

		return response()->json([
			"status"	=>	"success",
			"data"		=>	$rooms
		]);
	}

    /**
     * @SWG\Get(
     *   path="/api/escape-rooms/{id}",
     *   summary="Escape room list",
     *   @SWG\Response(response=200, description="successful operation")
     * )
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(EscapeRoom $escapeRoom)
    {
        $room = $this->repo->show($escapeRoom->id,$escapeRoom);

		return response()->json([
			"status"	=>	"success",
			"data"		=>	$room
		]);
    }

    /**
     * @SWG\Get(
     *   path="/api/escape-rooms/{room-id}",
     *   summary="Escape room list",
     *   @SWG\Response(response=200, description="successful operation")
     * )
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function time_slots(EscapeRoom $escapeRoom)
    {
        $slots = $this->repo->time_slots($escapeRoom->id);

		return response()->json([
			"status"	=>	"success",
			"data"		=>	$slots
		]);
    }
}
