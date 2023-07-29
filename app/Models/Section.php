<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected  $guarded = [];

    use HasFactory;
    public function sub()
    {
        return $this->belongsTo(Sub::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
