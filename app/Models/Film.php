<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 
        'episode_id', 
        'opening_crawl', 
        'director', 
        'producer', 
        'release_date', 
        'created', 
        'edited',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created' => 'datetime',
        'edited' => 'datetime',
        'edirelease_dateted' => 'date',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * The planets that are in this film.
     * 
     */
    public function planets()
    {
        return $this->belongsToMany(Planet::class);
    }
}
