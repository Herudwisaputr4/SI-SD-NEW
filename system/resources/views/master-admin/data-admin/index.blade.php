<x-master-admin>
    <div class="container-fluid mt-4">
        <!-- Button Tambah Data -->
        <div class="mb-3">
            <a href="{{ url('master-admin/data-admin/create') }}" class="btn btn-success">
                <i class="ti ti-plus"></i> Tambah Data
            </a>
        </div>

        <!-- Form Search -->
        <div class="mb-3">
            <form method="GET" action="{{ url('master-admin/data-admin') }}" id="searchForm">
                <div class="input-group">
                    <input type="text" name="search" id="searchInput" class="form-control" placeholder="Cari data admin..." value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit">
                        <i class="ti ti-search"></i> Cari
                    </button>
                </div>
            </form>
        </div>

        <!-- Table Data Admin (responsive) -->
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th style="width: 40px;">No</th>
                        <th style="width: 180px;">Aksi</th>
                        <th>Asal Sekolah</th>
                        <th>Foto Profil</th>
                        <th>Nama</th>
                        <th>Nomor HP</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($admins as $index => $admin)
                    <tr>
                        <td>{{ ($admins->currentPage() - 1) * $admins->perPage() + $loop->iteration }}</td>
                        <td>
                            <a href="{{ url('master-admin/data-admin/show/'.$admin->id) }}" class="btn btn-info btn-sm mb-1">
                                <i class="fs-5 ti ti-file-description"></i>
                            </a>
                            <a href="{{ url('master-admin/data-admin/edit/'.$admin->id) }}" class="btn btn-warning btn-sm mb-1">
                                <i class="fs-5 ti ti-edit"></i>
                            </a>
                            <form action="{{ url('master-admin/data-admin/destroy/'.$admin->id) }}" method="POST" class="d-inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm mb-1">
                                    <i class="fs-5 ti ti-trash"></i>
                                </button>
                            </form>
                        </td>
                        <td>{{ $admin->sekolahs ? $admin->sekolahs->nama_sekolah: "Belum Ditambahkan" }}</td>
                        <td class="text-center align-middle">
                            <div class="mx-auto" style="width: 70px;">
                                <div class="ratio ratio-1x1">
                                    <img src="{{ url('public/app/data-admin/' . $admin->foto_profil) }}"
                                        alt="Foto Profil"
                                        class="img-fluid rounded border"
                                        style="object-fit: cover;" />
                                </div>
                            </div>
                        </td>
                        <td>{{ $admin->username }}</td>
                        <td>{{ $admin->phone }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data admin.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-3">
        <div class="mb-2 mb-md-0">
            <span>Menampilkan {{ $admins->firstItem() }} sampai {{ $admins->lastItem() }} dari
                {{ $admins->total() }} data</span>
        </div>
        <div>
            {{ $admins->links('pagination::bootstrap-5') }}
        </div>
    </div>

</x-master-admin>

<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // SweetAlert delete confirmation
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e){
            e.preventDefault();
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data admin akan dihapus secara permanen!",
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