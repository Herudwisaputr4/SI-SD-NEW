<x-master-admin>
    <div class="container-fluid">
        <h4 class="mb-4">Detail Data Sekolah</h4>

        <div class="card mb-3">
            <div class="row g-0">
                <!-- Detail Data -->
                <div class="col-md-4">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Sekolah</label>
                            <p>{{ $sekolah->nama_sekolah }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">NPSN</label>
                            <p>{{ $sekolah->npsn }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Kepala_Sekolah</label>
                            <p>{{ $sekolah->kepala_sekolah }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Akteditasi</label>
                            <p>{{ $sekolah->akreditasi }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Kurikulum</label>
                            <p>{{ $sekolah->kurikulum }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Alamat Lengkap</label>
                            <p>{{ $sekolah->alamat_lengkap }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Email Sekolah</label>
                            <p>{{ $sekolah->email_sekolah }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Telepon Sekolah</label>
                            <p>{{ $sekolah->telepon_sekolah }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Status Sekolah</label>
                            <p>{{ $sekolah->status_sekolah }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Kepemilikan Sekolah</label>
                            <p>{{ $sekolah->kepemilikan_sekolah }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Keaktifan Sekolah</label>
                            <p>{{ $sekolah->keaktifan_sekolah }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Jumlah Pengajar</label>
                            <p>{{ $sekolah->jumlah_pengajar }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Jumlah Siswa</label>
                            <p>{{ $sekolah->jumlah_siswa }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tahun Berdiri</label>
                            <p>{{ $sekolah->tahun_berdiri }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Ruang Kelas</label>
                            <p>{{ $sekolah->ruang_kelas }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Ruang Perpustakaan</label>
                            <p>{{ $sekolah->ruang_perpustakaan }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Ruang Laboratorium</label>
                            <p>{{ $sekolah->ruang_laboratorium }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Ruang Praktik</label>
                            <p>{{ $sekolah->ruang_praktik }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Ruang Pimpinan</label>
                            <p>{{ $sekolah->ruang_pimpinan }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Ruang Guru</label>
                            <p>{{ $sekolah->ruang_guru }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Ruang Ibadah</label>
                            <p>{{ $sekolah->ruang_ibadah }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Ruang UKS</label>
                            <p>{{ $sekolah->ruang_UKS }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Ruang Toilet</label>
                            <p>{{ $sekolah->ruang_toilet }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Ruang Gudang</label>
                            <p>{{ $sekolah->ruang_gudang }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Ruang Olahraga</label>
                            <p>{{ $sekolah->ruang_olahraga }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Ruang TU</label>
                            <p>{{ $sekolah->ruang_tu }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Ruang Konseling</label>
                            <p>{{ $sekolah->ruang_konseling }}</p>
                        </div>
                        <div class="mb-4">
                            @if ($sekolah->logo_sekolah)
                                <img src="{{ url('public/app/data-sekolah/' . $sekolah->logo_sekolah) }}" 
                                    alt="Logo Sekolah" class="img-fluid rounded" style="max-width: 120px;">
                            @else
                                <p>Logo Sekolah tidak tersedia.</p>
                            @endif
                        </div>
                        <div class="mb-4">
                            @if ($sekolah->foto_sekolah)
                                <img src="{{ url('public/app/data-sekolah/' . $sekolah->foto_sekolah) }}" 
                                    alt="Foto Sekolah" class="img-fluid rounded" style="max-width: 220px;">
                            @else
                                <p>Foto Sekolah tidak tersedia.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ url('master-admin/data-sekolah') }}" class="btn btn-outline-secondary" ria-label="Kembali ke daftar Sekolah">
                <i class="ti ti-arrow-left"></i> Kembali
            </a>
            <a href="{{ url('master-admin/data-sekolah/edit/' . $sekolah->id) }}" class="btn btn-warning" aria-label="Edit data Sekolah">
                <i class="ti ti-pencil"></i> Edit Data
            </a>
        </div>
    </div>
</x-master-admin>
