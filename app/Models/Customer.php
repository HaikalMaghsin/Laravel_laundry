<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }

    public function paket()
    {
        return $this->belongsTo(Paket::class);
    }
    protected $fillable = [
        'email',
        'nama',
        'jenis_kelamin',
        'no_hp',
        'alamat',
        'paket_id',
        'berat'
    ];

    protected $table = 'customer';
    public $increamenting = false;
}
