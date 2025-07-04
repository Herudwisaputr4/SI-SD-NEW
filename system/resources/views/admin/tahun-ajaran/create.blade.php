<x-admin>
    <div class="container-fluid">
        <h4 class="mb-4">Tambah Tahun Ajaran</h4>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('admin/tahun-ajaran') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("POST")
            <div class="card p-4 mb-4">
                <div class="row">
                    <input type="text" name="sekolah_id" value="{{ Auth::guard('admin')->user()->sekolah_id }}" hidden>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tahun_ajar" class="form-label">Tahun Ajaran</label>
                            <input type="text" name="tahun_ajar" id="tahun_ajar" class="form-control" placeholder="Contoh: 2024/2025" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <select name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" required>
                                <option value="" disabled selected hidden>Pilih Deskripsi</option>
                                <option value="Semester Ganjil">Semester Ganjil</option>
                                <option value="Semester Genap">Semester Genap</option>
                            </select>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                <option value="" disabled selected hidden>Pilih Status</option>
                                <option value="aktif">Aktif</option>
                                <option value="tidak aktif">Tidak Aktif</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 d-flex flex-column align-items-center justify-content-center">
                        <div class="mb-3 w-100">
                            <label for="dokumen" class="form-label">Upload Dokumen (PDF)</label>
                            <input type="file" name="dokumen" id="dokumen" class="form-control" accept=".pdf" required>
                        </div>
                        <div class="text-muted small">
                            * Maksimal 4MB, format PDF
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ url('admin/tahun-ajaran') }}" class="btn btn-outline-secondary">
                    <i class="ti ti-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="ti ti-check"></i> Simpan Data
                </button>
            </div>
        </form>
    </div>
</x-admin>
