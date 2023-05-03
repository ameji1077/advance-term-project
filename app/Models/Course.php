<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['shop_id','course_name','price'];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
