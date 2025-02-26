<main class="container-history-all content" id="history">
    <div>
        <article class="title-history-siswa">
            <h3>semua detail history</h3>
        </article>
        @if (Auth::user()->role === 'admin' || Auth::user()->role === 'petugas')
        <main class="container-history-admin">
            <div>
                @foreach ($pembayaran as $data)
                <figure class="card-history-admin">
                    <div>
                        <div class="history-admin name">
                            <h3>{{ $data->user->nama }}</h3>
                        </div>
                        <div class="history-admin jurusan">
                            <h4>{{ $data->user->siswa->kelas->jurusan }}</h4>
                        </div>
                        <div class="history-admin jurusan">
                            <h4>kelas : {{ $data->user->siswa->kelas->nama_kelas }}</h4>
                        </div>
                        <div class="history-admin nisn">
                            <h4>{{ $data->user->siswa->nisn }}</h4>
                        </div>
                        <div class="history-admin bln">
                            <h4>{{ $data->bulan_bayar }}</h4>
                        </div>
                        <div class="history-admin nominal">
                            <h6>Rp.</h6>
                            <h4>{{ number_format($data->jumlah_bayar, 0, ',', '.') }},-</h4>
                        </div>
                        <div class="btn-history detaile">
                            <a href="{{ route('pembayaran.showTuition', $data->id_pembayaran) }}" class="btn-detail">
                                <button>
                                    <i class='bx bxs-book-content'></i>
                                    <h4>detail</h4>
                                </button>
                            </a>
                        </div>
                    </div>
                </figure>
                @endforeach
            </div>
        </main>
        @endif
    </div>
</main>