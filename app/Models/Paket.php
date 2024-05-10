<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    protected $table = 'paket';
    public $increamenting = false;
    protected $fillable = [
        'outlet_id',
        'jenis_paket',
        'nama_paket',
        'harga',
    ];
    use HasFactory;

    protected $guarded = [];

    public function outlet()
    {
        return $this->belongsTo(Outlet::class);
    }

    public function customer()
    {
        return $this->hasMany(Customer::class);
    }

}
