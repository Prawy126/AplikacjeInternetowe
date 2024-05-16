<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = ['announcement_id', 'photo_name'];

    public $timestamps = false;

    public function announcement(): BelongsTo
    {
        return $this->belongsTo(Announcement::class);
    }
}
