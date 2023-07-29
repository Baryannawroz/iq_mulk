<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug'
    ];

    protected $appends = ['totalProperty'];

    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    public function getTotalPropertyAttribute()
    {
        return $this->properties()->count();
    }

    public function properties(){
        return $this->hasMany(Property::class, 'city_id')->where(function ($query) {
            $query->where('expired_date', null)
                ->orWhere('expired_date', '>=', date('Y-m-d'));
        })->where('approve_by_admin', 'approved')->where('status', 'enable');
    }

    protected $casts =  [
        'id' => 'integer',
        'totalProperty' => 'integer',
        'show_homepage' => 'integer',
        'serial' => 'integer',
    ];

}
