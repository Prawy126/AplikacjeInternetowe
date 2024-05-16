<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'brand', 'year', 'mileage', 'description', 'date', 'price'];

    public $timestamps = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function histories(): HasMany
    {
        return $this->hasMany(Bids::class);
    }

    public function photos(): HasMany
    {
        return $this->hasMany(Photo::class);
    }

    // Nowa metoda do pobierania losowego zdjęcia
    public function randomPhoto()
    {
        return $this->photos->random();
    }
}
