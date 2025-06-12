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
                                <option value="1" {{ old('tingkatan') == '1' ? 'selected' : '' }}>1</option>
                                <option value="2" {{ old('tingkatan') == '2' ? 'selected' : '' }}>2</option>
                                <option value="3" {{ old('tingkatan') == '3' ? 'selected' : '' }}>3</option>
                                <option value="4" {{ old('tingkatan') == '4' ? 'selected' : '' }}>4</option>
                                <option value="5" {{ old('tingkatan') == '5' ? 'selected' : '' }}>5</option>
                                <option value="6" {{ old('tingkatan') == '6' ? 'selected' : '' }}>6</option>
                            </select>
                            @error('tingkatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Nama Kelas --}}
                        <div class="col-md-6 mb-3">
                            <label for="nama_kelas" class="form-label">Nama Kelas</label>
                            <input type="text" name="nama_kelas" id="nama_kelas" class="form-control @error('nama_kelas') is-invalid @enderror" value="{{ old('nama_kelas') }}" required>
                            @error('nama_kelas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="guru_id" class="form-label">Wali Kelas</label>
                            <select name="guru_id" id="guru_id" class="form-control @error('guru_id') is-invalid @enderror" required>
                                <option value="" disabled {{ old('guru_id', $kelas->guru_id ?? '') == '' ? 'selected' : '' }}>
                                    Pilih Wali Kelas
                                </option>
                                @foreach ($gurus as $guru)
                                    <option value="{{ $guru->id }}" {{ old('guru_id', $kelas->guru_id ?? '') == $guru->id ? 'selected' : '' }}>
                                        {{ $guru->nama ?? $guru->username }}
                                    </option>
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
</x-admin>
