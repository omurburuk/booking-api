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
     * @OA\Get(
     *   path="/api/escape-rooms",
     * operationId="showRoomList",
     *  tags={"EscapeRoom"},
     *   summary="escape room list",
     *   @OA\Response(response=200, description="successful operation")
     * )
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $rooms = $this->repo->get($request, $request->input("page"));

        return response()->json([
            "status"    =>    "success",
            "data"        =>    $rooms
        ]);
    }

    /**
     * @OA\Get(
     *   path="/api/escape-rooms/{id}",
     * operationId="showRoomDetail",
     *  tags={"EscapeRoom"},
     *  @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="room id",
     *         required=true,
     *   ),
     *   summary="escape room detail",
     *   @OA\Response(response=200, description="successful operation")
     * )
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($escapeRoomId)
    {
        $room = $this->repo->show($escapeRoomId);

        return response()->json([
            "status"    =>    "success",
            "data"        =>    $room
        ]);
    }

    /**
     * @OA\Get(
     *   path="/api/escape-rooms/time-slots/{id}",
     * operationId="showRoomTimeSlots",
     *  tags={"EscapeRoom"},
     *  @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="room id",
     *         required=true,
     *   ),
     *   summary="escape room available time slots",
     *   @OA\Response(response=200, description="successful operation")
     * )
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function time_slots($escapeRoomId)
    {
        $slots = $this->repo->time_slots($escapeRoomId);

        return response()->json([
            "status"    =>    "success",
            "data"        =>    $slots
        ]);
    }
}
