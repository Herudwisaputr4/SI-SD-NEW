<x-admin>
    <div class="container-fluid mt-4">

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @error('file')
            <small class="text-danger">{{ $message }}</small>
        @enderror

        <!-- Tombol Tambah dan Import/Export -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ url('admin/tahun-ajaran/create') }}" class="btn btn-success me-2">
                <i class="ti ti-plus"></i> Tambah Data
            </a>
        </div>

        <!-- Search -->
        <div class="mb-3">
            <form method="GET" action="{{ url('admin/tahun-ajaran') }}" id="searchForm">
                <div class="input-group">
                    <input type="text" name="search" id="searchInput" class="form-control" placeholder="Cari tahun ajaran..." value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit">
                        <i class="ti ti-search"></i> Cari
                    </button>
                </div>
            </form>
        </div>

        <!-- Tabel Data Tahun Ajaran -->
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th style="width: 40px;">No</th>
                        <th style="width: 180px;">Aksi</th>
                        <th>Tahun Ajaran</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tahun_ajarans as $tahunajaran)
                    @if ( Auth::guard('admin')->user()->sekolah_id == $tahunajaran->sekolah_id)
                        <tr>
                            <td>{{ ($tahun_ajarans->currentPage() - 1) * $tahun_ajarans->perPage() + $loop->iteration }}</td>
                                                        <td>
                                <a href="{{ url('admin/tahun-ajaran/show/'.$tahunajaran->id) }}" class="btn btn-info btn-sm mb-1">
                                    <i class="fs-5 ti ti-file-description"></i>
                                </a>
                                <a href="{{ url('admin/tahun-ajaran/edit/'.$tahunajaran->id) }}" class="btn btn-warning btn-sm mb-1">
                                    <i class="fs-5 ti ti-edit"></i>
                                </a>
                                <form action="{{ url('admin/tahun-ajaran/destroy/'.$tahunajaran->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm mb-1">
                                        <i class="fs-5 ti ti-trash"></i>
                                    </button>
                                </form>
                            </td>
                            <td>{{ $tahunajaran->tahun_ajar }}</td>
                            <td>{{ $tahunajaran->deskripsi }}</td>
                            <td>
                                @if ($tahunajaran->status === 'aktif')
                                    <span class="badge bg-success text-white">{{ ucfirst($tahunajaran->status) }}</span>
                                @else
                                    <span class="badge bg-danger text-white">{{ ucfirst($tahunajaran->status) }}</span>
                                @endif
                            </td>
                        </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-3">{{ $tahun_ajarans->links() }}</div>
    </div>
</x-admin>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e){
            e.preventDefault();
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data tahun ajaran akan dihapus permanen!",
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

    const searchInput = document.getElementById('searchInput');
    const searchForm = document.getElementById('searchForm');
    let debounceTimeout;

    searchInput.addEventListener('input', () => {
        clearTimeout(debounceTimeout);
        debounceTimeout = setTimeout(() => {
            searchForm.submit();
        }, 500);
    });
</script>
