<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Booking;
use App\Models\EscapeRoom;
use App\Models\TimeSlot;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::create([
			"name"	=>	"Admin",
			"email"	=>	"admin@bookingapi.com",
			"password"	=>	Hash::make('123456'),
			"birth_date"	=> "1995-03-22"
		]);
		$user->email_verified_at = now();
		$user->save();

        $room = EscapeRoom::create([
			"name"	=>	"1+1 family room",
			"description"	=>	"TV+Wifi+Jakuzi",
			"status"	=>	true,
			"amount"	=> 100
		]);
		$room->save();

        $slot = TimeSlot::create([
			"escape_room_id"	=>	$room->id,
			"available_date"	=>	"2023-04-28",
			"available_start_time"	=>	"07:00",
			"available_end_time"	=>	"09:00",
			"is_available"	=>	true
		]);
		$slot->save();

        $slot = TimeSlot::create([
			"escape_room_id"	=>	$room->id,
			"available_date"	=>	"2023-04-28",
			"available_start_time"	=>	"09:30",
			"available_end_time"	=>	"12:00",
			"is_available"	=>	true
		]);
		$slot->save();
        $slot = TimeSlot::create([
			"escape_room_id"	=>	$room->id,
			"available_date"	=>	"2023-04-29",
			"available_start_time"	=>	"05:00",
			"available_end_time"	=>	"08:00",
			"is_available"	=>	true
		]);
		$slot->save();
        $room = Booking::create([
			"time_slot_id"	=>	$slot->id,
			"user_id"	=>	$user->id,
			"status"	=>	true,
			"book_amount"	=> 100
		]);
		$room->save();
    }
}
