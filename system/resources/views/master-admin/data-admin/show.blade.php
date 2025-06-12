<x-master-admin>
    <div class="container-fluid">
        <h4 class="mb-4">Detail Data Admin</h4>

        <div class="card mb-3">
            <div class="row g-0">
                <!-- Detail Data -->
                <div class="col-md-8">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama</label>
                            <p>{{ $admin->username }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Email</label>
                            <p>{{ $admin->email }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nomor HP</label>
                            <p>{{ $admin->phone }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Asal Sekolah</label>
                            <p>{{ $admin->sekolahs ? $admin->sekolahs->nama_sekolah : 'Belum Ditambahkan' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Foto Profil -->
                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                    <div class="card-body p-3 text-center">
                        @if ($admin->foto_profil)
                            <img src="{{ url('public/app/data-admin/' . $admin->foto_profil) }}" 
                                alt="Foto Profil" class="img-fluid rounded" style="max-width: 120px;">
                        @else
                            <p>Foto Profil tidak tersedia.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ url('master-admin/data-admin') }}" class="btn btn-outline-secondary" aria-label="Kembali ke daftar Admin">
                <i class="ti ti-arrow-left"></i> Kembali
            </a>
            <a href="{{ url('master-admin/data-admin/edit/' . $admin->id) }}" class="btn btn-warning" aria-label="Edit data Admin">
                <i class="ti ti-pencil"></i> Edit Data
            </a>
        </div>
    </div>
</x-master-admin>
