<x-admin>
    <div class="container-fluid">
        <h4 class="mb-4">Detail Data Kelas</h4>

        {{-- Informasi Kelas --}}
        <div class="card mb-3">
            <div class="card-body py-2 px-3">
                <div class="row g-2 text-sm">
                    {{-- Tingkatan --}}
                    <div class="col-md-3">
                        <label class="form-label fw-bold small mb-1">Tingkatan</label>
                        <div class="text-muted border rounded px-2 py-1 small bg-light" style="min-height: 34px;">
                            {{ $kelas->tingkatan }}
                        </div>
                    </div>

                    {{-- Nama Kelas --}}
                    <div class="col-md-3">
                        <label class="form-label fw-bold small mb-1">Nama Kelas</label>
                        <div class="text-muted border rounded px-2 py-1 small bg-light" style="min-height: 34px;">
                            {{ $kelas->nama_kelas }}
                        </div>
                    </div>

                    {{-- Wali Kelas --}}
                    <div class="col-md-3">
                        <label class="form-label fw-bold small mb-1">Wali Kelas</label>
                        <div class="text-muted border rounded px-2 py-1 small bg-light" style="min-height: 34px;">
                            {{ $kelas->waliKelas->nama ?? $kelas->waliKelas->username ?? '-' }}
                        </div>
                    </div>

                    {{-- Tahun Ajaran --}}
                    <div class="col-md-3">
                        <label class="form-label fw-bold small mb-1">Tahun Ajaran</label>
                        <div class="text-muted border rounded px-2 py-1 small bg-light" style="min-height: 34px;">
                            {{ $kelas->tahunAjaran->tahun_ajar ?? '-' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Daftar Siswa --}}
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="mb-0 fw-bold">Daftar Siswa dalam Kelas Ini</h6>
            </div>
            <div class="card-body table-responsive">
                <p class="text-muted small mb-3">
                    <i class="ti ti-users"></i> Total Siswa: <strong>{{ $kelas->siswa->count() }}</strong>
                </p>

                @if($kelas->siswa->isEmpty())
                    <p class="text-muted small">Belum ada siswa yang tergabung dalam kelas ini.</p>
                @else
                    <table class="table table-sm table-bordered table-hover text-sm align-middle table-nowrap">
                        <thead class="table-light text-center small">
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th style="width: 25%;">Nama</th>
                                <th style="width: 15%;">NISN</th>
                                <th style="width: 10%;">L/P</th>
                                <th>Alamat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($siswaPaginate as $index => $siswa)
                                <tr>
                                    <td class="text-center">{{ ($siswaPaginate->currentPage() - 1) * $siswaPaginate->perPage() + $index + 1 }}</td>
                                    <td class="text-nowrap">{{ $siswa->nama_siswa }}</td>
                                    <td class="text-nowrap">{{ $siswa->nisn }}</td>
                                    <td>{{ $siswa->jenis_kelamin }}</td>
                                    <td class="text-nowrap">{{ $siswa->alamat }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- Pagination --}}
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-3">
                        <div class="mb-2 mb-md-0 small text-muted">
                            <span>Menampilkan {{ $siswaPaginate->firstItem() }} sampai {{ $siswaPaginate->lastItem() }} dari
                                {{ $siswaPaginate->total() }} data</span>
                        </div>
                        <div>
                            {{ $siswaPaginate->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                @endif
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
