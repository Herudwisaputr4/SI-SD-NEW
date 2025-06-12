<x-master-admin>
  <div class="container-fluid p-4">
      <div class="row">
          <!-- Card Data Admin (Biru) -->
          <div class="col-md-6 mb-3">
              <div class="card text-white bg-primary">
                  <div class="card-body">
                      <div class="d-flex align-items-center">
                          <div class="rounded-circle d-flex align-items-center justify-content-center" style="background-color: #679aed; width: 70px; height: 70px;">
                              <i class="ti ti-user" style="font-size: 36px;"></i>
                          </div>
                          <div class="ms-3">
                              <h3 class="card-title mb-0 text-white">Total Admin</h3>
                              <small class="d-block text-white-50 mb-1">Mereka yang menjaga sistem tetap berjalan rapi.</small>
                              <p class="mb-0">
                                  Jumlah admin saat ini: {{ $totalAdmin ?? 'N/A' }}
                              </p>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <!-- Card Data Sekolah (Oranye) -->
          <div class="col-md-6 mb-3">
              <div class="card text-white" style="background-color: orange;">
                  <div class="card-body">
                      <div class="d-flex align-items-center">
                          <div class="rounded-circle d-flex align-items-center justify-content-center" style="background-color: #FFD580; width: 70px; height: 70px;">
                              <i class="ti ti-home" style="font-size: 36px;"></i>
                          </div>
                          <div class="ms-3">
                              <h5 class="card-title mb-0 text-white">Total Sekolah</h5>
                              <small class="d-block text-white-50 mb-1">Jaringan pendidikan yang terus tumbuh dan berkembang.</small>
                              <p class="mb-0">
                                  Jumlah sekolah saat ini: {{ $totalSekolah ?? 'N/A' }}
                              </p>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</x-master-admin>
