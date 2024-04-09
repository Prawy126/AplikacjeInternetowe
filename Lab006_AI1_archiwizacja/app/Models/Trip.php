<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Trip extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $attributes = [
        'peroid' => 7,
    ];

    protected $fillable = ['name', 'continent', 'peroid', 'description', 'price', 'img', 'country_id'];

    public function country(): HasMany
    {
        return $this->hasMany(Country::class);
    }
}
