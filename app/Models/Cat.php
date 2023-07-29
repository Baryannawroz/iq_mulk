<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    public $timestamps = false;

    protected  $guarded =[];
    use HasFactory;
    public function subcategories()
    {
        return $this->hasMany(Sub::class);
    }
}
