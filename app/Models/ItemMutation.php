<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemMutation extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected  $casts =[
        'date_input' => 'date',
        'date_production' => 'date',
        'date_delivery' => 'date'
    ];
    public function item() {
        return $this->belongsTo(Item::class)->withDefault([
            'name' => 'Data Tidak Ditemukan'
        ]);
    }
}
