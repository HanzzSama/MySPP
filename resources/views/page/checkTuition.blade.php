<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/lib/css/check.css">
    <title>Pembayaran Berhasil</title>
</head>

<body>
    <main class="container-main">
        <div>

            <head>
                <div class="title-head">
                    <figure class="img">
                        <img src="/img/bot.jpg" alt="">
                    </figure>
                    <article class="title">
                        <h2>MySPP</h2>
                        <h5>pembayaran spp sekolah</h5>
                    </article>
                </div>
                <hr>
                @if ($data)
                <div class="content-check">
                    <article class="title-check">
                        <h3>detail siswa</h3>
                    </article>
                    <div class="data">
                        <h4>nama siswa</h4>
                        <p>:</p>
                        <h4>{{ $data->user->nama }}</h4>
                    </div>
                    <div class="data">
                        <h4>nis siswa</h4>
                        <p>:</p>
                        <h4>{{ $data->user->siswa->nis }}</h4>
                    </div>
                    <div class="data">
                        <h4>nisn siswa</h4>
                        <p>:</p>
                        <h4>{{ $data->user->siswa->nisn }}</h4>
                    </div>
                    <div class="data">
                        <h4>no. telp</h4>
                        <p>:</p>
                        <h4>{{ $data->user->no_telp }}</h4>
                    </div>
                    <div class="data">
                        <h4>email</h4>
                        <p>:</p>
                        <h4>{{ $data->user->email }}</h4>
                    </div>
                    <div class="data">
                        <h4>alamat siswa</h4>
                        <p>:</p>
                        <h4>{{ $data->user->alamat }}</h4>
                    </div>
                    <article class="title-check">
                        <h3>detail pembayaran</h3>
                    </article>
                    <div class="data">
                        <h4>tahun bayar</h4>
                        <p>:</p>
                        <h4>{{ $data->tahun_bayar }}</h4>
                    </div>
                    <div class="data">
                        <h4>bulan bayar</h4>
                        <p>:</p>
                        <h4>{{ $data->bulan_bayar }}</h4>
                    </div>
                    <div class="data">
                        <h4>tanggal dibayar</h4>
                        <p>:</p>
                        <h4>{{ $data->tgl_bayar }}</h4>
                    </div>
                    <div class="data">
                        <h4>nominal bayar</h4>
                        <p>:</p>
                        <div class="nominal">
                            <h6>Rp. </h6>
                            <h4>{{ $data->jumlah_bayar }}.000,-</h4>
                        </div>
                    </div>
                    <article class="btn">
                        <a href="{{ route('dashboard.petugas') }}">
                            <button>kembali ke dashboard</button>
                        </a>
                    </article>
                </div>
                @endif
            </head>
        </div>
    </main>
</body>

</html>