<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EscapeRoom extends Model
{
    use HasFactory,SoftDeletes;

	protected $fillable = ["name", "description","status"];

	protected $table = 'escape_rooms';
    public function timeSlots()
	{
		return $this->hasMany(TimeSlot::class, 'escape_room_id', 'id');
	}
}
