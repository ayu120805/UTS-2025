<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produks'; // optional, jika nama tabel bukan jamak dari nama model

    protected $fillable = [
        'nama',
        'deskripsi',
        'harga',
        'kategori',
    ];

    public $timestamps = true; // default-nya sudah true
}
