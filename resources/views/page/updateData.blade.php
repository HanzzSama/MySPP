<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/lib/css/update.css">
    <title>Document</title>
</head>

<body>

</body>
@if ($errors->any())
@foreach ($errors->all() as $error)
<section id="alert" class="alert" role="alert">
    <div>
        <h3>error</h3>
        <h4>{{ $error }}</h4>
    </div>
</section>
@endforeach
@endif
<main class="container-main">
    <div>
        <article class="title-update">
            <h3>update data <b>{{ $data->nama }}</b></h3>
        </article>
        <main class="content-form">
            <form action="{{ route('dashboard.update', $data->id) }}" method="POST">
                @csrf
                @method('PUT')

                <section class="input">
                    <label for="nama">nama</label>
                    <input type="text" name="nama" placeholder="Nama" value="{{ old('nama', $data->nama) }}">
                </section>
                @if(Auth::user()->role == 'admin' || Auth::user()->role == 'petugas')
                <section class="input">
                    <label for="nisn">NISN</label>
                    <input type="text" name="nisn" placeholder="NISN" value="{{ old('nisn', $data->siswa->nisn) }}">
                </section>
                @endif
                <section class="input">
                    <label for="no_telp">no. telp</label>
                    <input type="text" name="no_telp" placeholder="No. Telp"
                        value="{{ old('no_telp', $data->no_telp) }}">
                </section>
                @if(Auth::user()->role == 'admin')
                <section class="input">
                    <label for="role">Role</label>
                    <input type="text" name="role" name="role" value="{{ old('role', $data->role) }}">
                </section>
                <section class="input">
                    <label for="id_kelas">ID Kelas</label>
                    <input type="text" name="id_kelas" value="{{ old('id_kelas', $data->id_kelas) }}">
                </section>
                @endif
                <section class="input">
                    <textarea name="alamat" name="alamat"
                        placeholder="Alamat">{{ old('alamat', $data->alamat) }}</textarea>
                </section>
                <section class="input hide">
                    <input type="text" name="role_check" value="{{ Auth::user()->role }}">
                </section>
                <section class="btn-submit">
                    <button type="submit">update</button>
                </section>
            </form>
        </main>
    </div>
</main>

</html>