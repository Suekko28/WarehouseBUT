<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function itemMutations() {
        return $this->hasMany(ItemMutation::class);
    }

    public function getSumQty() {
        $jumlah = ($this->itemMutations()->sum('qty_in') - $this->itemMutations()->sum('qty_out'));
        return  $jumlah < 1 ? 0 : $jumlah;
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
