<main class="card-header-siswa history-siswa">
    <div>
        <article class="title-history-siswa">
            <h3>history pembayaran</h3>
        </article>
        <main class="main-history-list">
            <div>
                @foreach ($pembayarans as $index => $data)
                <figure class="card-history">
                    <div>
                        <div class="history-name">
                            <h4>bayar SPP</h4>
                        </div>
                        <div class="history-tgl">
                            <h4>{{ $data->bulan_bayar }}</h4>
                        </div>
                        <div class="history-tgl">
                            <h4>{{ $data->tgl_bayar }}</h4>
                        </div>
                        <div class="history-nominal">
                            <h6>Rp.</h6>
                            <h4>{{ number_format($data->jumlah_bayar, 0, ',', '.') }},-</h4>
                        </div>
                    </div>
                </figure>
                @endforeach
            </div>
        </main>
    </div>
</main>