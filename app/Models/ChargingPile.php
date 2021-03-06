<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChargingPile extends Model
{
    use HasFactory;

    protected $fillable = ['device_id', 'brand', 'model', 'stall_id'];

    //與車位表關聯
    public function stall()
    {
        return $this->belongsTo(Stall::class);
    }

////    與停車場關聯
//    public function Park()
//    {
//        return $this->belongsTo(Park::class);
//    }

    //與充電樁關聯
    public function ChargingResult()
    {
        return $this->hasMany(ChargingResult::class);
    }
}
