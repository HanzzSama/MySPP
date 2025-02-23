<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/lib/css/show.css">
    <title>Detaile Siswa {{ $data->nama }}</title>
</head>

<body>

</body>
<main class="container-main">
    <div class="cover">
        <div class="icon">
            <i class='bx bx-user-circle'></i>
        </div>
    </div>
    <div class="data-siswa">
        <div>
            <article class="title-siswa">
                <h1>Detail Siswa</h1>
            </article>
            <main class="detail-siswa">
                <div class="data">
                    <h4>nama</h4>
                    <p>:</p>
                    <h4>{{ $data->nama }}</h4>
                </div>
                <div class="data">
                    <h4>NIS</h4>
                    <p>:</p>
                    <h4>{{ $data->siswa->nis }}</h4>
                </div>
                <div class="data">
                    <h4>NISN</h4>
                    <p>:</p>
                    <h4>{{ $data->siswa->nisn }}</h4>
                </div>
                <div class="data no-telp">
                    <h4>no. telp</h4>
                    <p>:</p>
                    <div>
                        <i class='bx bxl-whatsapp'></i>
                        <h4>{{ $data->no_telp }}</h4>
                    </div>
                </div>
                <div class="data">
                    <h4>kelas</h4>
                    <p>:</p>
                    <h4>{{ $data->siswa->kelas->nama_kelas }}</h4>
                </div>
                <div class="data">
                    <h4>jurusan</h4>
                    <p>:</p>
                    <h4>{{ $data->siswa->kelas->jurusan }}</h4>
                </div>
                <div class="data">
                    <h4>alamat</h4>
                    <p>:</p>
                    <h4>{{ $data->alamat }}</h4>
                </div>
                <div class="btn">
                    <a href="{{ route('dashboard.'.Auth::user()->role) }}">
                        <button>dashboard</button>
                    </a>
                </div>
            </main>
        </div>
    </div>
</main>

</html>