<main class="container-data-analyzing content" id="data-analyzing">
    <div>
        <article class="title-data">
            <h3>data analisa</h3>
        </article>
        <main class="container-data-count">
            <div>
                <figure class="card-data-count">
                    <div>
                        <article class="icon-data">
                            <i class='bx bx-money'></i>
                        </article>
                        <article class="desc-data">
                            <h5>Total SPP</h5>
                            <div class="total-spp">
                                <h5>Rp.</h5>
                                <h4>{{ number_format($total_spp, 0, ',', '.') }},-</h4>
                            </div>
                            <h6>total seluruh uang SPP</h6>
                        </article>
                    </div>
                </figure>
                <figure class="card-data-count">
                    <div>
                        <article class="icon-data">
                            <i class='bx bx-user'></i>
                        </article>
                        <article class="desc-data">
                            <h5>jumlah user</h5>
                            <h4>{{ $users->count() }}</h4>
                            <h6>total seluruh user</h6>
                        </article>
                    </div>
                </figure>
                <figure class="card-data-count">
                    <div>
                        <article class="icon-data">
                            <i class='bx bx-user'></i>
                        </article>
                        <article class="desc-data">
                            <h5>jumlah petugas</h5>
                            <h4>{{ $jumlah_petugas }}</h4>
                            <h6>total seluruh petugas</h6>
                        </article>
                    </div>
                </figure>
                <figure class="card-data-count">
                    <div>
                        <article class="icon-data">
                            <i class='bx bx-user'></i>
                        </article>
                        <article class="desc-data">
                            <h5>jumlah siswa</h5>
                            <h4>{{ $siswa->count() }}</h4>
                            <h6>total seluruh siswa</h6>
                        </article>
                    </div>
                </figure>
            </div>
        </main>
    </div>
</main>