<x-admin>
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
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

        <h4 class="mb-4">Edit Tahun Ajaran</h4>

        <!-- FORM -->
        <form action="{{ url('admin/tahun-ajaran/' . $tahunajaran->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card mb-3">
                <div class="row g-0">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="tahun_ajar" class="form-label">Tahun Ajaran</label>
                                <input type="text" name="tahun_ajar" id="tahun_ajar"
                                    class="form-control @error('tahun_ajar') is-invalid @enderror"
                                    placeholder="Contoh: 2024/2025"
                                    value="{{ old('tahun_ajar', $tahunajaran->tahun_ajar) }}" required>
                                @error('tahun_ajar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <select name="deskripsi" id="deskripsi"
                                    class="form-select @error('deskripsi') is-invalid @enderror">
                                    <option value="Semester Genap" {{ old('deskripsi', $tahunajaran->deskripsi) == 'Semester Genap' ? 'selected' : '' }}>Semester Genap</option>
                                    <option value="Semester Ganjil" {{ old('deskripsi', $tahunajaran->deskripsi) == 'Semester Ganjil' ? 'selected' : '' }}>Semester Ganjil</option>
                                </select>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                                    <option value="Aktif" {{ old('status', $tahunajaran->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="Tidak Aktif" {{ old('status', $tahunajaran->status) == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="col-md-6">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="dokumen" class="form-label">Upload Dokumen (Opsional)</label>
                                <input type="file" name="dokumen" id="dokumen"
                                    class="form-control @error('dokumen') is-invalid @enderror" accept=".pdf,.doc,.docx">
                                @error('dokumen')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                @if ($tahunajaran->dokumen)
                                    <small class="d-block mt-2" id="previewText">
                                        Dokumen saat ini:
                                        <a href="{{ asset('uploads/dokumen/' . $tahunajaran->dokumen) }}" target="_blank">
                                            {{ $tahunajaran->dokumen }}
                                        </a>
                                    </small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- Tombol Di Luar Form -->
        <div class="d-flex gap-2">
            <a href="{{ url('admin/siswa') }}" class="btn btn-outline-secondary">
                <i class="ti ti-arrow-left"></i> Back
            </a>
            <button type="button" class="btn btn-success" id="btnUpdate">
                <i class="ti ti-check"></i> Update Data
            </button>
        </div>
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
                text: "Data Tahun Ajaran akan diperbarui!",
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
