<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'continent', 'period', 'description', 'price', 'img', 'country_id'];

    // Domyślna wartość dni dla wycieczki
    protected $attributes = [
        'period' => 7,
    ];

    // Relacja z Country
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
