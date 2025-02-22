<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/lib/css/dashboard.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script>
        if (localStorage.getItem("theme") === "dark") {
            document.documentElement.classList.add("dark");
        }
    </script>
    <title>Document</title>
</head>

<body>
    @session('success')
    <section id="alert" class="alert" role="alert">
        <div>
            <h3>success</h3>
            <h4>{{ $value }}</h4>
        </div>
    </section>
    @endsession
    <div class="wrapper-page">
        @include('component.sidebar')
        <main class="container-main">
            <div>
                <nav class="header-nav">
                    <figure class="nav-search">
                        <div>
                            <i class='bx bx-search'></i>
                            <input type="text" placeholder="Sesrch data...">
                        </div>
                        <button class="btn-src">
                            <h4>login</h4>
                        </button>
                    </figure>
                </nav>
                <nav class="nav-title">
                    <article>
                        <h1>hi, {{ Auth::user()->username }}</h1>
                        <h4>Selamat datang di halaman petugas pembayaran SPP</h4>
                    </article>
                </nav>
                <form id="searchForm" class="filter-src content active">
                    <div>
                        <figure class="card-src card-filter">
                            <div>
                                <select id="kelas" name="kelas">
                                    <option value="">-- Pilih Kelas --</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                            </div>
                            <div>
                                <select id="jurusan" name="jurusan">
                                    <option value="">-- Pilih Jurusan --</option>
                                    @foreach($jurusan as $jrs)
                                    <option value="{{ strtolower($jrs) }}" style="text-transform: capitalize;">
                                        {{ $jrs }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </figure>
                        <figure class="card-src card-search">
                            <div>
                                <input type="text" id="searchInput" placeholder="Search by name"
                                    onkeyup="filterNames()" />
                            </div>
                            <div>
                                <button id="searchButton">Cari</button>
                            </div>
                        </figure>
                    </div>
                </form>
                <main id="home" class="container-siswa content active">
                    <div>
                        <article class="title-daftar">
                            <h3>Daftar Siswa</h3>
                        </article>
                        <header class="list-siswa" id="studentCards">
                            @forelse ($siswa as $data)
                            <figure class="card-siswa" data-filter-kelas="{{ $data->kelas->nama_kelas }}"
                                data-filter-jurusan="{{ $data->kelas->jurusan }}">
                                <div class="name-siswa">
                                    <h4>{{ $data->nama }}</h4>
                                </div>
                                <div class="kls-siswa">
                                    <h4>{{ $data->kelas->nama_kelas }} -
                                        @php
                                        $jurusan_singkatan = [
                                        "rekayasa perangkat lunak" => "RPL",
                                        "teknik elektronik industri" => "TEI",
                                        "teknik komputer jaringan" => "TKJ",
                                        "teknik kendaraan ringan" => "TKR",
                                        "tata busana" => "TB",
                                        "teknik permesinan" => "TP",
                                        "teknik pemintalan serat buatan" => "TPSB",
                                        ];

                                        $jurusan_full = strtolower(trim($data->kelas->jurusan));
                                        $jurusan_singkat = $jurusan_singkatan[$jurusan_full] ?? $jurusan_full;
                                        @endphp

                                        {{ $jurusan_singkat }}
                                    </h4>
                                </div>
                                <div class="jrs-siswa">
                                    <h4>{{ $data->kelas->jurusan }}</h4>
                                </div>
                                <div class="btn-spp-siswa">
                                    <a href="{{ route('dashboard.show', $data->id) }}">
                                        <button>
                                            <i class='bx bxs-wallet'></i>
                                            <h4>SPP</h4>
                                        </button>
                                    </a>
                                    <button>
                                        <i class='bx bx-sync'></i>
                                        <h4>update</h4>
                                    </button>
                                    <form action="{{ route('dashboard.destroy',$data->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete-spp">
                                            <i class='bx bxs-trash'></i>
                                            <h4>delete</h4>
                                        </button>
                                    </form>
                                </div>
                            </figure>
                            @empty
                            <span>There are no data</span>
                            @endforelse
                        </header>
                        {{ $siswa->links() }}
                        {{-- {!! $users->withQueryString()->links('pagination::bootstrap-5') !!} --}}
                    </div>
                </main>
                <main id="data-analyzing" class="container-data content">
                    @include('component.dataStatic')
                </main>
                <main id="formAdd" class="container-add content">
                    @include('component.addSiswa')
                </main>
                <footer class="container-footer">
                    <div></div>
                </footer>
                <footer class="footer">
                    <div>
                        <p>Desaign by Rifky</p>
                    </div>
                </footer>
            </div>
        </main>
    </div>
    @include('component.allScript')
</body>

</html>