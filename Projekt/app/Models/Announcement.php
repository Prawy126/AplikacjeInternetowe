<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'brand', 'year', 'mileage', 'description', 'end_date', 'min_price'];

    public $timestamps = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function bids(): HasMany
    {
        return $this->hasMany(Bids::class);
    }

    public function photos(): HasMany
    {
        return $this->hasMany(Photo::class);
    }

    public function randomPhoto()
    {
        if ($this->photos->isEmpty()) {
            // Zwraca domyślne zdjęcie, jeśli nie ma zdjęć
            return (object) ['photo_name' => 'samochod1.png'];
        }
        return $this->photos->random();
    }

}
