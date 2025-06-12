<x-admin>
    <div class="container-fluid">
        <h4 class="mb-4">Detail Tahun Ajaran</h4>

        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-6">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tahun Ajaran</label>
                            <p>{{ $tahunajaran->tahun_ajar }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Deskripsi</label>
                            <p>{{ $tahunajaran->deskripsi ?? '-' }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Status</label>
                            <p>
                                @if($tahunajaran->status == 'aktif')
                                    <span class="badge bg-success text-white">Aktif</span>
                                @else
                                    <span class="badge bg-secondary text-white">Tidak Aktif</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Dokumen</label>
                            @if ($tahunajaran->dokumen)
                                <div class="form-control bg-light d-flex justify-content-between align-items-center">
                                    <span>{{ $tahunajaran->dokumen }}</span>
                                    <a href="{{ url('public/app/data-tahun-ajaran/'.$tahunajaran->dokumen) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="ti ti-eye"></i> Lihat
                                    </a>
                                </div>
                            @else
                                <p class="form-control bg-light">Tidak ada dokumen diunggah</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="d-flex gap-2">
            <a href="{{ url('admin/tahun-ajaran') }}" class="btn btn-outline-secondary">
                <i class="ti ti-arrow-left"></i> Kembali
            </a>
            <a href="{{ url('admin/tahun-ajaran/'.$tahunajaran->id.'/edit') }}" class="btn btn-warning">
                <i class="ti ti-pencil"></i> Edit Data
            </a>
        </div>
    </div>
</x-admin>
