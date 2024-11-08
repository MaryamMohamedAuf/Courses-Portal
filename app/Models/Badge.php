<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'required_achievements',
    ];

    public function achievements()
    {
        return $this->hasMany(Achievement::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
