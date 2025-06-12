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

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h4 class="mb-4">Edit Data Guru</h4>
        <form action="{{ url('admin/guru/' . $guru->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card mb-3">
                <div class="row g-0">
                    <!-- Kolom 1 -->
                    <div class="col-md-4">
                        <div class="card-body">
                            <!-- Form input kolom pertama -->
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" name="username" id="username" class="form-control"
                                    value="{{ old('username', $guru->username) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="nip" class="form-label">NIP</label>
                                <input type="number" name="nip" id="nip" class="form-control"
                                    value="{{ old('nip', $guru->nip) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                                    <option value="" disabled {{ old('jenis_kelamin', $guru->jenis_kelamin) ? '' : 'selected' }}>Pilih Jenis Kelamin</option>
                                    <option value="Laki-Laki" {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                    <option value="Perempuan" {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="agama" class="form-label">Agama</label>
                                <select name="agama" id="agama" class="form-control @error('agama') is-invalid @enderror" required>
                                    <option value="" disabled selected>Pilih Agama</option>
                                    <option value="Islam" {{ old('agama', $guru->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="Katolik" {{ old('agama', $guru->agama) == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                    <option value="Protestan" {{ old('agama', $guru->agama) == 'Protestan' ? 'selected' : '' }}>Protestan</option>
                                    <option value="Hindu" {{ old('agama', $guru->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="Buddha" {{ old('agama', $guru->agama) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                    <option value="Khonghucu" {{ old('agama', $guru->agama) == 'Khonghucu' ? 'selected' : '' }}>Khonghucu</option>
                                </select>
                                @error('agama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control"
                                    value="{{ old('tempat_lahir', $guru->tempat_lahir) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control"
                                    value="{{ old('tanggal_lahir', $guru->tanggal_lahir) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" name="alamat" id="alamat" class="form-control"
                                    value="{{ old('alamat', $guru->alamat) }}" required>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom 2 -->
                    <div class="col-md-4">
                        <div class="card-body">
                            <!-- Form input kolom kedua -->
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                    <option value="" disabled selected>Pilih Status</option>
                                    <option value="Aktif" {{ old('status', $guru->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="Tidak Aktif" {{ old('status', $guru->status) == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="no_telepon" class="form-label">No Telepon</label>
                                <input type="number" name="no_telepon" id="no_telepon" class="form-control"
                                    value="{{ old('no_telepon', $guru->no_telepon) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" name="email" id="email" class="form-control"
                                    value="{{ old('email', $guru->email) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="jabatan" class="form-label">Jabatan</label>
                                <select name="jabatan" id="jabatan" class="form-control" required>
                                    <option value="" disabled {{ old('jabatan', $guru->jabatan) ? '' : 'selected' }}>Pilih Jabatan</option>
                                    <option value="Guru Produktif" {{ old('jabatan', $guru->jabatan) == 'Guru Produktif' ? 'selected' : '' }}>Guru Produktif</option>
                                    <option value="Waka Kurikulum" {{ old('jabatan', $guru->jabatan) == 'Waka Kurikulum' ? 'selected' : '' }}>Waka Kurikulum</option>
                                    <option value="Waka Kesiswaan" {{ old('jabatan', $guru->jabatan) == 'Waka Kesiswaan' ? 'selected' : '' }}>Waka Kesiswaan</option>
                                    <option value="Sarpras" {{ old('jabatan', $guru->jabatan) == 'Sarpras' ? 'selected' : '' }}>Sarpras</option>
                                    <option value="Bimbingan Konseling" {{ old('jabatan', $guru->jabatan) == 'Bimbingan Konseling' ? 'selected' : '' }}>Bimbingan Konseling</option>
                                    <option value="Kepala Sekolah" {{ old('jabatan', $guru->jabatan) == 'Kepala Sekolah' ? 'selected' : '' }}>Kepala Sekolah</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="pendidikan_terakhir" class="form-label">Pendidikan Terakhir</label>
                                <select name="pendidikan_terakhir" id="pendidikan_terakhir"
                                    class="form-control @error('pendidikan_terakhir') is-invalid @enderror" required>
                                    <option value="" disabled selected>Pilih Pendidikan Terakhir</option>
                                    <option value="Diploma" {{ old('pendidikan_terakhir', $guru->pendidikan_terakhir) == 'Diploma' ? 'selected' : '' }}>Diploma</option>
                                    <option value="Sarjana" {{ old('pendidikan_terakhir', $guru->pendidikan_terakhir) == 'Sarjana' ? 'selected' : '' }}>Sarjana</option>
                                    <option value="Magister" {{ old('pendidikan_terakhir', $guru->pendidikan_terakhir) == 'Magister' ? 'selected' : '' }}>Magister</option>
                                    <option value="Doktor" {{ old('pendidikan_terakhir', $guru->pendidikan_terakhir) == 'Doktor' ? 'selected' : '' }}>Doktor</option>
                                </select>
                                @error('pendidikan_terakhir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tahun_masuk" class="form-label">Tahun Masuk</label>
                                <input type="number" name="tahun_masuk" id="tahun_masuk" class="form-control"
                                    value="{{ old('tahun_masuk', $guru->tahun_masuk) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password <small>(Kosongkan jika tidak diubah)</small></label>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Masukkan password baru">
                            </div>
                        </div>
                    </div>

                    <!-- Kolom 3 (Foto Profil) -->
                    <div class="col-md-4 d-flex justify-content-center">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <label for="foto_profil" class="form-label">Foto Profil</label>
                                <input type="file" name="foto_profil" id="foto_profil" class="form-control"
                                    onchange="previewImage(event)">
                            </div>
                            <div class="mb-4 d-flex flex-column align-items-center">
                                <img id="preview" src="{{ url('public/app/data-guru/' . $guru->foto_profil) }}"
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
                text: "Data guru akan diperbarui!",
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