<x-admin>
    <div class="container-fluid">
        <h4 class="mb-4">Tambah Mata Pelajaran</h4>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('admin/mapel') }}" method="POST">
            @csrf
            @method("POST")
            <div class="card p-4 mb-4">
                <div class="row">
                    <input type="text" name="sekolah_id" value="{{ Auth::guard('admin')->user()->sekolah_id }}" hidden>

                    <div class="col-md-6">

                        <div class="mb-3">
                            <label for="kelompok" class="form-label">Kelompok</label>
                            <select name="kelompok" id="kelompok" class="form-control @error('kelompok') is-invalid @enderror" required>
                                <option value="" disabled selected hidden>Pilih Kelompok</option>
                                <option value="wajib">Wajib</option>
                                <option value="pilihan">Pilihan</option>
                            </select>
                            @error('kelompok')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
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

                        <div class="mb-3">
                            <label for="nama_mapel" class="form-label">Nama Mapel</label>
                            <input type="text" name="nama_mapel" id="nama_mapel" class="form-control @error('nama_mapel') is-invalid @enderror" placeholder="nama mapel" required>
                            @error('nama_mapel')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="guru_id" class="form-label">Pilih Guru Pengampu</label>
                            <select name="guru_id[]" id="guru_id" class="form-select select2-guru @error('guru_id') is-invalid @enderror" multiple required>
                                @foreach ($gurus as $guru)
                                    <option value="{{ $guru->id }}" {{ collect(old('guru_id'))->contains($guru->id) ? 'selected' : '' }}>
                                        {{ $guru->username }} ({{ $guru->nip }})
                                    </option>
                                @endforeach
                            </select>
                            @error('guru_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" rows="5" class="form-control @error('keterangan') is-invalid @enderror" placeholder="" required></textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ url('admin/mapel') }}" class="btn btn-outline-secondary">
                    <i class="ti ti-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="ti ti-check"></i> Simpan Data
                </button>
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
                $('.select2-guru').select2({
                    placeholder: "Cari & pilih guru...",
                    width: '100%',
                    allowClear: true
                });
            });
        </script>
    @endpush

</x-admin>



