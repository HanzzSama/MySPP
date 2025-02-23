<main class="card-header-siswa profile-siswa">
    <section class="cover">
        <div class="icon">
            <i class='bx bx-user-circle'></i>
        </div>
    </section>
    <div>
        <article class="title-profile">
            <h3>profile siswa</h3>
        </article>
        <main class="card-profile">
            <div>
                <section class="profile-iden">
                    <figure class="profile-name">
                        <h3>{{ Auth::user()->nama }} - <b>{{ Auth::user()->siswa->nis }}</b></h3>
                    </figure>
                    <figure class="profile-kls">
                        <h4>{{ Auth::user()->siswa->kelas->jurusan }}</h4>
                        <h4>( {{ Auth::user()->siswa->kelas->nama_kelas }} -
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

                            $jurusan_full = strtolower(trim(Auth::user()->siswa->kelas->jurusan));
                            $jurusan_singkat = $jurusan_singkatan[$jurusan_full] ?? $jurusan_full;
                            @endphp

                            {{ $jurusan_singkat }}
                            )</h4>
                    </figure>
                </section>
                <figure class="profile-alamat">
                    <div>
                        <i class='bx bx-map'></i>
                        <h4>{{ Auth::user()->alamat }}</h4>
                    </div>
                </figure>
            </div>
        </main>
    </div>
</main>