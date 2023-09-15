<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $with = ['tags'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['s'] ?? false, fn ($query, $s) =>
        $query
            ->where('title', 'like', "%" . $s . "%")
            ->orWhere('location', 'like', "%" . $s . "%")
            ->orWhere('company', 'like', "%" . $s . "%")
            ->orWhere('content', 'like', "%" . $s . "%"));
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function clicks()
    {
        return $this->hasMany(Click::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
