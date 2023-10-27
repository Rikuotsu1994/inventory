<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Markets extends Model
{
    use HasFactory;

    protected $table = 'markets';

    public function user() {
        return $this->belongsTo(User::class, 'users_id');
    }
    public function amounts()
    {
        return $this->hasAny(Amounts::class, 'markets_id');
    }
}
