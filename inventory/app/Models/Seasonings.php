<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seasonings extends Model
{
    use HasFactory;

    const checking_duplicate_id = 0;

    public function user(){
        return $this->belongsTo(User::class, 'users_id');
      }
}
