<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class surat extends Model
{
    use HasFactory;
    protected $table = 'surats';

    protected $fillable = [
        'NomorSurat',
        'Judul',
        'File',
        'Kategori',
        'waktu_arsip',
    ];
}
