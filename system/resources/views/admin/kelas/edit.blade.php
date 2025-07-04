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

        <h4 class="mb-4">Edit Data Kelas</h4>

        <form action="{{ url('admin/kelas/' . $kelas->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card mb-3">
                <div class="row g-0">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <div class="card-body">

                            {{-- Tingkatan --}}
                            <div class="mb-3">
                                <label for="tingkatan" class="form-label">Tingkatan</label>
                                <select name="tingkatan" id="tingkatan" class="form-select @error('tingkatan') is-invalid @enderror" required>
                                    <option value="1" {{ old('tingkatan', $kelas->tingkatan) == '1' ? 'selected' : '' }}>1</option>
                                    <option value="2" {{ old('tingkatan', $kelas->tingkatan) == '2' ? 'selected' : '' }}>2</option>
                                    <option value="3" {{ old('tingkatan', $kelas->tingkatan) == '3' ? 'selected' : '' }}>3</option>
                                    <option value="4" {{ old('tingkatan', $kelas->tingkatan) == '4' ? 'selected' : '' }}>4</option>
                                    <option value="5" {{ old('tingkatan', $kelas->tingkatan) == '5' ? 'selected' : '' }}>5</option>
                                    <option value="6" {{ old('tingkatan', $kelas->tingkatan) == '6' ? 'selected' : '' }}>6</option>
                                </select>
                                @error('tingkatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Nama Kelas --}}
                            <div class="mb-3">
                                <label for="nama_kelas" class="form-label">Nama Kelas</label>
                                <select name="nama_kelas" id="nama_kelas" class="form-select @error('nama_kelas') is-invalid @enderror" required>
                                    <option value="A" {{ old('nama_kelas', $kelas->nama_kelas) == 'A' ? 'selected' : '' }}>A</option>
                                    <option value="B" {{ old('nama_kelas', $kelas->nama_kelas) == 'B' ? 'selected' : '' }}>B</option>
                                    <option value="C" {{ old('nama_kelas', $kelas->nama_kelas) == 'C' ? 'selected' : '' }}>C</option>
                                    <option value="D" {{ old('nama_kelas', $kelas->nama_kelas) == 'D' ? 'selected' : '' }}>D</option>
                                    <option value="E" {{ old('nama_kelas', $kelas->nama_kelas) == 'E' ? 'selected' : '' }}>E</option>
                                    <option value="F" {{ old('nama_kelas', $kelas->nama_kelas) == 'F' ? 'selected' : '' }}>F</option>
                                </select>
                                @error('nama_kelas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tahun Ajaran --}}
                            <div class="mb-3">
                                <label for="tahun_ajaran_id" class="form-label">Tahun Ajaran</label>
                                <select name="tahun_ajaran_id" id="tahun_ajaran_id" class="form-select @error('tahun_ajaran_id') is-invalid @enderror" required>
                                    <option value="" disabled hidden>Pilih Tahun Ajaran</option>
                                    @foreach ($tahunAjarans as $tahun)
                                        <option value="{{ $tahun->id }}" {{ old('tahun_ajaran_id', $kelas->tahun_ajaran_id) == $tahun->id ? 'selected' : '' }}>
                                            {{ $tahun->tahun_ajar }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('tahun_ajaran_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="col-md-6">
                        <div class="card-body">
                            {{-- Pilih Siswa --}}
                            <div class="mb-3">
                                <label for="siswa_id" class="form-label">Pilih Siswa</label>
                                <select name="siswa_id[]" id="siswa_id" class="form-select select2-siswa @error('siswa_id') is-invalid @enderror" multiple required>
                                    @php
                                        $siswaTerdaftar = $kelas->siswa ? $kelas->siswa->pluck('id')->toArray() : [];
                                    @endphp
                                    @foreach ($siswas as $siswa)
                                        <option value="{{ $siswa->id }}"
                                            {{ in_array($siswa->id, $siswaTerdaftar) ? 'selected' : '' }}>
                                            {{ $siswa->nama_siswa }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('siswa_id')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Wali Kelas --}}
                            <div class="mb-3">
                                <label for="guru_id" class="form-label">Wali Kelas</label>
                                <select name="guru_id" id="guru_id" class="form-select @error('guru_id') is-invalid @enderror" required>
                                    <option value="" disabled hidden></option>
                                    @foreach ($gurus as $guru)
                                        <option value="{{ $guru->id }}" {{ old('guru_id', $kelas->guru_id) == $guru->id ? 'selected' : '' }}>
                                            {{ $guru->nama ?? $guru->username }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('guru_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol -->
            <div class="d-flex gap-2">
                <a href="{{ url('admin/kelas') }}" class="btn btn-outline-secondary">
                    <i class="ti ti-arrow-left"></i> Kembali
                </a>
                <button type="button" class="btn btn-success" id="btnUpdate">
                    <i class="ti ti-check"></i> Update Data
                </button>
            </div>
        </form>
    </div>

    @push('scripts')
        <!-- Select2 -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <!-- SweetAlert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            $(document).ready(function () {
                $('#guru_id').select2({
                    placeholder: "Ketik nama atau NIP guru",
                    allowClear: true,
                    width: '100%'
                });

                $('#siswa_id').select2({
                    placeholder: "Cari & pilih siswa...",
                    allowClear: true,
                    width: '100%'
                });

                const btnUpdate = document.getElementById('btnUpdate');
                const form = document.querySelector('form');

                if (btnUpdate) {
                    btnUpdate.addEventListener('click', function (e) {
                        e.preventDefault();
                        Swal.fire({
                            title: 'Apakah Anda yakin?',
                            text: "Data Kelas akan diperbarui!",
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
