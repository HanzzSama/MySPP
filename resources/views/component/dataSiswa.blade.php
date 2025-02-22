<main id="home" class="container-data-siswa">
    <div>
        <article class="title-data-siswa">
            <h3>Data Siswa</h3>
        </article>
        <main class="content-data-siswa">
            <div>
                @foreach ($users as $data)
                @if ( $data->role == 'siswa')
                <figure class="card-data-siswa card-siswa">
                    <div>
                        <article class="data-siswa">
                            <div class="name-siswa">
                                <h3>{{ $data->nama }}</h3>
                            </div>
                            <div class="jrs-siswa">
                                <h5>rekayasa perangkat lunak</h5>
                            </div>
                        </article>
                        <article class="data-siswa">
                            <div class="kls-siswa">
                                <h4>10-rpl</h4>
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
                            <a href="{{ route('dashboard.edit', $data->id) }}" class="btn-edit">
                                <button>
                                    <i class='bx bx-edit'></i>
                                    <h4>edit</h4>
                                </button>
                            </a>
                            <div class="btn-hapus">
                                <button>
                                    <i class='bx bxs-trash'></i>
                                    <h4>hapus</h4>
                                </button>
                            </div>
                        </article>
                    </div>
                </figure>
                @endif
                @endforeach
            </div>
        </main>
    </div>
</main>