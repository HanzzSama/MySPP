<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="/lib/css/tuition.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <form action="{{ route('pembayaran.store') }}" method="POST" class="draggable form-spp" id="dragItem">
            @csrf
            <div>
                <article class="title-form">
                    <h3>form SPP</h3>
                </article>
                <figure class="data-input">
                    <div class="input-hide">
                        <input type="text" name="id_petugas" value="{{ $data->id }}">
                        <input type="text" name="nisn" value="{{ $data->siswa->nisn }}">
                        <input type="text" name="tgl_bayar" id="tgl_bayar">
                        <input class="input-on" type="text" name="bulan_bayar" id="inputHasilRentang" readonly>
                        <input type="text" id="tahun_bayar" name="tahun_bayar" oninput="formatTahun(this)"
                            onblur="cekTahunKosong()" value="">
                        <input class="input-on" type="text" id="inputTotalSPP" name="jumlah_bayar" readonly>
                    </div>
                    <div class="input">
                        <label for="">nama</label>
                        <input type="text" placeholder="nama" value="{{ $data->nama }}" readonly>
                    </div>
                    <div class="input">
                        <label for="bulanAwal">Bulan Awal</label>
                        <select id="bulanAwal" onchange="updateBulanAkhir()">
                            <option value="">Pilih Bulan Awal</option>
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                    <div class="input">
                        <label for="bulanAkhir">Bulan Akhir</label>
                        <select id="bulanAkhir" onchange="hitungTotalSPP()" disabled>
                            <option value="">Pilih bulan akhir</option>
                        </select>
                    </div>
                    <div class="input">
                        <label for="">Nominal</label>
                        <input type="text" id="nominal" oninput="formatNominal(this); cekPembayaran()" disabled>
                    </div>
                    <div class="btn">
                        <a href="/admin/dashboard">
                            <button><i class='bx bx-left-arrow-alt'></i></button>
                        </a>
                        <button class="btn-submit">kirim</button>
                    </div>
                </figure>
            </div>
        </form>
        @if ($errors->any())
        <section class="list-pop">
            @foreach ($errors->all() as $error)
            <section class="pop-error">
                <div>
                    <h4>error</h4>
                    <h5>{{ $error }}</h5>
                </div>
            </section>
            @endforeach
        </section>
        @endif
        <main class="container-main">
            <div>
                <article class="title-spp">
                    <div>
                        <img src="/img/bot.jpg" alt="">
                        <div>
                            <h2>mySPP</h2>
                            <h4>pembarayan spp sekolah</h4>
                        </div>
                    </div>
                </article>
                <hr>
                <article class="desc">
                    <div>
                        <div class="data">
                            <h4>nama</h4>
                            <p>:</p>
                            <h4>{{ $data->nama }}</h4>
                        </div>
                        <div class="data">
                            <h4>NISN</h4>
                            <p>:</p>
                            <h4>{{ $data->siswa->nis }}</h4>
                        </div>
                        <div class="data">
                            <h4>petugas pembayaran</h4>
                            <p>:</p>
                            <h4>{{ Auth::user()->nama }}</h4>
                        </div>
                        <div class="data">
                            <h4>bulan bayar</h4>
                            <p>:</p>
                            <h4 id="hasilRentang"></h4>
                        </div>
                    </div>
                    <div class="set-spp">
                        <div class="month">
                            <h5 id="tanggal"></h5>
                        </div>
                        <article class="spp">
                            <div>
                                <h5>Rp.</h5>
                                <h3 id="totalSPPDisplay">-,-</h3>
                            </div>
                            <div id="box-spp">
                                <h4 id="infoPembayaran"></h4>
                            </div>
                        </article>
                    </div>
                </article>
            </div>
        </main>
    </div>
    <script>
        function formatTahun(input) {
            let angka = input.value.replace(/\D/g, ""); // Hanya izinkan angka
            input.value = angka.slice(0, 4); // Batasi hanya 4 digit (tahun)
        }

        function cekTahunKosong() {
            let input = document.getElementById("tahun_bayar");
            if (input.value.trim() === "") {
                input.value = new Date().getFullYear(); // Isi dengan tahun saat ini jika kosong
            }
        }

        // Set tahun saat ini saat halaman dimuat
        document.addEventListener("DOMContentLoaded", function () {
            let input = document.getElementById("tahun_bayar");
            if (input.value.trim() === "") {
                input.value = new Date().getFullYear();
            }
        });
    </script>
    <script>
        function tampilkanTanggal() {
                let tanggalSekarang = new Date();
                let hari = tanggalSekarang.getDate();
                let bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
                             "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
                let tahun = tanggalSekarang.getFullYear();

                let tanggalLengkap = `${hari} ${bulan[tanggalSekarang.getMonth()]} ${tahun}`;
                document.getElementById("tanggal").textContent = tanggalLengkap;
            }

            tampilkanTanggal();
    </script>
    <script>
        function setTanggalHariIni() {
                let tanggalSekarang = new Date();
                let hari = String(tanggalSekarang.getDate()).padStart(2, '0'); // Tambahkan nol jika kurang dari 10
                let bulan = String(tanggalSekarang.getMonth() + 1).padStart(2, '0'); // Bulan dimulai dari 0
                let tahun = tanggalSekarang.getFullYear();

                let tanggalFormat = `${tahun}-${bulan}-${hari}`; // Format: YYYY-MM-DD
                document.getElementById("tgl_bayar").value = tanggalFormat;
            }

            setTanggalHariIni();
    </script>
    <script>
        const bulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        const hargaSPP = 120000;
        let totalSPP = 0;

        const bulanAwalSelect = document.getElementById("bulanAwal");
        for (let i = 1; i <= 12; i++) {
            let option = document.createElement("option");
            option.value = i;
            option.textContent = bulan[i];
            bulanAwalSelect.appendChild(option);
        }

        function updateBulanAkhir() {
            let bulanAwal = document.getElementById("bulanAwal").value;
            let bulanAkhir = document.getElementById("bulanAkhir");
            let hasilRentang = document.getElementById("hasilRentang");
            let inputHasilRentang = document.getElementById("inputHasilRentang");
            let totalSPPText = document.getElementById("totalSPPDisplay");
            let inputTotalSPP = document.getElementById("inputTotalSPP");
            let infoPembayaran = document.getElementById("infoPembayaran");
            let nominal = document.getElementById("nominal");

            bulanAkhir.innerHTML = '<option value="">Pilih Bulan Akhir</option>';
            nominal.disabled = true;

            if (bulanAwal !== "") {
                let start = parseInt(bulanAwal) + 1;
                for (let i = start; i <= 12; i++) {
                    let option = document.createElement("option");
                    option.value = i;
                    option.textContent = bulan[i];
                    bulanAkhir.appendChild(option);
                }

                bulanAkhir.disabled = false;
                hasilRentang.textContent = bulan[bulanAwal];
                inputHasilRentang.value = bulan[bulanAwal];

                totalSPP = hargaSPP;
                let formattedSPP = `${totalSPP.toLocaleString("id-ID")}`;

                totalSPPText.textContent = formattedSPP;
                inputTotalSPP.value = formattedSPP;
                infoPembayaran.textContent = "";
                document.getElementById("inputInfoPembayaran").value = "";
            } else {
                bulanAkhir.disabled = true;
                hasilRentang.textContent = "-";
                inputHasilRentang.value = "";
                totalSPPText.textContent = ",-";
                inputTotalSPP.value = "-";
                infoPembayaran.textContent = "";
                document.getElementById("inputInfoPembayaran").value = "";
            }
        }

        function hitungTotalSPP() {
            let bulanAwal = document.getElementById("bulanAwal").value;
            let bulanAkhir = document.getElementById("bulanAkhir").value;
            let hasilRentang = document.getElementById("hasilRentang");
            let inputHasilRentang = document.getElementById("inputHasilRentang");
            let totalSPPText = document.getElementById("totalSPPDisplay");
            let inputTotalSPP = document.getElementById("inputTotalSPP");
            let infoPembayaran = document.getElementById("infoPembayaran");
            let nominal = document.getElementById("nominal");

            if (bulanAkhir === "") {
                nominal.disabled = false;
                hasilRentang.textContent = bulan[bulanAwal];
                inputHasilRentang.value = bulan[bulanAwal];
                totalSPP = hargaSPP;
            } else {
                nominal.disabled = false;
                hasilRentang.textContent = `${bulan[bulanAwal]} - ${bulan[bulanAkhir]}`;
                inputHasilRentang.value = `${bulan[bulanAwal]} - ${bulan[bulanAkhir]}`;
                let jumlahBulan = (bulanAkhir - bulanAwal) + 1;
                totalSPP = hargaSPP * jumlahBulan;
            }

            let formattedSPP = `${totalSPP.toLocaleString("id-ID")}`;
            totalSPPText.textContent = formattedSPP;
            inputTotalSPP.value = formattedSPP;
            infoPembayaran.textContent = "";
            document.getElementById("inputInfoPembayaran").value = "";

            cekPembayaran();
        }

        function cekPembayaran() {
            let nominal = parseInt(document.getElementById("nominal").value.replace(/\D/g, "")) || 0;
            let infoPembayaran = document.getElementById("infoPembayaran");
            let infoPembayaranBox = document.getElementById("box-spp");
            let inputInfoPembayaran = document.getElementById("inputInfoPembayaran");

            if (nominal === 0) {
                infoPembayaran.textContent = "";
                inputInfoPembayaran.value = "";
                return;
            }

            let selisih = nominal - totalSPP;

            if (selisih < 0) {
                infoPembayaran.textContent = `Kekurangan: Rp${Math.abs(selisih).toLocaleString("id-ID")},-`;
                infoPembayaranBox.className = "info kurang";
                inputInfoPembayaran.value = `Kekurangan: Rp${Math.abs(selisih).toLocaleString("id-ID")},-`;
            } else if (selisih > 0) {
                infoPembayaran.textContent = `Kembalian: Rp${selisih.toLocaleString("id-ID")},-`;
                infoPembayaranBox.className = "info kembalian";
                inputInfoPembayaran.value = `Kembalian: Rp${selisih.toLocaleString("id-ID")},-`;
            } else {
                infoPembayaran.textContent = "Pembayaran Pas";
                infoPembayaranBox.className = "info pas";
                inputInfoPembayaran.value = "Pembayaran Pas";
            }
        }

        function formatNominal(input) {
            let angka = input.value.replace(/\D/g, "");
            input.value = angka ? parseInt(angka).toLocaleString("id-ID") : "";
        }
    </script>
    <script>
        const dragItem = document.getElementById("dragItem");
            let offsetX, offsetY, isDragging = false;
            const margin = 13; // Tambahkan margin agar tidak mepet ke tepi

            dragItem.addEventListener("mousedown", (e) => {
                isDragging = true;
                offsetX = e.clientX - dragItem.getBoundingClientRect().left;
                offsetY = e.clientY - dragItem.getBoundingClientRect().top;
                dragItem.style.cursor = "grabbing";
            });

            document.addEventListener("mousemove", (e) => {
                if (!isDragging) return;
                requestAnimationFrame(() => {
                    let newX = e.clientX - offsetX;
                    let newY = e.clientY - offsetY;

                    const maxX = window.innerWidth - dragItem.offsetWidth - margin;
                    const maxY = window.innerHeight - dragItem.offsetHeight - margin;

                    if (newX < margin) newX = margin;
                    if (newY < margin) newY = margin;
                    if (newX > maxX) newX = maxX;
                    if (newY > maxY) newY = maxY;

                    dragItem.style.transform = `translate(${newX}px, ${newY}px)`;
                });
            });

            document.addEventListener("mouseup", () => {
                isDragging = false;
                dragItem.style.cursor = "grab";
            });
    </script>
</body>

</html>