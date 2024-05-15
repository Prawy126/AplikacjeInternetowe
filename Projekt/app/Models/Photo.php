<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = ['annoucemnets_id', 'photo_name'];

    public $timestamps = false;

    public function announcements(): HasMany
    {
        return $this->hasMany(Announcement::class);
    }
}
