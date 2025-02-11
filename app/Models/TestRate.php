<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestRate extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function test()
    {
        return $this->belongsTo(Test::class);
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
