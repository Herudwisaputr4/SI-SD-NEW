<x-master-admin>
    <div class="container-fluid">
       @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h4 class="mb-4">Edit Data Admin</h4>
        <form action="{{ url('master-admin/data-admin/' . $admin->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card mb-3">
                <div class="row g-0">
                    <!-- Form Input -->
                    <div class="col-md-8">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="username" class="form-label">Nama</label>
                                <input type="text" name="username" id="username" class="form-control"
                                    value="{{ old('username', $admin->username) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', $admin->email) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Nomor HP</label>
                                <input type="number" name="phone" id="phone" class="form-control"
                                    value="{{ old('phone', $admin->phone) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password <small>(Kosongkan jika tidak diubah)</small></label>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Masukkan password baru">
                            </div>
                            <div class="mb-3">
                                <label for="asal_sekolah" class="form-label">Asal Sekolah</label>
                                <select name="sekolah_id" id="sekolah_id" class="form-select">
                                    <option value=""disabled selected>Pilih sekolah</option>
                                    @foreach ($sekolahs as $sekolah)
                                        <option value="{{$sekolah->id}}"{{$admin->sekolah_id == $sekolah->id ? 'selected' : ''}}>{{$sekolah->nama_sekolah}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="foto_profil" class="form-label">Foto Profil</label>
                                <input type="file" name="foto_profil" id="foto_profil" class="form-control"
                                    onchange="previewImage(event)">
                            </div>
                        </div>
                    </div>
                    <!-- Preview Foto -->
                    <div class="col-md-4 d-flex align-items-center justify-content-center">
                        <div class="text-center">
                            <img id="preview" src="{{ url('public/app/data-admin/'.$admin->foto_profil) }}" alt="Preview Foto Profil"
                                class="img-fluid rounded" style="max-width: 120px;">
                            <p id="previewText" style="display: none;">Preview foto akan muncul disini.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ url('master-admin/data-admin') }}" class="btn btn-outline-secondary">
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
                text: "Data admin akan diperbarui!",
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

</x-master-admin>
