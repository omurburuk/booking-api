<?php

namespace App\Http\Controllers\Api;

use App\Models\Booking;
use App\Http\Controllers\Controller;
use App\Http\Repository\IBookingRepository;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    private IBookingRepository $repo;
    public function __construct()
    {
        $this->repo = app()->make(IBookingRepository::class);
    }
     /**
     * @SWG\Get(
     *   path="/api/bookings",
     *   summary="booking list",
     *   @SWG\Response(response=200, description="successful operation")
     * )
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function index(Request $request)
     {
         $bookings = $this->repo->get($request,$request->input("page"));

         return response()->json([
             "status"	=>	"success",
             "data"		=>	$bookings
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
     public function show(Booking $booking)
     {
         $booking = $this->repo->show($booking->id,$booking);

         return response()->json([
             "status"	=>	"success",
             "data"		=>	$booking
         ]);
     }


    public function store(Request $request)
	{
		$request->validate([
			"time_slot_id"		=>	["required"]
		]);

		$this->repo->create([
			"user_id"	=> auth('api')->id(),
			...$request->all()
		]);

		return response(["status" => "success"]);
	}

}
