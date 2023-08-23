<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Section extends Model
{


    use HasFactory;
    protected $dates = ['expired_date'];
    public function sub()
    {
        return $this->belongsTo(Sub::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
