<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ["time_slot_id", "user_id","status","book_amount"];

	protected $table = 'bookings';
    public function user()
	{
		return $this->belongsTo(User::class, 'users', 'id', 'user_id');
	}
    public function escapeRoom()
	{
		return $this->belongsTo(EscapeRoom::class, 'escape_rooms', 'id', 'escape_room_id');
	}
}
