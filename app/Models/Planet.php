<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planet extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'diameter', 
        'rotation_period', 
        'orbital_period', 
        'gravity', 
        'population', 
        'climate', 
        'terrain', 
        'surface_water', 
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
     * The films that this planet has appearded in.
     * 
     */
    public function films()
    {
        return $this->belongsToMany(Film::class);
    }

}
