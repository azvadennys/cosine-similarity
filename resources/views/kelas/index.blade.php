@extends('index')

@section('content')
    <div class="container">
        <h1 class="my-4">Kelas</h1>

        <div class="row mb-3 justify-content-between">
            <!-- Left Side (Buttons) -->
            <div class="col-12 col-md-6 d-flex justify-content-between">
                <!-- Create Class Button (for admin or dosen) -->
                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'dosen')
                    <button class="btn btn-primary mb-2 mb-md-0" data-bs-toggle="modal" data-bs-target="#createClassModal">Buat
                        Kelas</button>
                @endif

                <!-- Join Class Button (for mahasiswa) -->
                @if (Auth::user()->role == 'mahasiswa')
                    <button class="btn btn-primary mb-2 mb-md-0" data-bs-toggle="modal" data-bs-target="#joinClassModal">Join
                        Kelas</button>
                @endif
            </div>

            <!-- Right Side (Search Form) -->
            <div class="col-12 col-md-6">
                <form method="GET" action="{{ route('kelas.index') }}">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" value="{{ $search }}"
                            placeholder="Search for a class">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead class="custom-thead">
                    <tr>
                        <th class="text-center text-white">No</th>
                        <th class="text-center text-white">Nama Kelas</th>
                        <th class="text-center text-white">Deskripsi</th>
                        <th class="text-center text-white">Dosen</th>

                        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'dosen')
                            <th class="text-center text-white">Kode Bergabung</th>
                        @endif

                        <th class="text-center text-white">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @if ($kelas->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center">
                                <i class="bi bi-exclamation-circle text-warning" style="font-size: 2rem;"></i>
                                <p>No classes available.</p>
                            </td>
                        </tr>
                    @else
                        @foreach ($kelas as $kls)
                            <tr>
                                <td class="text-center">
                                    {{ $loop->iteration + ($kelas->currentPage() - 1) * $kelas->perPage() }}</td>
                                <td class="text-center">{{ $kls->nama_kelas }}</td>
                                <td class="text-center">{{ \Illuminate\Support\Str::words($kls->deskripsi ?? 'No description available', 5) }}
                                </td>
                                <td class="text-center">{{ $kls->dosen->name }}</td>

                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'dosen')
                                    <td class="text-center">{{ $kls->kode_bergabung }}</td>
                                @endif

                                <td class="text-center">
                                    <div class="justify-content-start">

                                        <a href="{{ route('kelas.show', $kls->id) }}"
                                            class="btn btn-info btn-sm mx-2">Show</a>
                                        @if (Auth::user()->role == 'mahasiswa')
                                            <form action="{{ route('kelas.leave', $kls->id) }}" method="POST"
                                                class="d-inline-block mt-2" id="leave-form-{{ $kls->id }}">
                                                @csrf
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="confirmLeave({{ $kls->id }})">Leave</button>
                                            </form>
                                        @endif

                                        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'dosen')
                                            <a href="{{ route('kelas.edit', $kls->id) }}"
                                                class="btn btn-warning btn-sm mx-2">Edit</a>
                                            <form action="{{ route('kelas.destroy', $kls->id) }}" method="POST"
                                                class="d-inline-block" id="delete-form-{{ $kls->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="confirmDelete({{ $kls->id }})">Delete</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $kelas->links('pagination::bootstrap-4') }}
        </div>
    </div>

    <!-- Create Class Modal -->
    <div class="modal fade" id="createClassModal" tabindex="-1" aria-labelledby="createClassModalLabel" aria-hidden="true">
        <div class="modal-dialog modal modal-dialog-centered">
            <form method="POST" action="{{ route('kelas.store') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header text-white">
                        <h5 class="modal-title" id="createClassModalLabel">Create New Class</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="nama_kelas" class="form-label">Class Name</label>
                                    <input type="text" class="form-control" id="nama_kelas" name="nama_kelas"
                                        placeholder="Enter class name" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="dosen_id" class="form-label">Lecturer</label>
                                    <select class="form-select select2" id="dosen_id" name="dosen_id" required>
                                        <option value="" disabled selected>Select a lecturer</option>
                                        @foreach ($dosen as $dosen)
                                            <option value="{{ $dosen->id }}">{{ $dosen->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label for="deskripsi" class="form-label">Description</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4"
                                        placeholder="Enter a short description of the class"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create Class</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Join Class Modal -->
    <div class="modal fade" id="joinClassModal" tabindex="-1" aria-labelledby="joinClassModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('kelas.join') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="joinClassModalLabel">Join Class</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="kode_bergabung" class="form-label">Enter Join Code</label>
                            <input type="text" name="kode_bergabung" placeholder="Enter Join Code"
                                class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Join</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Confirmation for Leave action (Mahasiswa)
        function confirmLeave(kelasId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You will leave this class.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, leave it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the leave form if confirmed
                    document.getElementById('leave-form-' + kelasId).submit();
                }
            });
        }

        // Confirmation for Delete action (Admin/Dosen)
        function confirmDelete(kelasId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You will permanently delete this class.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the delete form if confirmed
                    document.getElementById('delete-form-' + kelasId).submit();
                }
            });
        }

        $(document).ready(function() {
            $('#dosen_id').select2({
                dropdownParent: $('#createClassModal'),
                placeholder: 'Select a lecturer',
                allowClear: true
            });
        });
    </script>
@endsection
