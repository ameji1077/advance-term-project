<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = ['name','area_id','genre_id','description','image_url'];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public static function doSearch($keyword, $area_id, $genre_id)
    {
        $query = self::query();
        if (!empty($keyword)) {
            $query->where('name', 'like binary', "%{$keyword}%");
        }
        if (!empty($area_id)) {
            $query->where('area_id', 'like binary', "%{$area_id}%");
        }
        if (!empty($genre_id)) {
            $query->where('genre_id', 'like binary', "%{$genre_id}%");
        }
        $results = $query->get();
        return $results;
    }
}
