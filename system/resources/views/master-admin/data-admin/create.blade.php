<x-master-admin>
    <div class="container-fluid">
        @if ($errors)
            @foreach ($errors->all() as $key => $message)
                <div class="alert alert-danger">{{ $message }}</div>
            @endforeach
        @endif
        <h4 class="mb-4">Tambah Data Admin</h4>
        <form action="{{ url('master-admin/data-admin') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card mb-3">
                <div class="row g-0">
                    <!-- Form Input -->
                    <div class="col-md-8">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="username" class="form-label">Nama</label>
                                <input type="text" name="username" id="username" class="form-control"
                                    placeholder="Masukkan nama admin" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control"
                                    placeholder="Masukkan email" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Nomor HP</label>
                                <input type="number" name="phone" id="phone" class="form-control"
                                    placeholder="Masukkan nomor HP" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Masukkan password" required>
                            </div>
                            <div class="mb-3">
                                <label for="sekolah_id" class="form-label">Asal Sekolah</label>
                                <select name="sekolah_id" id="sekolah_id" class="form-control" required>
                                    <option value=""disabled selected>Pilih sekolah</option>
                                    @foreach ($sekolahs as $sekolah)
                                        <option value="{{$sekolah->id}}">{{$sekolah->nama_sekolah}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="foto_profil" class="form-label">Foto Profil</label>
                                <input type="file" name="foto_profil" id="foto_profil" class="form-control" required
                                    onchange="previewImage(event)">
                            </div>
                        </div>
                    </div>
                    <!-- Preview Foto -->
                    <div class="col-md-4 d-flex align-items-center justify-content-center">
                        <div class="text-center">
                            <img id="preview" src="#" alt="Preview Foto Profil" class="img-fluid rounded"
                                style="display: none; max-width: 120px;">
                            <p id="previewText">Preview foto akan muncul disini.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ url('master-admin/data-admin') }}" class="btn btn-outline-secondary">
                    <i class="ti ti-arrow-left"></i> Back
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="ti ti-check"></i> Simpan Data
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
                    preview.style.display = 'block';
                    previewText.style.display = 'none';
                }
                reader.readAsDataURL(file);
            } else {
                preview.src = '#';
                preview.style.display = 'none';
                previewText.style.display = 'block';
            }
        }
    </script>
</x-master-admin>