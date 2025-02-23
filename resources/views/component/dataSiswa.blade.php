<main id="home" class="container-data-siswa content active">
    <div>
        <article class="title-data-siswa">
            <h3>Data Siswa</h3>
        </article>
        <form id="searchForm" class="content-search-siswa">
            <div>
                <figure class="search-data-siswa">
                    <select id="kelas" name="kelas">
                        <option value="">-- Pilih Kelas --</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
                </figure>
                <figure class="search-data-siswa">
                    <select id="jurusan" name="jurusan">
                        <option value="">-- Pilih Jurusan --</option>
                        @foreach($jurusan as $jrs)
                        <option value="{{ strtolower($jrs) }}" style="text-transform: capitalize;">
                            {{ $jrs }}
                        </option>
                        @endforeach
                    </select>
                </figure>
                <figure class="search-data-siswa">
                    <input type="text" id="searchInput" placeholder="Search by name" onkeyup="filterNames()">
                </figure>
                <figure class="btn src">
                    <button id="searchButton">Cari</button>
                </figure>
            </div>
        </form>
        <main class="content-data-siswa">
            <div>
                @foreach ($users as $data)
                @if ( $data->role == 'siswa')
                <figure class="card-data-siswa card-siswa" data-filter-kelas="{{ $data->siswa->kelas->nama_kelas }}"
                    data-filter-jurusan="{{ $data->siswa->kelas->jurusan }}">
                    <div>
                        <article class="data-siswa">
                            <div class="name-siswa">
                                <h3>{{ $data->nama }}</h3>
                            </div>
                            <div class="jrs-siswa">
                                <h5>{{ $data->siswa->kelas->jurusan }}</h5>
                            </div>
                        </article>
                        <article class="data-siswa">
                            <div class="kls-siswa">
                                <h4>
                                    {{ $data->siswa->kelas->nama_kelas }} -
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

                                    $jurusan_full = strtolower(trim($data->siswa->kelas->jurusan));
                                    $jurusan_singkat = $jurusan_singkatan[$jurusan_full] ?? $jurusan_full;
                                    @endphp

                                    {{ $jurusan_singkat }}
                                </h4>
                            </div>
                        </article>
                        <article class="data-siswa">
                            <div class="nisn-siswa">
                                @if($data->siswa)
                                <h4>{{ $data->siswa->nis }}</h4>
                                @else
                                @endif
                            </div>
                        </article>
                        <article class="data-siswa btn">
                            <a href="{{ route('pembayaran.show', $data->id) }}" class="btn-bayar">
                                <button>
                                    <i class='bx bxs-wallet'></i>
                                    <h4>bayar SPP</h4>
                                </button>
                            </a>
                            <a href="{{ route('dashboard.show', $data->id) }}" class="btn-detail">
                                <button>
                                    <i class='bx bxs-book-content'></i>
                                    <h4>detail</h4>
                                </button>
                            </a>
                            @if (Auth::user()->role == 'admin')
                            <a href="{{ route('dashboard.edit', $data->id) }}" class="btn-edit">
                                <button>
                                    <i class='bx bx-edit'></i>
                                    <h4>edit</h4>
                                </button>
                            </a>
                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                action="{{ route('dashboard.destroy', $data->id) }}" method="POST" class="btn-hapus">
                                @csrf
                                @method('DELETE')
                                <button>
                                    <i class='bx bxs-trash'></i>
                                    <h4>hapus</h4>
                                </button>
                            </form>
                            @else
                            @endif
                        </article>
                    </div>
                </figure>
                @endif
                @endforeach
            </div>
        </main>
    </div>
</main>