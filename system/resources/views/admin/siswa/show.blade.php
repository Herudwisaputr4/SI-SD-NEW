<x-admin>
    <div class="container-fluid">
        <h4 class="mb-4">Detail Data Siswa</h4>
        <div class="card mb-3">
            <div class="row g-0">
                <!-- Detail Data -->
                <div class="col-md-4">
                    <div class="card-body">
                        <div class="mb-3">
                             @if ($siswa->foto_siswa)
                                    <img src="{{ url('public/app/data-siswa/' . $siswa->foto_siswa) }}" alt="Foto Siswa"
                                        class="img-fluid rounded" style="max-width: 120px;">
                                @else
                                    <p>Foto Siswa tidak tersedia.</p>
                                @endif
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">NISN</label>
                            <p>{{ $siswa->nisn }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">NIS</label>
                            <p>{{ $siswa->nis }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Siswa</label>
                            <p>{{ $siswa->nama_siswa }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Jenis Pendaftaran</label>
                            <p>{{ $siswa->jenis_pendaftaran }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Jalur Pendaftaran</label>
                            <p>{{ $siswa->jalur_pendaftaran }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tanggal Masuk</label >
                            <p>{{ $siswa->tanggal_masuk }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Status</label>
                            <p>{{ $siswa->status }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Kebutuhan Khusus</label>
                            <p>{{ $siswa->kebutuhan_khusus }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Email</label>
                            <p>{{ $siswa->email }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">NO Kartu Keluarga</label>
                            <p>{{ $siswa->no_kk }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">NIK</label>
                            <p>{{ $siswa->nik }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Jenis Kelamin</label>
                            <p>{{ $siswa->jenis_kelamin }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Agama</label>
                            <p>{{ $siswa->agama }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tempat Lahir</label>
                            <p>{{ $siswa->tempat_lahir }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tanggal Lahir</label>
                            <p>{{ $siswa->tanggal_lahir }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Alamat</label>
                            <p>{{ $siswa->alamat }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">RT</label>
                            <p>{{ $siswa->rt }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">RW</label>
                            <p>{{ $siswa->rw }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Dusun</label>
                            <p>{{ $siswa->dusun }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Desa/Kelurahan</label>
                            <p>{{ $siswa->desa_kelurahan }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Provinsi</label>
                            <p>{{ $siswa->provinsi }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Kabupaten</label>
                            <p>{{ $siswa->kabupaten }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Kecamatan</label>
                            <p>{{ $siswa->kecamatan }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Telepon</label>
                            <p>{{ $siswa->telepon }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tombol Aksi -->
        <div class="d-flex gap-2">
            <a href="{{ url('admin/siswa') }}" class="btn btn-outline-secondary" aria-label="Kembali ke daftar siswa">
                <i class="ti ti-arrow-left"></i> Kembali
            </a>
            <a href="{{ url('admin/siswa/edit/' . $siswa->id) }}" class="btn btn-warning" aria-label="Edit data siswa">
                <i class="ti ti-pencil"></i> Edit Data
            </a>
        </div>        
    </div>
</x-admin>
