<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Pembayaran;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = [
            [
                'nama' => 'Wang Lin Er',
                'alamat' => 'Jl. Raya No. 1',
                'no_telp' => '081234567890',
                'role' => 'admin',
                'email' => 'wang@gmail.com',
                'password' => bcrypt('123456'),
            ],
            [
                'nama' => 'Zhang Wei',
                'alamat' => 'Jl. Raya No. 2',
                'no_telp' => '081234567891',
                'role' => 'petugas',
                'email' => 'zhang@gmail.com',
                'password' => bcrypt('123456'),
            ],
            [
                'nama' => 'Li Jia',
                'alamat' => 'Jl. Raya No. 3',
                'no_telp' => '081234567892',
                'role' => 'siswa',
                'email' => 'jia@gmail.com',
                'password' => bcrypt('123456'),
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }

        $kelas = [
            [
                'nama_kelas' => '10',
                'jurusan' => 'rekayasa perangkat lunak',
            ],
            [
                'nama_kelas' => '10',
                'jurusan' => 'teknik elektronik industri',
            ],
            [
                'nama_kelas' => '10',
                'jurusan' => 'teknik komputer jaringan',
            ],
            [
                'nama_kelas' => '10',
                'jurusan' => 'teknik kendaraan ringan',
            ],
            [
                'nama_kelas' => '10',
                'jurusan' => 'tata busana',
            ],
            [
                'nama_kelas' => '10',
                'jurusan' => 'teknik permesinan',
            ],
            [
                'nama_kelas' => '10',
                'jurusan' => 'teknik pemintalan serat buatan',
            ],
            [
                'nama_kelas' => '11',
                'jurusan' => 'rekayasa perangkat lunak',
            ],
            [
                'nama_kelas' => '11',
                'jurusan' => 'teknik elektronik industri',
            ],
            [
                'nama_kelas' => '11',
                'jurusan' => 'teknik komputer jaringan',
            ],
            [
                'nama_kelas' => '11',
                'jurusan' => 'teknik kendaraan ringan',
            ],
            [
                'nama_kelas' => '11',
                'jurusan' => 'tata busana',
            ],
            [
                'nama_kelas' => '11',
                'jurusan' => 'teknik permesinan',
            ],
            [
                'nama_kelas' => '11',
                'jurusan' => 'teknik pemintalan serat buatan',
            ],
            [
                'nama_kelas' => '12',
                'jurusan' => 'rekayasa perangkat lunak',
            ],
            [
                'nama_kelas' => '12',
                'jurusan' => 'teknik elektronik industri',
            ],
            [
                'nama_kelas' => '12',
                'jurusan' => 'teknik komputer jaringan',
            ],
            [
                'nama_kelas' => '12',
                'jurusan' => 'teknik kendaraan ringan',
            ],
            [
                'nama_kelas' => '12',
                'jurusan' => 'tata busana',
            ],
            [
                'nama_kelas' => '12',
                'jurusan' => 'teknik permesinan',
            ],
            [
                'nama_kelas' => '12',
                'jurusan' => 'teknik pemintalan serat buatan',
            ],
        ];
        foreach ($kelas as $data) {
            Kelas::create($data);
        }

        $siswa = [
            [
                'nisn' => '0049812391',
                'id_user' => 3,
                'id_kelas' => 1,
            ],
        ];

        foreach ($siswa as $key => $value) {
            Siswa::create($value);
        }
    }
}