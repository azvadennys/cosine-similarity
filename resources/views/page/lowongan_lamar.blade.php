@extends('index2', ['subtitle' => $subtitle])
@section('content')
    <!-- Job Details Layout -->
    <section class="my-5">
        <div class="container">
            <!-- Breadcrumb Section -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('lowongan') }}">Karir</a></li>
                    <li class="breadcrumb-item"><a
                            href="{{ route('lowongan.detail', $index->id) }}">{{ $index->position }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Lamar Lowongan</li>
                </ol>
            </nav>
        </div>
    </section>

    <div class="container my-4">
        <div class="card shadow-sm rounded p-4">
            <h2 class="mb-3">Daftar Pekerjaan</h2>
            <p class="text-muted mb-4">Pastikan seluruh informasi dan berkas yang ada di bawah sudah benar sesuai dengan
                data anda.</p>

            <form method="POST" action="{{ route('lowongan.lamar', $index->id) }}" enctype="multipart/form-data">
                @csrf

                <!-- KTP Upload -->
                <div class="row mb-2">
                    <label for="ktp" class="col-md-12">KTP</label>
                    <div class="col-md-8">
                        <input type="file" class="form-control" id="ktp" name="ktp"
                            onchange="previewFile('ktp')" @if (!$userApplication) required @endif>
                        <!-- Only add 'required' if no userApplication exists -->
                    </div>
                    <div class="col-md-4 d-flex align-items-center">
                        <button type="button" class="btn btn-info w-100" onclick="showPreview('ktp')">Lihat File</button>
                    </div>
                    @if ($userApplication && $userApplication->ktp_path)
                        <div class="mt-2">
                            <p>Existing File: <a href="{{ asset('storage/' . $userApplication->ktp_path) }}"
                                    target="_blank">View File</a></p>
                        </div>
                    @endif
                </div>

                <!-- KK Upload -->
                <div class="row mb-2">
                    <label for="kk" class="col-md-12">KK</label>
                    <div class="col-md-8">
                        <input type="file" class="form-control" id="kk" name="kk"
                            onchange="previewFile('kk')" @if (!$userApplication) required @endif>
                        <!-- Only add 'required' if no userApplication exists -->
                    </div>
                    <div class="col-md-4 d-flex align-items-center">
                        <button type="button" class="btn btn-info w-100" onclick="showPreview('kk')">Lihat File</button>
                    </div>
                    @if ($userApplication && $userApplication->kk_path)
                        <div class="mt-2">
                            <p>Existing File: <a href="{{ asset('storage/' . $userApplication->kk_path) }}"
                                    target="_blank">View File</a></p>
                        </div>
                    @endif
                </div>

                <!-- CV Upload -->
                <div class="row mb-2">
                    <label for="cv" class="col-md-12">CV</label>
                    <div class="col-md-8">
                        <input type="file" class="form-control" id="cv" name="cv"
                            onchange="previewFile('cv')" @if (!$userApplication) required @endif>
                        <!-- Only add 'required' if no userApplication exists -->
                    </div>
                    <div class="col-md-4 d-flex align-items-center">
                        <button type="button" class="btn btn-info w-100" onclick="showPreview('cv')">Lihat File</button>
                    </div>
                    @if ($userApplication && $userApplication->cv_path)
                        <div class="mt-2">
                            <p>Existing File: <a href="{{ asset('storage/' . $userApplication->cv_path) }}"
                                    target="_blank">View File</a></p>
                        </div>
                    @endif
                </div>

                <!-- Surat Lamaran Upload -->
                <div class="row mb-2">
                    <label for="surat_lamaran" class="col-md-12">Surat Lamaran</label>
                    <div class="col-md-8">
                        <input type="file" class="form-control" id="surat_lamaran" name="surat_lamaran"
                            onchange="previewFile('surat_lamaran')" @if (!$userApplication) required @endif>
                        <!-- Only add 'required' if no userApplication exists -->
                    </div>
                    <div class="col-md-4 d-flex align-items-center">
                        <button type="button" class="btn btn-info w-100" onclick="showPreview('surat_lamaran')">Lihat
                            File</button>
                    </div>
                    @if ($userApplication && $userApplication->surat_lamaran_path)
                        <div class="mt-2">
                            <p>Existing File: <a href="{{ asset('storage/' . $userApplication->surat_lamaran_path) }}"
                                    target="_blank">View File</a></p>
                        </div>
                    @endif
                </div>

                <div class="row mb-2">
                    <label for="no_hp" class="col-md-12">Nomor Telepon</label>
                    <div class="col-12">
                        <input type="tel" class="form-control" id="no_hp" name="no_hp"
                            placeholder="Masukkan Nomor Telepon" pattern="[0-9]{10,15}"
                            @if (!$userApplication) required @endif
                            @if ($userApplication) value="{{ $userApplication->no_hp }}" @endif>
                    </div>

                    <!-- Submit Button -->
                    <div class="row justify-content-center">
                        <button type="submit" class="btn btn-primary w-50 mt-3">Kirim Lamaran</button>
                    </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap Modal for File Preview -->
    <div class="modal fade" id="fileModal" tabindex="-1" aria-labelledby="fileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="fileModalLabel">File Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body justify-content-center align-items-center">
                    <div id="modal-file-content"></div> <!-- Content will be inserted dynamically -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="downloadFileBtn">Download</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript to handle file preview and modal display -->
    <script>
        function previewFile(inputId) {
            const fileInput = document.getElementById(inputId);
            const file = fileInput.files[0];

            // Handle image file preview
            if (file && file.type.startsWith("image/")) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewDiv = document.getElementById('modal-file-content');
                    previewDiv.innerHTML = `<img src="${e.target.result}" class="img-fluid" alt="File Preview">`;
                };
                reader.readAsDataURL(file);
            } else {
                const previewDiv = document.getElementById('modal-file-content');
                previewDiv.innerHTML = `<p>File: ${file.name}</p>`;
            }
        }

        function showPreview(inputId) {
            const fileInput = document.getElementById(inputId);
            const file = fileInput.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewDiv = document.getElementById('modal-file-content');
                    const downloadButton = document.getElementById('downloadFileBtn');

                    if (file.type.startsWith("image/")) {
                        previewDiv.innerHTML = `<img src="${e.target.result}" class="img-fluid" alt="File Preview">`;
                        downloadButton.style.display = 'none'; // Hide download for image files
                    } else if (file.type === 'application/pdf') {
                        previewDiv.innerHTML =
                            `<embed src="${e.target.result}" width="100%" height="500px" type="application/pdf">`;
                    } else {
                        previewDiv.innerHTML = `<p>File: ${file.name}</p>`;
                        downloadButton.style.display = 'inline-block'; // Show download button for other files
                    }

                    // Show the modal
                    const myModal = new bootstrap.Modal(document.getElementById('fileModal'));
                    myModal.show();

                    // Handle file download for non-image files
                    downloadButton.onclick = function() {
                        const a = document.createElement('a');
                        a.href = e.target.result;
                        a.download = file.name;
                        a.click();
                    };
                };
                reader.readAsDataURL(file);
            }
        }

        // Function to enable the file input when the user clicks "Ganti File"
        function enableFileInput(inputId) {
            const fileInput = document.getElementById(inputId);
            fileInput.removeAttribute('readonly');
            fileInput.value = ''; // Clear the current file
        }
    </script>
@endsection
