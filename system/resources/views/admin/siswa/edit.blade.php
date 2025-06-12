<x-admin>
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

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

        <h4 class="mb-4">Edit Data Siswa</h4>
        <form action="{{ url('admin/siswa/' . $siswa->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card mb-3">
                <div class="row g-0">
                    <!-- Form Input -->
                    <div class="col-md-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="nisn" class="form-label">NISN</label>
                                <input type="number" name="nisn" id="nisn" class="form-control"
                                    value="{{ old('nisn', $siswa->nisn) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="nis" class="form-label">NIS</label>
                                <input type="number" name="nis" id="nis" class="form-control"
                                    value="{{ old('nis', $siswa->nis) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="nama_siswa" class="form-label">Nama Siswa</label>
                                <input type="text" name="nama_siswa" id="nama_siswa" class="form-control"
                                    value="{{ old('nama_siswa', $siswa->nama_siswa) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="jenis_pendaftaran" class="form-label">Jenis Pendaftaran</label>
                                <select name="jenis_pendaftaran" id="jenis_pendaftaran"
                                    class="form-control @error('jenis_pendaftaran') is-invalid @enderror" required>
                                    <option value="" disabled selected>Pilih Jenis Pendaftaran</option>
                                    <option value="Peserta Didik Baru"
                                        {{ old('jenis_pendaftaran', $siswa->jenis_pendaftaran) == 'Peserta Didik Baru' ? 'selected' : '' }}>
                                        Peserta Didik Baru</option>
                                    <option value="Pindahan"
                                        {{ old('jenis_pendaftaran', $siswa->jenis_pendaftaran) == 'Pindahan' ? 'selected' : '' }}>
                                        Pindahan</option>
                                </select>
                                @error('jenis_pendaftaran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="jalur_pendaftaran" class="form-label">Jalur Pendaftaran</label>
                                <select name="jalur_pendaftaran" id="jalur_pendaftaran"
                                    class="form-control @error('jalur_pendaftaran') is-invalid @enderror" required>
                                    <option value="" disabled selected>Pilih Jalur Pendaftaran</option>
                                    <option value="Zonasi"
                                        {{ old('jalur_pendaftaran', $siswa->jalur_pendaftaran) == 'Zonasi' ? 'selected' : '' }}>
                                        Zonasi</option>
                                    <option value="Afirmasi"
                                        {{ old('jalur_pendaftaran', $siswa->jalur_pendaftaran) == 'Afirmasi' ? 'selected' : '' }}>
                                        Afirmasi</option>
                                    <option value="Perpindahan Orang Tua"
                                        {{ old('jalur_pendaftaran', $siswa->jalur_pendaftaran) == 'Perpindahan Orang Tua' ? 'selected' : '' }}>
                                        Perpindahan Orang Tua</option>
                                    <option value="Prestasi"
                                        {{ old('jalur_pendaftaran', $siswa->jalur_pendaftaran) == 'Prestasi' ? 'selected' : '' }}>
                                        Prestasi</option>
                                    <option value="Mandiri"
                                        {{ old('jalur_pendaftaran', $siswa->jalur_pendaftaran) == 'Mandiri' ? 'selected' : '' }}>
                                        Mandiri</option>
                                </select>
                                @error('jalur_pendaftaran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                                <input type="date" name="tanggal_masuk" id="tanggal_masuk" class="form-control"
                                    value="{{ old('tanggal_masuk', $siswa->tanggal_masuk) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status"
                                    class="form-control @error('status') is-invalid @enderror" required>
                                    <option value="" disabled selected>Pilih Status</option>
                                    <option value="Aktif"
                                        {{ old('status', $siswa->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="Tidak Aktif"
                                        {{ old('status', $siswa->status) == 'Tidak Aktif' ? 'selected' : '' }}>Tidak
                                        Aktif</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="kebutuhan_khusus" class="form-label">Kebutuhan Khusus</label>
                                <select name="kebutuhan_khusus" id="kebutuhan_khusus"
                                    class="form-control @error('kebutuhan_khusus') is-invalid @enderror" required>
                                    <option value="" disabled selected>Pilih Kebutuhan Khusus</option>
                                    <option value="Iya"
                                        {{ old('kebutuhan_khusus', $siswa->kebutuhan_khusus) == 'Iya' ? 'selected' : '' }}>
                                        Iya</option>
                                    <option value="Tidak"
                                        {{ old('kebutuhan_khusus', $siswa->kebutuhan_khusus) == 'Tidak' ? 'selected' : '' }}>
                                        Tidak</option>
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
                                <input type="email" name="email" id="email" class="form-control"
                                    value="{{ old('email', $siswa->email) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="no_kk" class="form-label">Nomor Kartu Keluarga</label>
                                <input type="text" name="no_kk" id="no_kk" class="form-control"
                                    value="{{ old('no_kk', $siswa->no_kk) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="nik" class="form-label">NIK</label>
                                <input type="text" name="nik" id="nik" class="form-control"
                                    value="{{ old('nik', $siswa->nik) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="jenis_kelamin"
                                    class="form-control @error('jenis_kelamin') is-invalid @enderror" required>
                                    <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki"
                                        {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>
                                        Laki-laki</option>
                                    <option value="Perempuan"
                                        {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="agama" class="form-label">Agama</label>
                                <select name="agama" id="agama"
                                    class="form-control @error('agama') is-invalid @enderror" required>
                                    <option value="" disabled selected>Pilih Agama</option>
                                    <option value="Islam"
                                        {{ old('agama', $siswa->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="Katolik"
                                        {{ old('agama', $siswa->agama) == 'Katolik' ? 'selected' : '' }}>Katolik
                                    </option>
                                    <option value="Protestan"
                                        {{ old('agama', $siswa->agama) == 'Protestan' ? 'selected' : '' }}>Protestan
                                    </option>
                                    <option value="Hindu"
                                        {{ old('agama', $siswa->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="Buddha"
                                        {{ old('agama', $siswa->agama) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                    <option value="Khonghucu"
                                        {{ old('agama', $siswa->agama) == 'Khonghucu' ? 'selected' : '' }}>Khonghucu
                                    </option>
                                </select>
                                @error('agama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control"
                                    value="{{ old('tempat_lahir', $siswa->tempat_lahir) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control"
                                    value="{{ old('tanggal_lahir', $siswa->tanggal_lahir) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" name="alamat" id="alamat" class="form-control"
                                    value="{{ old('alamat', $siswa->alamat) }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="rt" class="form-label">Nomor RT</label>
                                <input type="number" name="rt" id="rt" class="form-control"
                                    value="{{ old('rt', $siswa->rt) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="rw" class="form-label">Nomor RW</label>
                                <input type="number" name="rw" id="rw" class="form-control"
                                    value="{{ old('rw', $siswa->rw) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="dusun" class="form-label">Dusun</label>
                                <input type="text" name="dusun" id="dusun" class="form-control"
                                    value="{{ old('dusun', $siswa->dusun) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="desa_kelurahan" class="form-label">Desa/Kelurahan</label>
                                <input type="text" name="desa_kelurahan" id="desa_kelurahan" class="form-control"
                                    value="{{ old('desa_kelurahan', $siswa->desa_kelurahan) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="provinsi" class="form-label">Provinsi</label>
                                <input type="text" name="provinsi" id="provinsi" class="form-control"
                                    value="{{ old('provinsi', $siswa->provinsi) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="kabupaten" class="form-label">Kabupaten</label>
                                <input type="text" name="kabupaten" id="kabupaten" class="form-control"
                                    value="{{ old('kabupaten', $siswa->kabupaten) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="kecamatan" class="form-label">Kecamatan</label>
                                <input type="text" name="kecamatan" id="kecamatan" class="form-control"
                                    value="{{ old('kecamatan', $siswa->kecamatan) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="telepon" class="form-label">Nomor Telepon</label>
                                <input type="number" name="telepon" id="telepon" class="form-control"
                                    value="{{ old('telepon', $siswa->telepon) }}" required>
                            </div>
                        </div>
                    </div>
                    <!-- Preview Foto -->
                    <div class="row g-0">
                        <div class="col-12 col-md-4">
                            <div class="card-body">
                                 <div class="mb-3">
                                    <label for="password" class="form-label">Password <small>(Kosongkan jika tidak diubah)</small></label>
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="Masukkan password baru">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="foto_siswa" class="form-label">Foto Siswa</label>
                                    <input type="file" name="foto_siswa" id="foto_siswa" class="form-control"
                                        onchange="previewImage(event)">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 d-flex align-items-start justify-content-center">
                            <div class="card-body text-center">
                                <img id="preview" src="{{ url('public/app/data-siswa/' . $siswa->foto_siswa) }}"
                                    alt="Preview Foto Siswa" class="img-fluid rounded" style="max-width: 120px;">
                                <p id="previewText" style="display: none;">Preview foto akan muncul disini.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ url('admin/siswa') }}" class="btn btn-outline-secondary">
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
                text: "Data siswa akan diperbarui!",
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
</x-admin>
