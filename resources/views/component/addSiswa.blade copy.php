<form action="{{ route('dashboard.store') }}" class="add-main" method="POST">
    @csrf
    <article class="title-add">
        <h3>tambah data siswa</h3>
    </article>
    <header class="form-input-siswa">
        <div>
            <div>
                <figure class="input">
                    <input type="text" name="nama" placeholder="Nama Siswa">
                </figure>
                <figure class="input">
                    <input type="text" name="no_telp" placeholder="No Telp">
                </figure>
            </div>
            <div>
                <figure class="input">
                    <select name="" id="id_kls">
                        <option value="1">10</option>
                        <option value="2">11</option>
                        <option value="3">12</option>
                    </select>
                </figure>
                <figure class="input">
                    <input type="text" name="nisn" placeholder="NISN">
                </figure>
            </div>
            <div>
                <figure class="input">
                    <select id="jrs">
                        <option value="">-- Pilih Jurusan --</option>
                        <!-- Jurusan akan diisi berdasarkan kelas yang dipilih -->
                    </select>
                </figure>
            </div>
            <div>
                <figure class="input">
                    <textarea name="alamat" id="" placeholder="Alamat"></textarea>
                </figure>
            </div>
            <div>
                <p>ID Kelas: <span id="id_value">1</span></p>
            </div>
            <input type="hidden" name="id_kls" id="id_kelas_input" value="1">
            <div class="btn-submit">
                <button type="submit">kirim</button>
            </div>
        </div>
    </header>
</form>
<script>
    const jurusanData = [
        { value: "rpl", text: "Rekayasa Perangkat Lunak" },
        { value: "tei", text: "Teknik Elektronik Industri" },
        { value: "tkj", text: "Teknik Komputer Jaringan" },
        { value: "tkr", text: "Teknik Kendaraan Ringan" },
        { value: "tb", text: "Tata Busana" },
        { value: "tp", text: "Teknik Permesinan" },
        { value: "tpsb", text: "Teknik Pemintalan Serat Buatan" }
    ];

    const idKlsSelect = document.getElementById("id_kls");
    const jurusanSelect = document.getElementById("jrs");
    const idValue = document.getElementById("id_value");
    const idKelasInput = document.getElementById("id_kelas_input");

    function updateJurusan() {
        jurusanSelect.innerHTML = ""; // Kosongkan dropdown jurusan

        jurusanData.forEach((jurusan, index) => {
            const option = document.createElement("option");
            option.value = jurusan.value;
            option.textContent = jurusan.text;
            jurusanSelect.appendChild(option);
        });

        updateID(); // Perbarui ID otomatis setelah jurusan diperbarui
    }

    function updateID() {
        const selectedKelas = parseInt(idKlsSelect.value);
        const selectedJurusanIndex = jurusanSelect.selectedIndex + 1; // Indeks mulai dari 1

        if (selectedJurusanIndex > 0) {
            const uniqueID = (selectedKelas - 1) * 7 + selectedJurusanIndex; // ID unik (1-21)
            idValue.textContent = uniqueID; // Menampilkan ID di halaman
            idKelasInput.value = uniqueID; // Memasukkan ID ke input hidden
        }
    }

    idKlsSelect.addEventListener("change", updateJurusan);
    jurusanSelect.addEventListener("change", updateID);

    // Set data awal saat halaman dimuat
    updateJurusan();
</script>