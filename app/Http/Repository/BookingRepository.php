<?php

namespace App\Http\Repository;

use App\Http\Resources\BookingResource;
use App\Models\Booking;
use App\Models\TimeSlot;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BookingRepository implements IBookingRepository
{
    public $booking;
    public $room;

    public function __construct()
    {
        $this->room = app()->make(IEscapeRoomRepository::class);
    }

    public function create($request)
    {
        $timeSlot = TimeSlot::with('escapeRoom')->where('time_slots.id', $request["time_slot_id"])
            ->where('time_slots.is_available', 1)
            ->first();
        if (!$timeSlot)
            return null;
        $room = $this->room->show($timeSlot->escape_room_id);
        if ($room->status) {
            $user = new User();
            $userData = User::where('id', $request["user_id"])->first();
            $user->fill($userData->toArray());
            if ($user->getIsBirthday()) {
                $request['book_amount'] =
                    $timeSlot->escapeRoom->amount - ($timeSlot->escapeRoom->amount * config("birthday_discount_rate",0.1));
            } else {
                $request['book_amount'] = $timeSlot->escapeRoom->amount;
            }
            $this->booking = Booking::create([
                ...$request
            ]);
            $timeSlot->is_available = false;
            $timeSlot->save();
            return $this->booking;
        }
        return null;
    }

    public function get($request, $per_page, $paginate = false)
    {
        $bookings = Booking::query();

        $bookings = $paginate
            ? $bookings->paginate($per_page)
            : $bookings->get();

        //BookingResource::collection($bookings);

        return $bookings;
    }

    public function show($id, $request)
    {
        $page = $request->page;
        $booking = Booking::query()
            ->where("id", $id)
            ->first();

        //BookingResource::collection($booking);

        return $booking;
    }
    public function update($id, $data)
    {
        $booking = Booking::where("id", $id)
            ->update($data);

        //$booking=BookingResource::collection($booking);

        return $booking;
    }


    public function delete($id)
    {
        Booking::where("id", $id)->delete();
    }

    public function time_slots($id)
    {
        $booking = Booking::where("id", $id)
            ->with("time_slots")
            ->first();

        //$booking=BookingResource::collection($booking->time_slots);

        return $booking;
    }
}
