<x-admin>
    <div class="container-fluid">
        <h4 class="mb-4">Tambah Data Siswa</h4>
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
        
        <form action="{{ url('admin/siswa') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("POST")
            <div class="card mb-3">
                <div class="row g-0">
                    <!-- Form Input -->
                    <div class="col-md-4">
                        <input type="text" name="sekolah_id" value="{{ Auth::guard('admin')->user()->sekolah_id }}" hidden>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="nisn" class="form-label">NISN</label>
                                <input type="number" name="nisn" id="nisn" class="form-control"
                                    placeholder="Masukkan NISN" required>
                            </div>
                            <div class="mb-3">
                                <label for="nis" class="form-label">NIS</label>
                                <input type="number" name="nis" id="nis" class="form-control"
                                    placeholder="Masukkan NIS" required>
                            </div>
                            <div class="mb-3">
                                <label for="nama_siswa" class="form-label">Nama Siswa</label>
                                <input type="text" name="nama_siswa" id="nama_siswa" class="form-control"
                                    placeholder="Masukkan Nama Siswa" required>
                            </div>
                            <div class="mb-3">
                                <label for="jenis_pendaftaran" class="form-label">Jenis Pendaftaran</label>
                                <select name="jenis_pendaftaran" id="jenis_pendaftaran" class="form-control @error('jenis_pendaftaran') is-invalid @enderror" required>
                                    <option value="" disabled selected>Pilih Jenis Pendaftaran</option>
                                    <option value="Peserta Didik Baru">Peserta Didik Baru</option>
                                    <option value="Pindahan">Pindahan</option>
                                </select>
                                @error('jenis_pendaftaran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="jalur_pendaftaran" class="form-label">Jalur Pendaftaran</label>
                                <select name="jalur_pendaftaran" id="jalur_pendaftaran" class="form-control @error('jalur_pendaftaran') is-invalid @enderror" required>
                                    <option value="" disabled selected>Pilih Jalur Pendaftaran</option>
                                    <option value="Zonasi">Zonasi</option>
                                    <option value="Afirmasi">Afirmasi</option>
                                    <option value="Perpindahan Orang Tua">Perpindahan Orang Tua</option>
                                    <option value="Prestasi">Prestasi</option>
                                    <option value="Mandiri">Mandiri</option>
                                </select>
                                @error('jalur_pendaftaran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                                <input type="date" name="tanggal_masuk" id="tanggal_masuk" class="form-control" required> 
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                    <option value="" disabled selected>Pilih Status</option>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Tidak Aktif">Tidak Aktif</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="kebutuhan_khusus" class="form-label">Kebutuhan Khusus</label>
                                <select name="kebutuhan_khusus" id="kebutuhan_khusus" class="form-control @error('kebutuhan_khusus') is-invalid @enderror" required>
                                    <option value="" disabled selected>Pilih Kebutuhan Khusus</option>
                                    <option value="Iya">Iya</option>
                                    <option value="Tidak">Tidak</option>
                                </select>
                                @error('kebutuhan_khusus')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control"
                                    placeholder="Masukkan email" required>
                            </div>
                            <div class="mb-3">
                                <label for="no_kk" class="form-label">Nomor Kartu Keluarga</label>
                                <input type="text" name="no_kk" id="no_kk" class="form-control"
                                    placeholder="Masukkan Nomor Kartu Keluarga" required>
                            </div>
                            <div class="mb-3">
                                <label for="nik" class="form-label">NIK</label>
                                <input type="text" name="nik" id="nik" class="form-control"
                                    placeholder="Masukkan Nomor Induk Kependudukan" required>
                            </div>
                            <div class="mb-3">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror" required>
                                    <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="agama" class="form-label">Agama</label>
                                <select name="agama" id="agama" class="form-control @error('agama') is-invalid @enderror" required>
                                    <option value="" disabled selected>Pilih Agama</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Protestan">Protestan</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Buddha">Buddha</option>
                                    <option value="Khonghucu">Khonghucu</option>
                                </select>
                                @error('agama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control"
                                    placeholder="Masukkan Tempat Lahir" required>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" name="alamat" id="alamat" class="form-control"
                                    placeholder="Masukkan Alamat" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="rt" class="form-label">Nomor RT</label>
                                <input type="number" name="rt" id="rt" class="form-control"
                                    placeholder="Masukkan Nomor RT" required>
                            </div>
                            <div class="mb-3">
                                <label for="rw" class="form-label">Nomor RW</label>
                                <input type="number" name="rw" id="rw" class="form-control"
                                    placeholder="Masukkan Nomor RW" required>
                            </div>                           
                            <div class="mb-3">
                                <label for="dusun" class="form-label">Dusun</label>
                                <input type="text" name="dusun" id="dusun" class="form-control"
                                    placeholder="Masukkan Dusun" required>
                            </div>
                            <div class="mb-3">
                                <label for="desa_kelurahan" class="form-label">Desa/Kelurahan</label>
                                <input type="text" name="desa_kelurahan" id="desa_kelurahan" class="form-control"
                                    placeholder="Masukkan Desa Kelurahan" required>
                            </div>
                            <div class="mb-3">
                                <label for="provinsi" class="form-label">Provinsi</label>
                                <input type="text" name="provinsi" id="provinsi" class="form-control"
                                    placeholder="Masukkan Provinsi" required>
                            </div>
                            <div class="mb-3">
                                <label for="kabupaten" class="form-label">Kabupaten</label>
                                <input type="text" name="kabupaten" id="kabupaten" class="form-control"
                                    placeholder="Masukkan Kabupaten" required>
                            </div>
                            <div class="mb-3">
                                <label for="Kecamatan" class="form-label">Kecamatan</label>
                                <input type="text" name="kecamatan" id="kecamatan" class="form-control"
                                    placeholder="Masukkan Kecamatan" required>
                            </div>
                            <div class="mb-3">
                                <label for="telepon" class="form-label">Nomor Telepon</label>
                                <input type="number" name="telepon" id="telepon" class="form-control"
                                    placeholder="Masukkan Nomor Telepon" required>
                            </div>
                        </div>
                    </div>
                    <!-- Preview Foto -->
                    <div class="row g-0">
                        <div class="col-12 col-md-4">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="Masukkan password" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="foto_siswa" class="form-label">Foto Siswa</label>
                                    <input type="file" name="foto_siswa" id="foto_siswa" class="form-control" required
                                        onchange="previewImage(event)">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 d-flex align-items-start justify-content-center">
                            <div class="card-body text-center">
                                <img id="preview" src="#" alt="Preview Foto Profil" class="img-fluid rounded"
                                    style="display: none; max-width: 120px;">
                                <p id="previewText">Preview foto akan muncul disini.</p>
                            </div>
                        </div> 
                    </div>                   
                </div>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ url('admin/siswa') }}" class="btn btn-outline-secondary">
                    <i class="ti ti-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="ti ti-check"></i> Simpan Data
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
</x-admin>