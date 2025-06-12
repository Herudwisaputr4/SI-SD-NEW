<x-admin>
    <div class="container-fluid">
        <h4 class="mb-4">Detail Data Kelas</h4>
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    {{-- Tingkatan --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Tingkatan</label>
                        <p class="form-control-plaintext">{{ $kelas->tingkatan }}</p>
                    </div>

                    {{-- Nama Kelas --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Nama Kelas</label>
                        <p class="form-control-plaintext">{{ $kelas->nama_kelas }}</p>
                    </div>

                    {{-- Wali Kelas --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Wali Kelas</label>
                        <p class="form-control-plaintext">
                            {{ $kelas->waliKelas->nama ?? $kelas->waliKelas->username ?? '-' }}
                        </p>
                    </div>

                    {{-- Tahun Ajaran --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Tahun Ajaran</label>
                        <p class="form-control-plaintext">
                            {{ $kelas->tahunAjaran->tahun_ajar ?? '-' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="d-flex gap-2">
            <a href="{{ url('admin/kelas') }}" class="btn btn-outline-secondary" aria-label="Kembali ke daftar guru">
                <i class="ti ti-arrow-left"></i> Kembali
            </a>
            <a href="{{ url('admin/kelas/edit/' . $kelas->id) }}" class="btn btn-warning" aria-label="Edit data guru">
                <i class="ti ti-pencil"></i> Edit Data
            </a>
        </div>
    </div>
</x-admin>
