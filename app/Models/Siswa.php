<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    /** @use HasFactory<\Database\Factories\SiswaFactory> */
    use HasFactory;

    protected $table = 'siswas';

    protected $fillable = [
        'nisn',
        'nis',
        'id_user',
        'id_kelas',
        'id_spp',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($Siswa) {
            $lastSiswa = Siswa::latest('nis')->first();
            $lastNumber = $lastSiswa ? intval($lastSiswa->nis) : 9;
            $Siswa->nis = str_pad($lastNumber + 1, 6, '0', STR_PAD_LEFT);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}