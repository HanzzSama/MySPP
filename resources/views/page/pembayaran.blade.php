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
                        <input type="text" name="status" value="Lunas">
                        <input type="text" name="tgl_bayar" id="tgl_bayar" readonly>
                        <input class="input-on" type="text" name="bulan_bayar" id="inputHasilRentang" readonly>
                        <input type="text" id="tahun_bayar" name="tahun_bayar" readonly>
                        <input class="input-on" type="text" id="inputTotalSPP" name="jumlah_bayar" readonly>
                        <input type="text" name="uang_sisa" id="uang_sisa" readonly>
                    </div>
                    <div class="input">
                        <label for="">nama</label>
                        <input type="text" placeholder="nama" value="{{ $data->nama }}" readonly>
                    </div>
                    <div class="input">
                        <label for="bulanAwal">Bulan Awal</label>
                        <select id="bulanAwal" onchange="updateBulanAkhir()">
                            <option value="">--Pilih Bulan Bayar--</option>
                            @foreach ($bulanBelumDibayarNama as $index => $bulan)
                            <option value="{{ $index + 1 }}">
                                {{ $bulan }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input">
                        <label for="bulanAkhir">Bulan Akhir (Opsional)</label>
                        <select id="bulanAkhir" onchange="hitungTotalSPP()" disabled>
                            <option value="">Pilih bulan akhir (opsional)</option>
                        </select>
                    </div>
                    <div class="input">
                        <label for="">Nominal</label>
                        <input type="number" id="nominalUang" oninput="cekNominalUang()"
                            placeholder="Masukkan nominal uang" disabled>
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
                                <h3 id="totalSPP">,-</h3>
                            </div>
                            <div id="box-spp">
                                <h4 id="pesanUang"></h4>
                            </div>
                        </article>
                    </div>
                </article>
            </div>
        </main>
    </div>
    <script>
        const biayaPerBulan = 200000;
        const namaBulan = [
            '', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
    
        let totalSPP = 0;

        function tampilkanRentangBulan() {
            const bulanAwal = parseInt(document.getElementById('bulanAwal').value);
            const bulanAkhir = parseInt(document.getElementById('bulanAkhir').value);
            const hasilRentang = document.getElementById('hasilRentang');
            const inputHasilRentang = document.getElementById('inputHasilRentang');
            
            if (!isNaN(bulanAwal) && isNaN(bulanAkhir)) {
                hasilRentang.textContent = `${namaBulan[bulanAwal]}`;
                inputHasilRentang.value = namaBulan[bulanAwal];
            } else if (!isNaN(bulanAwal) && !isNaN(bulanAkhir) && bulanAkhir > bulanAwal) {
                hasilRentang.textContent = `${namaBulan[bulanAwal]} - ${namaBulan[bulanAkhir]}`;
                inputHasilRentang.value = `${namaBulan[bulanAwal]} - ${namaBulan[bulanAkhir]}`;
            } else {
                hasilRentang.textContent = '';
                inputHasilRentang.value = '';
            }
        }
    
        function updateBulanAkhir() {
            const bulanAwal = parseInt(document.getElementById('bulanAwal').value);
            const bulanAkhirSelect = document.getElementById('bulanAkhir');
            const nominalUang = document.getElementById('nominalUang');
    
            bulanAkhirSelect.innerHTML = '<option value="">Pilih bulan akhir (opsional)</option>';
    
            if (!isNaN(bulanAwal)) {
                bulanAkhirSelect.disabled = false;
                nominalUang.disabled = false;
    
                for (let i = bulanAwal + 1; i <= 12; i++) {
                    bulanAkhirSelect.innerHTML += `<option value="${i}">${namaBulan[i]}</option>`;
                }
            } else {
                bulanAkhirSelect.disabled = true;
                nominalUang.value = ''; // Kosongkan input nominal
                nominalUang.disabled = true; // Nonaktifkan input nominal
            }
    
            hitungTotalSPP();
            tampilkanRentangBulan();
        }
    
        function hitungTotalSPP() {
            const bulanAwal = parseInt(document.getElementById('bulanAwal').value);
            const bulanAkhir = parseInt(document.getElementById('bulanAkhir').value);
            const totalSPPElement = document.getElementById('totalSPP');
            const inputTotalSPP = document.getElementById('inputTotalSPP');
    
            if (!isNaN(bulanAwal) && (isNaN(bulanAkhir) || bulanAkhir === '')) {
                totalSPP = biayaPerBulan;
                totalSPPElement.textContent = `${totalSPP.toLocaleString('id-ID')},-`;
            } else if (!isNaN(bulanAwal) && !isNaN(bulanAkhir) && bulanAkhir > bulanAwal) {
                const jumlahBulan = bulanAkhir - bulanAwal + 1;
                totalSPP = jumlahBulan * biayaPerBulan;
                totalSPPElement.textContent = `${totalSPP.toLocaleString('id-ID')},-`;
            } else {
                totalSPP = 0;
                totalSPPElement.textContent = ',-';
            }

            inputTotalSPP.value = totalSPP;
    
            cekNominalUang();
            tampilkanRentangBulan(bulanAwal, bulanAkhir);
        }
    
        function cekNominalUang() {
            const nominalUang = parseInt(document.getElementById('nominalUang').value);
            const pesanUang = document.getElementById('pesanUang');
            const uangSisa = document.getElementById('uang_sisa');
            const boxSpp = document.getElementById('box-spp');
            boxSpp.className = '';
            
            // Reset pesan dan kelas
            pesanUang.style.display = 'flex';
            pesanUang.className = '';

            if (isNaN(nominalUang) || nominalUang <= 0) { uang_sisa.value='' ; return; }
            
            // Jika input kosong atau tidak valid, sembunyikan pesan
            if (isNaN(nominalUang) || nominalUang <= 0) {
                pesanUang.textContent='' ; return;
            } // Hitung selisih uang dan total SPP
                const selisih=nominalUang - totalSPP;
                uang_sisa.value = selisih;
            if (selisih < 0) {
                pesanUang.textContent=`Uang kurang: Rp
                ${Math.abs(selisih).toLocaleString('id-ID')},-`;
                boxSpp.classList.add('kurang');
            } else if (selisih> 0) {
                pesanUang.textContent = `Uang kembali: Rp ${selisih.toLocaleString('id-ID')},-`;
                boxSpp.classList.add('kembali');
            } else {
                pesanUang.textContent = 'Uang pas';
                boxSpp.classList.add('pas');
            }
        }

        // Fungsi Mengisi Tanggal dan Tahun Bayar
        function setTanggalDanTahunBayar() {
        const tgl_bayar = document.getElementById('tgl_bayar');
        const tahun_bayar = document.getElementById('tahun_bayar');
        const today = new Date();
        
        // Set Tanggal dan Tahun
        tgl_bayar.value = today.toISOString().split('T')[0];
        tahun_bayar.value = today.getFullYear();
        }
        
        // Panggil Fungsi Saat Load Halaman
        window.onload = function() {
        setTanggalDanTahunBayar();
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