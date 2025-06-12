<x-admin>
    <div class="container-fluid">
        <h4 class="mb-4">Edit Data Kelas</h4>

        {{-- Pesan sukses atau error --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        {{-- Tampilkan pesan error validasi --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('admin/kelas/' . $kelas->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        {{-- Sekolah ID (hidden) --}}
                        <input type="text" name="sekolah_id" value="{{ Auth::guard('admin')->user()->sekolah_id }}" hidden>

                        {{-- Tingkatan --}}
                        <div class="col-md-6 mb-3">
                            <label for="tingkatan" class="form-label">Tingkatan</label>
                            <select name="tingkatan" id="tingkatan" class="form-control @error('tingkatan') is-invalid @enderror" required>
                                <option value="" disabled {{ old('tingkatan', $kelas->tingkatan) == '' ? 'selected' : '' }}>Pilih Tingkatan</option>
                                @for ($i = 1; $i <= 6; $i++)
                                    <option value="{{ $i }}" {{ old('tingkatan', $kelas->tingkatan) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            @error('tingkatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Nama Kelas --}}
                        <div class="col-md-6 mb-3">
                            <label for="nama_kelas" class="form-label">Nama Kelas</label>
                            <input type="text" name="nama_kelas" id="nama_kelas" class="form-control @error('nama_kelas') is-invalid @enderror" value="{{ old('nama_kelas', $kelas->nama_kelas) }}" required>
                            @error('nama_kelas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Wali Kelas (guru_id) --}}
                        <div class="col-md-6 mb-3">
                            <label for="guru_id" class="form-label">Wali Kelas</label>
                            <select name="guru_id" id="guru_id" class="form-control @error('guru_id') is-invalid @enderror" required>
                                <option value="" disabled {{ old('guru_id', $kelas->guru_id) == '' ? 'selected' : '' }}>
                                    Pilih Wali Kelas
                                </option>
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

                        {{-- Tahun Ajaran --}}
                        <div class="col-md-6 mb-3">
                            <label for="tahun_ajaran_id" class="form-label">Tahun Ajaran</label>
                            <select name="tahun_ajaran_id" id="tahun_ajaran_id" class="form-control @error('tahun_ajaran_id') is-invalid @enderror" required>
                                <option value="" disabled {{ old('tahun_ajaran_id', $kelas->tahun_ajaran_id) ? '' : 'selected' }}>
                                    Pilih Tahun Ajaran
                                </option>
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
            </div>

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

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const btnUpdate = document.getElementById('btnUpdate');
        const form = document.querySelector('form');

        btnUpdate.addEventListener('click', function () {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data kelas akan diperbarui!",
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
