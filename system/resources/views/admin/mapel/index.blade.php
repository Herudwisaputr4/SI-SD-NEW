<x-admin>
    <div class="container-fluid mt-4">

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Tombol Tambah -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ url('admin/mapel/create') }}" class="btn btn-success me-2">
                <i class="ti ti-plus"></i> Tambah Data
            </a>
        </div>

        <!-- Search -->
        <div class="mb-3">
            <form method="GET" action="{{ url('admin/mapel') }}" id="searchForm">
                <div class="row g-2">
                    <div class="col-md-3">
                        <select name="tingkatan" id="tingkatan" class="form-select">
                            <option value="">Semua Tingkatan</option>
                            @for ($i = 1; $i <= 6; $i++)
                                <option value="{{ $i }}" {{ request('tingkatan') == $i ? 'selected' : '' }}>Kelas {{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-9">
                        <div class="input-group">
                            <input type="text" name="search" id="searchInput" class="form-control" placeholder="Cari mapel..." value="{{ request('search') }}">
                            <button class="btn btn-primary" type="submit">
                                <i class="ti ti-search"></i> Cari
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Tabel Data Mapel -->
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th style="width: 40px;">No</th>
                        <th style="width: 180px;">Aksi</th>
                        <th>Kelompok</th>
                        <th>Tingkatan</th>
                        <th>Nama Mapel</th>
                        <th>Guru Pengampu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mapels as $mapel)
                    @if ( Auth::guard('admin')->user()->sekolah_id == $mapel->sekolah_id)
                        <tr>
                            <td>{{ ($mapels->currentPage() - 1) * $mapels->perPage() + $loop->iteration }}</td>
                            <td>
                                <a href="{{ url('admin/mapel/show/'.$mapel->id) }}" class="btn btn-info btn-sm mb-1">
                                    <i class="fs-5 ti ti-file-description"></i>
                                </a>
                                <a href="{{ url('admin/mapel/edit/'.$mapel->id) }}" class="btn btn-warning btn-sm mb-1">
                                    <i class="fs-5 ti ti-edit"></i>
                                </a>
                                <form action="{{ url('admin/mapel/destroy/'.$mapel->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm mb-1">
                                        <i class="fs-5 ti ti-trash"></i>
                                    </button>
                                </form>
                            </td>
                            <td class="text-capitalize">{{ $mapel->kelompok }}</td>
                            <td class="text-capitalize">{{ $mapel->tingkatan }}</td>
                            <td>{{ $mapel->nama_mapel }}</td>
                            <td>{{ $mapel->guru->username ?? '-' }}</td>
                        </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-3">
        <div class="mb-2 mb-md-0">
            <span>Menampilkan {{ $mapels->firstItem() }} sampai {{ $mapels->lastItem() }} dari {{ $mapels->total() }} data</span>
        </div>
        <div>
            {{ $mapels->links('pagination::bootstrap-5') }}
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Konfirmasi hapus
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Data mapel akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // Auto submit saat mengetik di input search
        const searchInput = document.getElementById('searchInput');
        const searchForm = document.getElementById('searchForm');
        let debounceTimeout;

        searchInput.addEventListener('input', () => {
            clearTimeout(debounceTimeout);
            debounceTimeout = setTimeout(() => {
                searchForm.submit();
            }, 500);
        });

        // Auto submit saat ganti tingkatan
        const tingkatanSelect = document.getElementById('tingkatan');
        tingkatanSelect.addEventListener('change', () => {
            searchForm.submit();
        });
    </script>
    @endpush

</x-admin>
