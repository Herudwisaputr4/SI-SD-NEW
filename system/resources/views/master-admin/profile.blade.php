<x-master-admin>
    <div class="container-fluid mt-4">
        <h4 class="mb-4 fw-semibold text-primary">Pengaturan Akun</h4>

        <!-- Card Modal Pengaturan Profil -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-light fw-semibold">
                <i class="ti ti-info-circle me-2 text-primary"></i> Info Profil
            </div>

            <div class="card-body text-center">
                <p class="text-muted mb-4">Waktunya untuk Membuat Profilmu Lebih Keren! Mulai Update Sekarang!</p>
            </div>
        </div>

        <!-- Modal Pengaturan Profil -->
        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Update Profil</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Waktunya untuk membuat profilmu lebih keren! Pastikan untuk memperbarui foto profil, username, dan email Anda.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary" onclick="document.getElementById('updateForm').scrollIntoView();">Update Sekarang</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Pengaturan Profil -->
        <div class="card shadow-sm border-0">
            <div class="card-header bg-light fw-semibold">
                <i class="ti ti-settings me-2 text-primary"></i> Pengaturan Profil
            </div>

            <div class="card-body">
                <!-- Foto Profil Preview -->
                <div class="text-center mb-4">
                    <img id="currentProfile"
                        src="{{ url('public/app/data-master-admin/' . Auth::user()->foto_profil) }}"
                        alt="Foto Profil"
                        class="rounded-circle border"
                        style="width: 150px; height: 150px; object-fit: cover;">
                    <p class="mt-2 text-muted">Preview foto anda</p>
                </div>

                <!-- Form Update Profil -->
                <form id="updateForm" action="{{ url('master-admin/profil/' . $masterAdmin->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="row">
                        <!-- Username -->
                        <div class="col-md-6 mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" id="username" name="username"
                                   class="form-control" value="{{ Auth::user()->username }}" required>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email"
                                   class="form-control" value="{{ Auth::user()->email }}" required>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password Baru</label>
                        <input type="password" id="password" name="password"
                               class="form-control" placeholder="Kosongkan jika tidak ingin mengubah password">
                    </div>

                    <!-- Foto Profil -->
                    <div class="mb-4">
                        <label for="foto_profil" class="form-label">Pilih Foto Baru</label>
                        <input type="file" name="foto_profil" id="foto_profil"
                               class="form-control" accept="image/*" onchange="previewImage(event)">
                    </div>

                    <!-- Tombol -->
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-success" onclick="confirmSave()">
                            <i class="ti ti-check me-1"></i> Simpan
                        </button>
                        <a href="{{ url('master-admin') }}" class="btn btn-outline-secondary">
                            <i class="ti ti-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JS SweetAlert & Preview Image -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>


        function previewImage(event) {
            const preview = document.getElementById('currentProfile');
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = () => {
                    preview.src = reader.result;
                };
                reader.readAsDataURL(file);
            }
        }

        function confirmSave() {
            Swal.fire({
                title: 'Simpan Perubahan',
                text: 'Pastikan anda yakin dengan data yang anda masukkan.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Simpan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('updateForm').submit();
                }
            });
        }
    </script>
</x-master-admin>