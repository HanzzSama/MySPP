<form id="searchForm" class="filter-src content active">
    <div>
        <figure class="card-src card-filter">
            <div>
                <select id="kelas" name="kelas">
                    <option value="">-- Pilih Kelas --</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>
            </div>
            <div>
                <select id="jurusan" name="jurusan">
                    <option value="">-- Pilih Jurusan --</option>
                    {{-- @foreach($jurusan as $jrs)
                    <option value="{{ strtolower($jrs) }}" style="text-transform: capitalize;">
                        {{ $jrs }}
                    </option>
                    @endforeach --}}
                </select>
            </div>
        </figure>
        <figure class="card-src card-search">
            <div>
                <input type="text" id="searchInput" placeholder="Search by name" onkeyup="filterNames()" />
            </div>
            <div>
                <button id="searchButton">Cari</button>
            </div>
        </figure>
    </div>
</form>