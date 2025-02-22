<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SPP extends Model
{
    /** @use HasFactory<\Database\Factories\SPPFactory> */
    use HasFactory;

    protected $table = 'spps';

    protected $fillable = [
        'id_spp',
        'tahun',
        'nominal',
    ];
}