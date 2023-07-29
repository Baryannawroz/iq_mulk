<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub extends Model
{
    public $timestamps = false;

    protected  $guarded = [];

    use HasFactory;
    public function cat()
    {
        return $this->belongsTo(Cat::class);
    }
}
