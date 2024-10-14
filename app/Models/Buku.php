<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    protected $table = 'books';

    // Mendenfisikan TGL_TERBIT menggunakan Casts Untuk Laravel 10.x
    protected $casts = [
        'tgl_terbit' => 'datetime'
    ];
}








