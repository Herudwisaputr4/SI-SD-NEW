<x-master-admin>
    <div class="container-fluid">
        <h4 class="mb-4">Tambah Data Sekolah</h4>
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
        <form action="{{ url('master-admin/data-sekolah') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card mb-3">
                <div class="row g-0">
                    <!-- Sisi Kiri: Nama Sekolah sampai Tahun Berdiri -->
                    <div class="col-md-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="nama_sekolah" class="form-label">Nama Sekolah</label>
                                <input type="text" name="nama_sekolah" id="nama_sekolah" class="form-control"
                                    placeholder="Masukkan nama sekolah" required>
                            </div>
                            <div class="mb-3">
                                <label for="npsn" class="form-label">NPSN</label>
                                <input type="text" name="npsn" id="npsn" class="form-control"
                                    placeholder="Masukkan NPSN" required>
                            </div>
                            <div class="mb-3">
                                <label for="npsn" class="form-label">Kepala Sekolah</label>
                                <input type="text" name="kepala_sekolah" id="kepala_sekolah" class="form-control"
                                    placeholder="Masukkan Kepala Sekolah" required>
                            </div>
                            <div class="mb-3">
                                <label for="akreditasi" class="form-label">Akreditasi</label>
                                <select name="akreditasi" id="akreditasi" class="form-control @error('akreditasi') is-invalid @enderror" required>
                                    <option value="" disabled selected>Pilih Akreditasi</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="Tidak Terakreditasi">Tidak Terakreditasi</option>
                                </select>
                                @error('akreditasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="kurikulum" class="form-label">Kurikulum</label>
                                <select name="kurikulum" id="kurikulum" class="form-control @error('kurikulum') is-invalid @enderror" required>
                                    <option value="" disabled selected>Pilih Kurikulum</option>
                                    <option value="Kurikulum Merdeka">Kurikulum Merdeka</option>
                                    <option value="Kurikulum K-13">Kurikulum K-13</option>
                                    <option value="Kurikulum 2013">Kurikulum KTSP</option>
                                    <option value="Kurikulum 2013">Kurikulum Darurat</option>
                                </select>
                                @error('kurikulum')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="alamat_lengkap" class="form-label">Alamat Lengkap</label>
                                <textarea name="alamat_lengkap" id="alamat_lengkap" class="form-control"
                                    placeholder="Masukkan alamat lengkap" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="email_sekolah" class="form-label">Email Sekolah</label>
                                <input type="email" name="email_sekolah" id="email_sekolah" class="form-control"
                                    placeholder="Masukkan email sekolah" required>
                            </div>
                            <div class="mb-3">
                                <label for="telepon_sekolah" class="form-label">Telepon Sekolah</label>
                                <input type="text" name="telepon_sekolah" id="telepon_sekolah" class="form-control"
                                    placeholder="Masukkan nomor telepon" required>
                            </div>
                            <div class="mb-3">
                                <label for="status_sekolah" class="form-label">Status Sekolah</label>
                                <select name="status_sekolah" id="status_sekolah" class="form-control @error('status_sekolah') is-invalid @enderror" required>
                                    <option value="" disabled selected>Pilih Status Sekolah</option>
                                    <option value="Negeri">Negeri</option>
                                    <option value="Swasta">Swasta</option>
                                </select>
                                @error('status_sekolah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="kepemilikan_sekolah" class="form-label">Kepemilikan Sekolah</label>
                                <select name="kepemilikan_sekolah" id="kepemilikan_sekolah" class="form-control @error('kepemilikan_sekolah') is-invalid @enderror" required>
                                    <option value="" disabled selected>Pilih Kepemilikan Sekolah</option>
                                    <option value="Pemerintah">Pemerintah</option>
                                    <option value="Yayasan">Yayasan</option>
                                    <option value="Yayasan">Perusahaan</option>
                                </select>
                                @error('kepemilikan_sekolah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="keaktifan_sekolah" class="form-label">Keaktifan Sekolah</label>
                                <select name="keaktifan_sekolah" id="keaktifan_sekolah" class="form-control @error('keaktifan_sekolah') is-invalid @enderror" required>
                                    <option value="" disabled selected>Pilih Keaktifan Sekolah</option>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Tidak Aktif">Tidak Aktif</option>
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
                                    placeholder="Masukkan jumlah pengajar" required>
                            </div>
                            <div class="mb-3">
                                <label for="jumlah_siswa" class="form-label">Jumlah Siswa</label>
                                <input type="number" name="jumlah_siswa" id="jumlah_siswa" class="form-control"
                                    placeholder="Masukkan jumlah siswa" required>
                            </div>
                            <div class="mb-3">
                                <label for="tahun_berdiri" class="form-label">Tahun Berdiri</label>
                                <input type="date" name="tahun_berdiri" id="tahun_berdiri" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="ruang_kelas" class="form-label">Ruang Kelas</label>
                                <input type="number" name="ruang_kelas" id="ruang_kelas" class="form-control"
                                    placeholder="Masukkan jumlah ruang kelas" required>
                            </div>
                            <div class="mb-3">
                                <label for="ruang_perpustakaan" class="form-label">Ruang Perpustakaan</label>
                                <input type="number" name="ruang_perpustakaan" id="ruang_perpustakaan" class="form-control"
                                    placeholder="Masukkan jumlah ruang perpustakaan" required>
                            </div>
                            <div class="mb-3">
                                <label for="ruang_laboratorium" class="form-label">Ruang Laboratorium</label>
                                <input type="number" name="ruang_laboratorium" id="ruang_laboratorium" class="form-control"
                                    placeholder="Masukkan jumlah ruang laboratorium" required>
                            </div>
                            <div class="mb-3">
                                <label for="ruang_praktik" class="form-label">Ruang Praktik</label>
                                <input type="number" name="ruang_praktik" id="ruang_praktik" class="form-control"
                                    placeholder="Masukkan jumlah ruang praktik" required>
                            </div>
                            <div class="mb-3">
                                <label for="ruang_pimpinan" class="form-label">Ruang Pimpinan</label>
                                <input type="number" name="ruang_pimpinan" id="ruang_pimpinan" class="form-control"
                                    placeholder="Masukkan jumlah ruang pimpinan" required>
                            </div>
                            <div class="mb-3">
                                <label for="ruang_guru" class="form-label">Ruang Guru</label>
                                <input type="number" name="ruang_guru" id="ruang_guru" class="form-control"
                                    placeholder="Masukkan jumlah ruang guru" required>
                            </div>
                            <div class="mb-3">
                                <label for="ruang_ibadah" class="form-label">Ruang Ibadah</label>
                                <input type="number" name="ruang_ibadah" id="ruang_ibadah" class="form-control"
                                    placeholder="Masukkan jumlah ruang ibadah" required>
                            </div>
                            <div class="mb-3">
                                <label for="ruang_UKS" class="form-label">Ruang UKS</label>
                                <input type="number" name="ruang_UKS" id="ruang_UKS" class="form-control"
                                    placeholder="Masukkan jumlah ruang UKS" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex justify-content-center">
                        <div class="card-body text-center">    
                            <div class="mb-3">
                                <label for="ruang_toilet" class="form-label">Ruang Toilet</label>
                                <input type="number" name="ruang_toilet" id="ruang_toilet" class="form-control"
                                    placeholder="Masukkan jumlah ruang toilet" required>
                            </div>
                            <div class="mb-3">
                                <label for="ruang_gudang" class="form-label">Ruang Gudang</label>
                                <input type="number" name="ruang_gudang" id="ruang_gudang" class="form-control"
                                    placeholder="Masukkan jumlah ruang gudang" required>
                            </div>
                            <div class="mb-3">
                                <label for="ruang_olahraga" class="form-label">Ruang Olahraga</label>
                                <input type="number" name="ruang_olahraga" id="ruang_olahraga" class="form-control"
                                    placeholder="Masukkan jumlah ruang olahraga" required>
                            </div>
                            <div class="mb-3">
                                <label for="ruang_tu" class="form-label">Ruang TU</label>
                                <input type="number" name="ruang_tu" id="ruang_tu" class="form-control"
                                    placeholder="Masukkan jumlah ruang TU" required>
                            </div>
                            <div class="mb-3">
                                <label for="ruang_konseling" class="form-label">Ruang Konseling</label>
                                <input type="number" name="ruang_konseling" id="ruang_konseling" class="form-control"
                                    placeholder="Masukkan jumlah ruang konseling" required>
                            </div>
                            <!-- Logo Sekolah -->
                            <div class="mb-3">
                                <label for="logo_sekolah" class="form-label">Logo Sekolah</label>
                                <input type="file" name="logo_sekolah" id="logo_sekolah" class="form-control" required
                                    onchange="previewImage(event, 'logo_sekolah')">
                            </div>
                            <div class="mb-4">
                                <img id="preview_logo_sekolah" src="#" alt="Preview Logo Sekolah" class="img-fluid rounded"
                                    style="display: none; max-width: 250px;">
                                <p id="previewText_logo_sekolah">Preview logo akan muncul disini.</p>
                            </div>
                            <!-- Foto Sekolah -->
                            <div class="mb-3">
                                <label for="foto_sekolah" class="form-label">Foto Sekolah</label>
                                <input type="file" name="foto_sekolah" id="foto_sekolah" class="form-control" required
                                    onchange="previewImage(event, 'foto_sekolah')">
                            </div>
                            <div class="mb-4">
                                <img id="preview_foto_sekolah" src="#" alt="Preview Foto Sekolah" class="img-fluid rounded"
                                    style="display: none; max-width: 250px;">
                                <p id="previewText_foto_Sekolah">Preview Foto akan muncul disini.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ url('master-admin/data-sekolah') }}" class="btn btn-outline-secondary">
                    <i class="ti ti-arrow-left"></i> Back
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="ti ti-check"></i> Simpan Data
                </button>
            </div>
        </form>
    </div>
    <script>
        function previewImage(event, type) {
            const preview = document.getElementById('preview_' + type);
            const previewText = document.getElementById('previewText_' + type);
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function() {
                    preview.src = reader.result;
                    preview.style.display = 'block';
                    previewText.style.display = 'none';
                }
                reader.readAsDataURL(file);
            } else {
                preview.src = '#';
                preview.style.display = 'none';
                previewText.style.display = 'block';
            }
        }
    </script>
</x-master-admin>