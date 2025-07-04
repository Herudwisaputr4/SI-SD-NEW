<x-admin>
    <div class="container-fluid">
        <h4 class="mb-4">Detail Mata Pelajaran</h4>

        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-6">
                    <div class="card-body">

                        <div class="mb-3">
                            <label class="form-label fw-bold">Kelompok</label>
                            <p class="text-capitalize">{{ $mapel->kelompok }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Tingkatan</label>
                            <p class="text-capitalize">{{ $mapel->tingkatan }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Mapel</label>
                            <p>{{ $mapel->nama_mapel }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Guru Pengampu</label>
                            <p>{{ $mapel->guru->username ?? '-' }} ({{ $mapel->guru->nip ?? '-' }})</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Keterangan</label>
                            <p>{{ $mapel->keterangan ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="d-flex gap-2">
            <a href="{{ url('admin/mapel') }}" class="btn btn-outline-secondary" aria-label="Kembali ke daftar Mapel">
                <i class="ti ti-arrow-left"></i> Kembali
            </a>
            <a href="{{ url('admin/mapel/edit/' . $mapel->id) }}" class="btn btn-warning" aria-label="Edit data Mapel">
                <i class="ti ti-pencil"></i> Edit Data
            </a>
        </div>
    </div>
</x-admin>
