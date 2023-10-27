<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amounts extends Model
{
    use HasFactory;
    const default_amount_flag = 0;
    const checking_amount_flag = 1;

    protected $table = 'amounts';
    protected $fillable = ['seasonings_id','markets_id','amount',];

    public function seasonings() {
        return $this->belongsTo(Seasonings::class, 'seasonings_id');
    }
    public function markets() {
        return $this->belongsTo(Markets::class, 'markets_id');
    }
}
