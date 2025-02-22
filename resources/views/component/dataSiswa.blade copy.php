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