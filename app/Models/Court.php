<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Court extends Model
{
    /** @use HasFactory<\Database\Factories\CourtFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    public function schedules(){
        return $this->belongsToMany(Schedule::class, 'court_schedule', 'court_id', 'schedule_id');
    }
}
