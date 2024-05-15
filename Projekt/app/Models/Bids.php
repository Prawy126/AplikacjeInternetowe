<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Bids extends Model
{
    use HasFactory;

    protected $fillable = ['user_id' ,'announcement_id', 'amount', 'time'];

    public $timestamps = false;

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function announcements(): HasOne
    {
        return $this->hasOne(Announcement::class);
    }
}
