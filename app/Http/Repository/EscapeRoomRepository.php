<?php

namespace App\Http\Repository;

use App\Http\Repository\IBaseRepository;
use App\Http\Resources\EscapeRoomResource;
use App\Models\EscapeRoom;

class EscapeRoomRepository implements IEscapeRoomRepository
{
    public $room;

    public function __construct()
    {
    }

    public function create($request)
    {
        $this->room = EscapeRoom::create([
            ...$request
        ]);
    }

    public function get($request, $per_page, $paginate = false)
    {
        $rooms = EscapeRoom::query();

        $rooms = $paginate
            ? $rooms->paginate($per_page)
            : $rooms->get();

        //EscapeRoomResource::collection($rooms);

        return $rooms;
    }

    public function show($id)
    {
        $room = EscapeRoom::query()
            ->with("timeSlots")
            ->where("id", $id)
            ->first();

        //EscapeRoomResource::collection($room);

        return $room;
    }
    public function update($id, $data)
    {
        $room = EscapeRoom::where("id", $id)
            ->update($data);

        //EscapeRoomResource::collection($room);

        return $room;
    }


    public function delete($id)
    {
        EscapeRoom::where("id", $id)->delete();
    }

    public function time_slots($id)
    {
        $room = EscapeRoom::where("id", $id)
            ->with("timeSlots")
            ->first();

        //EscapeRoomResource::collection($room->time_slots);

        return $room;
    }
}
