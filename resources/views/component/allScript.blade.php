<script>
    document.addEventListener("DOMContentLoaded", function () {
            const toggleDarkMode = document.getElementById("toggleDarkMode");

            // Cek mode dari localStorage
            if (localStorage.getItem("theme") === "dark") {
                document.documentElement.classList.add("dark");
            }

            toggleDarkMode.addEventListener("click", function () {
                if (document.documentElement.classList.contains("dark")) {
                    document.documentElement.classList.remove("dark");
                    localStorage.setItem("theme", "light");
                } else {
                    document.documentElement.classList.add("dark");
                    localStorage.setItem("theme", "dark");
                }
            });
        });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const alertBox = document.getElementById("alert");

        // Auto-hide setelah 3 detik
        setTimeout(() => {
        alertBox.classList.add("hidden");
        setTimeout(() => alertBox.style.display = "none", 500);
        }, 3000); // 3000ms = 3 detik

        // Klik untuk menutup manual
        alertBox.addEventListener("click", function () {
        alertBox.classList.add("hidden");
        setTimeout(() => alertBox.style.display = "none", 500);
        });
        });
</script>
<script>
    let nav = document.querySelector("#nav-page");
        let btn_nav = document.querySelector("#btn-nav");

        btn_nav.onclick = function(){
            nav.classList.toggle("open-sidebar");
        }
</script>
<script>
    function toggleContent(activeIds) {
        let allContents = document.querySelectorAll('.content');

        // Sembunyikan semua content terlebih dahulu
        allContents.forEach(content => {
        content.classList.remove('active');
        });

        // Tampilkan hanya content yang dipilih
        activeIds.forEach(id => {
        let element = document.getElementById(id);
        if (element) {
        element.classList.add('active');
        }
        });
        }

        // Set default active saat halaman dimuat
        document.addEventListener("DOMContentLoaded", function() {
        toggleContent(['home', 'searchForm']);
        });
</script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const students = document.querySelectorAll(".card-siswa");
        const daftarSiswaContainer = document.getElementById("home");

        function animateStudents() {
        students.forEach((student, index) => {
        let baseDelay = 200; // Delay awal (0.2s)
        let incrementalDelay = 150; // Tambahan delay per item (0.15s)
        let fixedDelay = baseDelay + (index * incrementalDelay); // Delay tetap berdasarkan indeks

        let baseDuration = 0.6; // Durasi dasar animasi (0.6s)
        let durationIncrement = 0.1; // Tambahan durasi per item (0.1s)
        let fixedDuration = baseDuration + (index * durationIncrement); // Durasi tetap per item

        setTimeout(() => {
        student.style.opacity = "1";
        student.style.transform = "scale(1) translateY(0)";
        student.style.animation = `fadeInUp ${fixedDuration}s ease-out forwards`;
        }, fixedDelay);
        });
        }

        function resetStudents() {
        students.forEach(student => {
        student.style.opacity = "0";
        student.style.transform = "scale(0.8) translateY(50px)";
        student.style.animation = "none"; // Hentikan animasi saat tidak aktif
        });
        }

        function checkAndAnimate() {
        if (daftarSiswaContainer.classList.contains("active")) {
        requestAnimationFrame(() => {
        animateStudents();
        });
        } else {
        resetStudents();
        }
        }

        // Observer untuk mendeteksi perubahan class "active" pada #home
        const observer = new MutationObserver(checkAndAnimate);
        observer.observe(daftarSiswaContainer, { attributes: true, attributeFilter: ["class"] });

        // Set kondisi awal saat halaman di-refresh
        resetStudents();
        setTimeout(() => {
        if (daftarSiswaContainer.classList.contains("active")) {
        animateStudents();
        }
        }, 300); // Delay kecil agar layout stabil sebelum animasi mulai
        });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchButton = document.getElementById("searchButton");
        const searchInput = document.getElementById("searchInput");
        const kelasInput = document.getElementById("kelas");
        const jurusanInput = document.getElementById("jurusan");

        // Function to filter students based on name, class, and major
        function filterSiswa() {
        const siswaList = document.querySelectorAll(".card-siswa");
        const searchTerm = searchInput.value.toLowerCase();
        const selectedKelas = kelasInput.value;
        const selectedJurusan = jurusanInput.value;

        siswaList.forEach((siswa) => {
        const siswaName = siswa.querySelector(".name-siswa h4").textContent.toLowerCase();
        const siswaKelas = siswa.getAttribute('data-filter-kelas');
        const siswaJurusan = siswa.getAttribute('data-filter-jurusan');

        // Check if the student's name matches the search term
        const nameMatches = siswaName.includes(searchTerm);
        // Check if the class and major match the selected filters
        const classMatches = !selectedKelas || selectedKelas === siswaKelas;
        const majorMatches = !selectedJurusan || selectedJurusan === siswaJurusan;

        // Show or hide the student based on the filters and search term
        if (nameMatches && classMatches && majorMatches) {
        siswa.style.display = 'flex';
        } else {
        siswa.style.display = 'none';
        }
        });
        }

        // Add event listeners for the filters and search button
        kelasInput.addEventListener('change', filterSiswa);
        jurusanInput.addEventListener('change', filterSiswa);
        searchButton.addEventListener('click', filterSiswa);
        searchInput.addEventListener('keyup', filterSiswa); // Real-time filtering as you type

        // Initial filter on page load
        filterSiswa();
        });
</script>
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