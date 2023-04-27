<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EscapeRoom extends Model
{
    use HasFactory;

	protected $fillable = ["name", "description","status"];

	protected $table = 'escape_rooms';
    public function timeSlots()
	{
		return $this->belongsToMany(TimeSlot::class, 'time_slots', 'id', 'escape_room_id');
	}
}
