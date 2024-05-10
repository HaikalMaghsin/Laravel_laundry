<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Outlet extends Model
{
    protected $table = "outlet";
    protected $fillable = [
        'nama_outlet',
        'alamat',
        'no_hp'
    ];
    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function paket()
    {
        return $this->hasOne(Paket::class);
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
    public $increamenting = false;
}
