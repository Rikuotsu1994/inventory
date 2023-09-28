<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amounts extends Model
{
    use HasFactory;
    const default_amount_flag = 0;
    const checking_amount_flag = 1;
}
