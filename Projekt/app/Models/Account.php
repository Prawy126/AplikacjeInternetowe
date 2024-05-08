<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Account extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'surname', 'address', 'number_phone', 'email'];

    public $timestamps = false;

    public function announcements(): HasMany
    {
        return $this->hasMany(Announcement::class);
    }

    public function histories(): HasMany
    {
        return $this->hasMany(History::class);
    }
}
