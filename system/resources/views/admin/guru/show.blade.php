<x-admin>
    <div class="container-fluid">
        <h4 class="mb-4">Detail Data Guru</h4>
        <div class="card mb-3">
            <div class="row g-0">
                <!-- Detail Data -->
                <div class="col-md-4">
                    <div class="card-body">
                        <div class="mb-3">
                             @if ($guru->foto_profil)
                                    <img src="{{ url('public/app/data-guru/' . $guru->foto_profil) }}" alt="Foto guru"
                                        class="img-fluid rounded" style="max-width: 120px;">
                                @else
                                    <p>Foto guru tidak tersedia.</p>
                                @endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama</label>
                            <p>{{ $guru->username }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">NIP</label>
                            <p>{{ $guru->nip }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Jenis Kelamin</label>
                            <p>{{ $guru->jenis_kelamin }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Agama</label>
                            <p>{{ $guru->agama }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tempat Lahir</label>
                            <p>{{ $guru->tempat_lahir }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Alamat</label>
                            <p>{{ $guru->alamat }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Status</label>
                            <p>{{ $guru->status }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">No Telepon</label>
                            <p>{{ $guru->no_telepon }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Email</label>
                            <p>{{ $guru->email }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Alamat</label>
                            <p>{{ $guru->alamat }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Jabatan</label>
                            <p>{{ $guru->jabatan }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Pendidikan Terakhir</label>
                            <p>{{ $guru->pendidikan_terakhir }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tahun Masuk</label>
                            <p>{{ $guru->tahun_masuk }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tombol Aksi -->
        <div class="d-flex gap-2">
            <a href="{{ url('admin/guru') }}" class="btn btn-outline-secondary" aria-label="Kembali ke daftar guru">
                <i class="ti ti-arrow-left"></i> Kembali
            </a>
            <a href="{{ url('admin/guru/edit/' . $guru->id) }}" class="btn btn-warning" aria-label="Edit data guru">
                <i class="ti ti-pencil"></i> Edit Data
            </a>
        </div>    
    </div>
</x-admin>