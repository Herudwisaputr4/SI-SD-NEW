<x-master-admin>
    <div class="container-fluid">
        <!-- Tampilkan pesan error jika ada -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <h4 class="mb-4">Edit Data Sekolah</h4>
        <form action="{{ url('master-admin/data-sekolah/' . $sekolah->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card mb-3">
                <div class="row g-0">
                    <!-- Form Input -->
                    <div class="col-md-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="nama_sekolah" class="form-label">Nama Sekolah</label>
                                <input type="text" name="nama_sekolah" id="nama_sekolah" class="form-control"
                                    value="{{ old('nama_sekolah', $sekolah->nama_sekolah) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="npsn" class="form-label">NPSN</label>
                                <input type="text" name="npsn" id="npsn" class="form-control"
                                    value="{{ old('npsn', $sekolah->npsn) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="kepala_sekolah" class="form-label">Kepala Sekolah</label>
                                <input type="text" name="kepala_sekolah" id="kepala_Sekolah" class="form-control"
                                    value=" {{ old('kepala_sekolah', $sekolah->kepala_sekolah) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="akreditasi" class="form-label">Akreditasi</label>
                                <select name="akreditasi" id="akreditasi" class="form-control @error('akreditasi') is-invalid @enderror" required>
                                    <option value="" disabled>Pilih Akreditasi</option>
                                    <option value="A" {{ old('akreditasi', $sekolah->akreditasi) == 'A' ? 'selected' : '' }}>A</option>
                                    <option value="B" {{ old('akreditasi', $sekolah->akreditasi) == 'B' ? 'selected' : '' }}>B</option>
                                    <option value="C" {{ old('akreditasi', $sekolah->akreditasi) == 'C' ? 'selected' : '' }}>C</option>
                                    <option value="Tidak Terakreditasi" {{ old('akreditasi', $sekolah->akreditasi) == 'Tidak Terakreditasi' ? 'selected' : '' }}>Tidak Terakreditasi</option>
                                </select>
                                @error('akreditasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="kurikulum" class="form-label">Kurikulum</label>
                                <select name="kurikulum" id="kurikulum" class="form-control @error('kurikulum') is-invalid @enderror" required>
                                    <option value="" disabled>Pilih Kurikulum</option>
                                    <option value="Kurikulum Merdeka" {{ old('kurikulum', $sekolah->kurikulum) == 'Kurikulum Merdeka' ? 'selected' : '' }}>Kurikulum Merdeka</option>
                                    <option value="Kurikulum K-13" {{ old('kurikulum', $sekolah->kurikulum) == 'Kurikulum K-13' ? 'selected' : '' }}>Kurikulum K-13</option>
                                    <option value="Kurikulum KTSP" {{ old('kurikulum', $sekolah->kurikulum) == 'Kurikulum KTSP' ? 'selected' : '' }}>Kurikulum KTSP</option>
                                    <option value="Kurikulum Darurat" {{ old('kurikulum', $sekolah->kurikulum) == 'Kurikulum Darurat' ? 'selected' : '' }}>Kurikulum Darurat</option>
                                </select>
                                @error('kurikulum')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="alamat_lengkap" class="form-label">Alamat Lengkap</label>
                                <textarea name="alamat_lengkap" id="alamat_lengkap" class="form-control"
                                    placeholder="Masukkan alamat lengkap" required>{{ old('alamat_lengkap', $sekolah->alamat_lengkap) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="email_sekolah" class="form-label">Email Sekolah</label>
                                <input type="email" name="email_sekolah" id="email_sekolah" class="form-control"
                                    value="{{ old('email_sekolah', $sekolah->email_sekolah) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="telepon_sekolah" class="form-label">Telepon Sekolah</label>
                                <input type="text" name="telepon_sekolah" id="telepon_sekolah" class="form-control"
                                    value="{{ old('telepon_sekolah', $sekolah->telepon_sekolah) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="status_sekolah" class="form-label">Status Sekolah</label>
                                <select name="status_sekolah" id="status_sekolah" class="form-control @error('status_sekolah') is-invalid @enderror" required>
                                    <option value="" disabled>Pilih Status Sekolah</option>
                                    <option value="Negeri" {{ old('status_sekolah', $sekolah->status_sekolah) == 'Negeri' ? 'selected' : '' }}>Negeri</option>
                                    <option value="Swasta" {{ old('status_sekolah', $sekolah->status_sekolah) == 'Swasta' ? 'selected' : '' }}>Swasta</option>
                                </select>
                                @error('status_sekolah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="kepemilikan_sekolah" class="form-label">Kepemilikan Sekolah</label>
                                <select name="kepemilikan_sekolah" id="kepemilikan_sekolah" class="form-control @error('kepemilikan_sekolah') is-invalid @enderror" required>
                                    <option value="" disabled>Pilih Kepemilikan Sekolah</option>
                                    <option value="Pemerintah" {{ old('kepemilikan_sekolah', $sekolah->kepemilikan_sekolah) == 'Pemerintah' ? 'selected' : '' }}>Pemerintah</option>
                                    <option value="Yayasan" {{ old('kepemilikan_sekolah', $sekolah->kepemilikan_sekolah) == 'Yayasan' ? 'selected' : '' }}>Yayasan</option>
                                    <option value="Perusahaan" {{ old('kepemilikan_sekolah', $sekolah->kepemilikan_sekolah) == 'Perusahaan' ? 'selected' : '' }}>Perusahaan</option>
                                </select>
                                @error('kepemilikan_sekolah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="keaktifan_sekolah" class="form-label">Keaktifan Sekolah</label>
                                <select name="keaktifan_sekolah" id="keaktifan_sekolah" class="form-control @error('keaktifan_sekolah') is-invalid @enderror" required>
                                    <option value="" disabled>Pilih Keaktifan Sekolah</option>
                                    <option value="Aktif" {{ old('keaktifan_sekolah', $sekolah->keaktifan_sekolah) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="Tidak Aktif" {{ old('keaktifan_sekolah', $sekolah->keaktifan_sekolah) == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                                @error('keaktifan_sekolah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="jumlah_pengajar" class="form-label">Jumlah Pengajar</label>
                                <input type="number" name="jumlah_pengajar" id="jumlah_pengajar" class="form-control"
                                    value="{{ old('jumlah_pengajar', $sekolah->jumlah_pengajar) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="jumlah_siswa" class="form-label">Jumlah Siswa</label>
                                <input type="number" name="jumlah_siswa" id="jumlah_siswa" class="form-control"
                                    value="{{ old('jumlah_siswa', $sekolah->jumlah_siswa) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="tahun_berdiri" class="form-label">Tahun Berdiri</label>
                                <input type="date" name="tahun_berdiri" id="tahun_berdiri" class="form-control"
                                    value="{{ old('tahun_berdiri', $sekolah->tahun_berdiri) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="ruang_kelas" class="form-label">Ruang Kelas</label>
                                <input type="number" name="ruang_kelas" id="ruang_kelas" class="form-control"
                                    value="{{ old('ruang_kelas', $sekolah->ruang_kelas) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="ruang_perpustakaan" class="form-label">Ruang Perpustakaan</label>
                                <input type="number" name="ruang_perpustakaan" id="ruang_perpustakaan" class="form-control"
                                    value="{{ old('ruang_perpustakaan', $sekolah->ruang_perpustakaan) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="ruang_laboratorium" class="form-label">Ruang Laboratorium</label>
                                <input type="number" name="ruang_laboratorium" id="ruang_laboratorium" class="form-control"
                                    value="{{ old('ruang_laboratorium', $sekolah->ruang_laboratorium) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="ruang_praktik" class="form-label">Ruang Praktik</label>
                                <input type="number" name="ruang_praktik" id="ruang_praktik" class="form-control"
                                    value="{{ old('ruang_praktik', $sekolah->ruang_praktik) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="ruang_pimpinan" class="form-label">Ruang Pimpinan</label>
                                <input type="number" name="ruang_pimpinan" id="ruang_pimpinan" class="form-control"
                                    value="{{ old('ruang_pimpinan', $sekolah->ruang_pimpinan) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="ruang_guru" class="form-label">Ruang Guru</label>
                                <input type="number" name="ruang_guru" id="ruang_guru" class="form-control"
                                    value="{{ old('ruang_guru', $sekolah->ruang_guru) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="ruang_ibadah" class="form-label">Ruang Ibadah</label>
                                <input type="number" name="ruang_ibadah" id="ruang_ibadah" class="form-control"
                                    value="{{ old('ruang_ibadah', $sekolah->ruang_ibadah) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="ruang_UKS" class="form-label">Ruang UKS</label>
                                <input type="number" name="ruang_UKS" id="ruang_UKS" class="form-control"
                                    value="{{ old('ruang_UKS', $sekolah->ruang_UKS) }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex justify-content-center">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <label for="ruang_toilet" class="form-label">Ruang Toilet</label>
                                <input type="number" name="ruang_toilet" id="ruang_toilet" class="form-control"
                                    value="{{ old('ruang_toilet', $sekolah->ruang_toilet) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="ruang_gudang" class="form-label">Ruang Gudang</label>
                                <input type="number" name="ruang_gudang" id="ruang_gudang" class="form-control"
                                    value="{{ old('ruang_gudang', $sekolah->ruang_gudang) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="ruang_olahraga" class="form-label">Ruang Olahraga</label>
                                <input type="number" name="ruang_olahraga" id="ruang_olahraga" class="form-control"
                                    value="{{ old('ruang_olahraga', $sekolah->ruang_olahraga) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="ruang_tu" class="form-label">Ruang TU</label>
                                <input type="number" name="ruang_tu" id="ruang_tu" class="form-control"
                                    value="{{ old('ruang_tu', $sekolah->ruang_tu) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="ruang_konseling" class="form-label">Ruang Konseling</label>
                                <input type="number" name="ruang_konseling" id="ruang_konseling" class="form-control"
                                    value="{{ old('ruang_konseling', $sekolah->ruang_konseling) }}" required>
                            </div>
                            <!-- Logo Sekolah -->
                            <div class="mb-3 text-center">
                                <label for="logo_sekolah" class="form-label">Logo Sekolah</label>
                                <input type="file" name="logo_sekolah" id="logo_sekolah" class="form-control"
                                    onchange="previewImage(event)">
                                <div class="mt-2 d-flex justify-content-center">
                                    <div>
                                        <img id="preview" src="{{ url('public/app/data-sekolah/'.$sekolah->logo_sekolah) }}"
                                            alt="Preview Logo Sekolah" class="img-fluid rounded" style="max-width: 120px;">
                                        <p id="previewText" style="display: none;">Preview logo akan muncul di sini.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Foto Sekolah -->
                            <div class="mb-3 text-center">
                                <label for="foto_sekolah" class="form-label">Foto Sekolah</label>
                                <input type="file" name="foto_sekolah" id="foto_sekolah" class="form-control"
                                    onchange="previewImage(event)">
                                <div class="mt-2 d-flex justify-content-center">
                                    <div>
                                        <img id="preview" src="{{ url('public/app/data-sekolah/'.$sekolah->foto_sekolah) }}"
                                            alt="Preview Foto Sekolah" class="img-fluid rounded" style="max-width: 180px;">
                                        <p id="previewText" style="display: none;">Preview foto akan muncul di sini.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ url('master-admin/data-sekolah') }}" class="btn btn-outline-secondary">
                    <i class="ti ti-arrow-left"></i> Back
                </a>
                <button type="button" class="btn btn-success" id="btnUpdate">
                    <i class="ti ti-check"></i> Update Data
                </button>
            </div>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const preview = document.getElementById('preview');
            const previewText = document.getElementById('previewText');
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function() {
                    preview.src = reader.result;
                    previewText.style.display = 'none';
                }
                reader.readAsDataURL(file);
            } else {
                previewText.style.display = 'block';
            }
        }
    </script>
    <!-- Include SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // SweetAlert konfirmasi update
        const btnUpdate = document.getElementById('btnUpdate');
        const form = document.querySelector('form');

        btnUpdate.addEventListener('click', function (e) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data sekolah akan diperbarui!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, perbarui!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>
</x-master-admin>