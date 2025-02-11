<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $guarded = [];
    use HasFactory;
    public function mediaManager()
    {
        return $this->belongsTo(MediaManager::class);
    }
}
