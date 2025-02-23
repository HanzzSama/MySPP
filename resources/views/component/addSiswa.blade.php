<main class="container-add-siswa content" id="formAdd">
    <div>
        <article class="title-add-siswa">
            <h3>tambah data siswa</h3>
        </article>
        <main class="form-add-siswa">
            <form action="{{ route('dashboard.store') }}" method="POST">
                @csrf
                <figure class="input">
                    <input type="text" id="namaSiswa" name="nama" placeholder="Nama Siswa" oninput="generateEmail()">
                </figure>
                <figure class="input">
                    <input type="text" name="no_telp" placeholder="No Telp">
                </figure>
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
                <figure class="input">
                    <select id="jrs">
                        <option value="">-- Pilih Jurusan --</option>
                        <!-- Jurusan akan diisi berdasarkan kelas yang dipilih -->
                    </select>
                </figure>
                <figure class="input">
                    <textarea name="alamat" id="" placeholder="Alamat"></textarea>
                </figure>
                <div>
                    <p>ID Kelas: <span id="id_value">1</span></p>
                </div>
                <input type="hidden" name="role" value="siswa">
                <input type="hidden" name="email" id="emailSiswa" value="">
                <input type="hidden" name="password" value="123456">
                {{-- <input type="hidden" name="id_user" value="{{ $nextUserId }}"> --}}
                <input type="hidden" name="id_kls" id="id_kelas_input" value="1">
                <div class="btn-submit">
                    <button type="submit">kirim</button>
                </div>
            </form>
        </main>
    </div>
    @if ($errors->any())
    <div class="pop-error">
        <ul>
            @foreach ($errors->all() as $error)
            <li style="color: yellow">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</main>
<script>
    function generateEmail() {
    let nama = document.getElementById("namaSiswa").value.trim().toLowerCase();
    if (nama !== "") {
        let email = nama.replace(/\s+/g, '') + "@gmail.com"; // Hapus spasi dan tambahkan domain
        document.getElementById("emailSiswa").value = email;
    } else {
        document.getElementById("emailSiswa").value = "";
    }
}
</script>
