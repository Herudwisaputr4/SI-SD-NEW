<x-admin>
    <div class="container-fluid mt-4">
        <!-- Baris atas: Tambah Data dan Import/Export sejajar -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @error('file')
            <small class="text-danger">{{ $message }}</small>
        @enderror

        <div class="d-flex justify-content-between align-items-center mb-3">
            <!-- Button Tambah Data -->
            <a href="{{ url('admin/siswa/create') }}" class="btn btn-success me-2">
                <i class="ti ti-plus"></i> Tambah Data
            </a>

            <!-- Form Import dan Tombol Export -->
            <div class="d-inline-flex align-items-center gap-2">
                <!-- Form Import -->
                <form action="{{ url('admin/siswa/import') }}" method="POST" enctype="multipart/form-data" class="d-flex align-items-center gap-2">
                    @csrf
                    <input type="file" name="file" class="form-control form-control-sm w-auto" accept=".xlsx,.xls,.csv" required>
                    <button type="submit" class="btn btn-success btn-md">
                        <i class="ti ti-download"></i> Import
                    </button>
                </form>

                <!-- Tombol Export -->
                <a href="{{ url('admin/siswa/export') }}" class="btn btn-primary btn-md">
                    <i class="ti ti-upload"></i> Export
                </a>
            </div>
        </div>    
        <!-- Form Search -->
        <div class="mt-3">
            {{ $siswas->links() }}
        </div>
        <div class="mb-3">
            <form method="GET" action="{{ url('admin/siswa') }}" id="searchForm">
                <div class="input-group">
                    <input type="text" name="search" id="searchInput" class="form-control" placeholder="Cari data siswa..." value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit">
                        <i class="ti ti-search"></i> Cari
                    </button>
                </div>
            </form>
        </div>

        <!-- Table Data siswa (responsive) -->
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>NISN</th>
                        <th>Nama Siswa</th>
                        <th>Sekolah</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($siswas as $index => $siswa)
                    @if ( Auth::guard('admin')->user()->sekolah_id == $siswa->sekolah_id)
                    <tr>
                        <td>{{ ($siswas->currentPage() - 1) * $siswas->perPage() + $loop->iteration }}</td>
                        <td>{{ $siswa->nisn }}</td>
                        <td>{{ $siswa->nama_siswa }}</td>
                        <td>{{ $siswa->sekolah->nama_sekolah }}</td>
                        <td>{{ $siswa->alamat }}</td>
                        <td>
                            <a href="{{ url('admin/siswa/show/'.$siswa->id) }}" class="btn btn-info btn-sm mb-1">
                                <i class="fs-5 ti ti-file-description"></i>
                            </a>
                            <a href="{{ url('admin/siswa/edit/'.$siswa->id) }}" class="btn btn-warning btn-sm mb-1">
                                <i class="fs-5 ti ti-edit"></i>
                            </a>
                            <form action="{{ url('admin/siswa/destroy/'.$siswa->id) }}" method="POST" class="d-inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm mb-1">
                                    <i class="fs-5 ti ti-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin>

<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // SweetAlert delete confirmation
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e){
                e.preventDefault();
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Data siswa akan dihapus secara permanen!",
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

        // Live search dengan debounce
        const searchInput = document.getElementById('searchInput');
        const searchForm = document.getElementById('searchForm');
        let debounceTimeout;

        searchInput.addEventListener('input', () => {
            clearTimeout(debounceTimeout);
            debounceTimeout = setTimeout(() => {
                searchForm.submit();
            }, 500); // Waktu debounce 0.5 detik
        });
    </script>