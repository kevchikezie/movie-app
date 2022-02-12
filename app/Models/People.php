<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'birth_year', 
        'eye_color', 
        'gender', 
        'hair_color', 
        'height', 
        'mass', 
        'skin_color', 
        'planet_id', 
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
     * The planet the person was born on or inhabits.
     * 
     */
    public function homeworld()
    {
        return $this->belongsToMany(Planet::class);
    }

    /**
     * The films that this person has been in.
     * 
     */
    public function films()
    {
        return $this->hasToMany(Film::class);
    }

    /**
     * Return a formatted created date
     * 
     */
    public function getCreatedAttribute()
    {
        return $this->created->format('Y-m-d H:i');
    }

    /**
     * Return a formatted edited date
     * 
     */
    public function getEditedAttribute()
    {
        return $this->edited->format('Y-m-d H:i');
    }

}
