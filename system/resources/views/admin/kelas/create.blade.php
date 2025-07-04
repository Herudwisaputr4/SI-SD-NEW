<x-admin>
    <div class="container-fluid">
        <h4 class="mb-4">Tambah Data Kelas</h4>
        {{-- Tampilkan pesan error --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('admin/kelas') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <input type="text" name="sekolah_id" value="{{ Auth::guard('admin')->user()->sekolah_id }}" hidden>
                        {{-- Tingkatan --}}
                        <div class="col-md-6 mb-3">
                            <label for="tingkatan" class="form-label">Tingkatan</label>
                            <select name="tingkatan" id="tingkatan" class="form-control @error('tingkatan') is-invalid @enderror" required>
                                <option value="" disabled selected>Pilih Tingkatan</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                            </select>
                            @error('tingkatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Nama Kelas --}}
                        <div class="col-md-6 mb-3">
                            <label for="nama_kelas" class="form-label">Nama Kelas</label>
                            <select name="nama_kelas" id="nama_kelas" class="form-control @error('nama_kelas') is-invalid @enderror" required>
                                <option value="" disabled selected>Pilih Nama Kelas</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                                <option value="F">F</option>
                            </select>
                            @error('nama_kelas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Pilih Siswa --}}
                        <div class="col-md-6 mb-3">
                            <label for="siswa_id" class="form-label">Pilih Siswa</label>
                            <select name="siswa_id[]" id="siswa_id" class="form-select select2-siswa @error('siswa_id') is-invalid @enderror" multiple required>
                                @foreach ($siswas as $siswa)
                                    <option value="{{ $siswa->id }}" {{ collect(old('siswa_id'))->contains($siswa->id) ? 'selected' : '' }}>
                                        {{ $siswa->nama_siswa }} - {{ $siswa->nisn }}
                                    </option>
                                @endforeach
                            </select>
                            @error('siswa_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="guru_id" class="form-label">Wali Kelas</label>
                             <select name="guru_id" id="guru_id" class="form-select @error('guru_id') is-invalid @enderror" required>
                                <option value="" disabled selected hidden>Pilih Guru</option>
                                    Pilih Wali Kelas
                                </option>
                                @foreach ($gurus as $guru)
                                    <option value="{{ $guru->id }}">{{ $guru->username }} ({{ $guru->nip }})</option>
                                @endforeach
                            </select>
                            @error('guru_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Tahun Ajaran --}}
                        <div class="col-md-6 mb-3">
                            <label for="tahun_ajaran_id" class="form-label">Tahun Ajaran</label>
                            <select name="tahun_ajaran_id" id="tahun_ajaran_id" class="form-control @error('tahun_ajaran_id') is-invalid @enderror" required>
                                <option value="" disabled {{ old('tahun_ajaran_id') ? '' : 'selected' }}>Pilih Tahun Ajaran</option>
                                @foreach ($tahunAjarans as $tahun)
                                    <option value="{{ $tahun->id }}" {{ old('tahun_ajaran_id') == $tahun->id ? 'selected' : '' }}>
                                        {{ $tahun->tahun_ajar }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tahun_ajaran_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    <div class="d-flex gap-2">
                        <a href="{{ url('admin/kelas') }}" class="btn btn-outline-secondary">
                            <i class="ti ti-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="ti ti-check"></i> Simpan Data
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @push('scripts')
    <!-- Select2 CSS dan JS -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <!-- Aktifkan Select2 -->
        <script>
            $(document).ready(function() {
                $('.select2-siswa').select2({
                    placeholder: "Cari & pilih siswa...",
                    width: '100%',
                    allowClear: true
                });
            });
        </script>
    @endpush

</x-admin>
