<?php

namespace App\Http\Repository;

use App\Http\Repository\IBaseRepository;
use App\Http\Resources\BookingResource;
use App\Http\Resources\PersonFieldResource;
use App\Models\Booking;
use App\Models\TimeSlot;
use App\Models\User;

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
        $timeSlot = TimeSlot::with('escape_rooms')->where('time_slots.id', $request->input("time_slot_id"));

        $room = $this->room->show($timeSlot->escape_room_id);
        if ($room->status) {
            $user = new User();
            $userData = User::where('id', auth('api')->id())->first();
            $user->fill($userData->toArray());
            if ($user->getIsBirthday()) {
                $request->request->add([
                    'book_amount' => ($timeSlot->escapeRoom->amount - ($timeSlot->escapeRoom->amount * config("birthday_discount_rate"))
                    ),
                    'user_id' => auth('api')->id()
                ]);
            }
            $this->booking = Booking::create([
                ...$request
            ]);
            return $this->booking;
        }
        return null ;
    }

    public function get($request, $per_page, $paginate = true)
    {
        $bookings = Booking::query();

        $bookings = $paginate
            ? $bookings->paginate($per_page)
            : $bookings->get();

        BookingResource::collection($bookings);

        return $bookings;
    }

    public function show($id, $request)
    {
        $page = $request->page;
        $booking = Booking::query()
            ->where("id", $id)
            ->first();

        BookingResource::collection($booking);

        return $booking;
    }
    public function update($id, $data)
    {
        $booking = Booking::where("id", $id)
            ->update($data);

        BookingResource::collection($booking);

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

        BookingResource::collection($booking->time_slots);

        return $booking;
    }
}
