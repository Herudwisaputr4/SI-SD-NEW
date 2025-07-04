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

        <h4 class="mb-4">Edit Mata Pelajaran</h4>

        <form action="{{ url('admin/mapel/' . $mapel->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card mb-3">
                <div class="row g-0">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <div class="card-body">

                            <div class="mb-3">
                                <label for="kelompok" class="form-label">Kelompok</label>
                                <select name="kelompok" id="kelompok"
                                    class="form-select @error('kelompok') is-invalid @enderror" required>
                                    <option value="wajib" {{ old('kelompok', $mapel->kelompok) == 'wajib' ? 'selected' : '' }}>Wajib</option>
                                    <option value="pilihan" {{ old('kelompok', $mapel->kelompok) == 'pilihan' ? 'selected' : '' }}>Pilihan</option>
                                </select>
                                @error('kelompok')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="tingkatan" class="form-label">Tingkatan</label>
                                <select name="tingkatan" id="tingkatan"
                                    class="form-select @error('tingkatan') is-invalid @enderror" required>
                                    <option value="1" {{ old('tingkatan', $mapel->tingkatan) == '' ? 'selected' : '' }}>1</option>
                                    <option value="2" {{ old('tingkatan', $mapel->tingkatan) == '' ? 'selected' : '' }}>2</option>
                                    <option value="3" {{ old('tingkatan', $mapel->tingkatan) == '' ? 'selected' : '' }}>3</option>
                                    <option value="4" {{ old('tingkatan', $mapel->tingkatan) == '' ? 'selected' : '' }}>4</option>
                                    <option value="5" {{ old('tingkatan', $mapel->tingkatan) == '' ? 'selected' : '' }}>5</option>
                                    <option value="6" {{ old('tingkatan', $mapel->tingkatan) == '' ? 'selected' : '' }}>6</option>
                                </select>
                                @error('tingkatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nama_mapel" class="form-label">Nama Mapel</label>
                                <input type="text" name="nama_mapel" id="nama_mapel"
                                    class="form-control @error('nama_mapel') is-invalid @enderror"
                                    placeholder="Contoh: Matematika"
                                    value="{{ old('nama_mapel', $mapel->nama_mapel) }}" required>
                                @error('nama_mapel')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="guru_id" class="form-label">Guru Pengampu</label>
                                <select name="guru_id" id="guru_id"
                                    class="form-select @error('guru_id') is-invalid @enderror" required>
                                    <option value="" disabled hidden></option> 
                                    @foreach ($gurus as $guru)
                                        <option value="{{ $guru->id }}"
                                            {{ old('guru_id', $mapel->guru_id) == $guru->id ? 'selected' : '' }}>
                                            {{ $guru->username }} ({{ $guru->nip }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('guru_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="col-md-6">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea name="keterangan" id="keterangan" rows="6"
                                    class="form-control @error('keterangan') is-invalid @enderror"
                                    placeholder="Contoh: Mapel ini diajarkan di semua jenjang kelas"
                                    required>{{ old('keterangan', $mapel->keterangan) }}</textarea>
                                @error('keterangan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Tombol -->
        <div class="d-flex gap-2">
            <a href="{{ url('admin/mapel') }}" class="btn btn-outline-secondary">
                <i class="ti ti-arrow-left"></i> Kembali
            </a>
            <button type="button" class="btn btn-success" id="btnUpdate">
                <i class="ti ti-check"></i> Update Data
            </button>
        </div>
    </div>

    @push('scripts')
        <!-- Select2 -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <!-- SweetAlert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            $(document).ready(function () {
                $('.select2-selection').addClass('form-select');
                // Inisialisasi Select2
                $('#guru_id').select2({
                    placeholder: "Ketik nama atau NIP guru",
                    allowClear: true,
                    width: '100%'
                });

                // SweetAlert konfirmasi update
                const btnUpdate = document.getElementById('btnUpdate');
                const form = document.querySelector('form');

                if (btnUpdate) {
                    btnUpdate.addEventListener('click', function (e) {
                        e.preventDefault(); 
                        Swal.fire({
                            title: 'Apakah Anda yakin?',
                            text: "Data Mata Pelajaran akan diperbarui!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#28a745',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, perbarui!',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    });
                }
            });
        </script>
    @endpush

</x-admin>
