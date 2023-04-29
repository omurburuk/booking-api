<?php

namespace App\Http\Controllers\Api;

use App\Models\Booking;
use App\Http\Controllers\Controller;
use App\Http\Repository\IBookingRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    private IBookingRepository $repo;
    public function __construct()
    {
        $this->repo = app()->make(IBookingRepository::class);
    }
    /**
     *
     * @OA\Get(
     *   path="/api/bookings",
     * security={{"bearer_token":{}}},
     * operationId="showBookingList",
     *  tags={"Booking"},
     *   summary="booking list",
     *   @OA\Response(response=200, description="successful operation")
     * )
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $bookings = $this->repo->get($request, $request->input("page"));

        return response()->json([
            "status"    =>    "success",
            "user" =>  Auth::user(),
            "data"        =>    $bookings
        ]);
    }

    /**
     * @OA\Get(
     *   path="/api/bookings/{id}",
     * operationId="showBooking",
     * security={{"bearer_token":{}}},
     *  tags={"Booking"},
     *  @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="Buscar por estado",
     *         required=true,
     *   ),
     *   summary="Show booking detail",
     *   @OA\Response(response=200, description="successful operation")
     * )
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        $booking = $this->repo->show($booking->id, $booking);

        return response()->json([
            "status"    =>    "success",
            "data"        =>    $booking
        ]);
    }
    /**
     * @OA\Post(
     * path="/api/bookings",
     * operationId="addBooking",
     *  tags={"Booking"},
     * security={{"bearer_token":{}}},
     * summary="Add booking",
     * description="Booking add here",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"time_slot_id"},
     *               @OA\Property(property="time_slot_id", type="integer")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Booking Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */

    public function store(Request $request)
    {
        $request->validate([
            "time_slot_id"        =>    ["required"]
        ]);

        $data = $this->repo->create([
            "user_id"    => Auth::user()->id,
            ...$request->all()
        ]);
        if ($data) {
            return response([
                "status" => "success",
                "data" => $data
            ]);
        } else {
            return response([
                "status" => "error",
                "data" => null,
                "message" => "Room is not available on your choosed time"
            ])->setStatusCode(400);
        }
    }
}
