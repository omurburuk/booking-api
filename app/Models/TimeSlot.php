<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    use HasFactory;
    protected $table = 'time_slots';
    public function escapeRoom()
	{
		return $this->belongsTo(EscapeRoom::class, 'escape_room_id');
	}

}
