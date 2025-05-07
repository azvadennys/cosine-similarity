@extends('index')

@section('content')
    <div class="container">
        <h1 class="my-4">Pengguna</h1>

        <div class="row mb-3 justify-content-between">
            <!-- Left Side (Buttons) -->
            <div class="col-12 col-md-6 d-flex justify-content-between">
                <!-- Create User Button -->
                <button class="btn btn-primary mb-2 mb-md-0" data-bs-toggle="modal" data-bs-target="#createUserModal">Buat Pengguna</button>
            </div>

            <!-- Right Side (Search Form) -->
            <div class="col-12 col-md-6">
                <form method="GET" action="{{ route('pengguna.index') }}">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" value="{{ $search }}"
                            placeholder="Search for a user">
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
                        <th class="text-center text-white">Nama</th>
                        <th class="text-center text-white">Email</th>
                        <th class="text-center text-white">Role</th>
                        <th class="text-center text-white">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @if ($users->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center">
                                <i class="bi bi-exclamation-circle text-warning" style="font-size: 2rem;"></i>
                                <p>No Users Available.</p>
                            </td>
                        </tr>
                    @else
                        @foreach ($users as $index)
                            <tr>
                                <td class="text-center">
                                    {{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                                <td class="text-center">{{ $index->name }}</td>
                                <td class="text-center">{{ $index->email }}</td>
                                <td class="text-center">{{ $index->role }}</td>

                                <td class="text-center">
                                    <div class="justify-content-start">
                                        <!-- Edit Button -->
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editUserModal" data-id="{{ $index->id }}" data-name="{{ $index->name }}" data-email="{{ $index->email }}" data-role="{{ $index->role }}">Edit</button>

                                        <!-- Delete Button -->
                                        <button class="btn btn-danger btn-sm" onclick="confirmDelete({{ $index->id }})">Delete</button>

                                        <!-- Delete Form -->
                                        <form id="delete-form-{{ $index->id }}" action="{{ route('pengguna.destroy', $index->id) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                        </form>
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
            {{ $users->links('pagination::bootstrap-4') }}
        </div>
    </div>

    <!-- Create User Modal -->
    <div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form method="POST" action="{{ route('pengguna.store') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header text-white">
                        <h5 class="modal-title" id="createUserModalLabel">Buat Pengguna Baru</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select name="role" class="form-select" required>
                                <option value="admin">Admin</option>
                                <option value="dosen">Dosen</option>
                                <option value="mahasiswa">Mahasiswa</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Buat Pengguna</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form method="POST" action="{{ route('pengguna.update', ['pengguna' => 0]) }}" id="edit-user-form">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header text-white">
                        <h5 class="modal-title" id="editUserModalLabel">Edit Pengguna</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit-name" class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control" id="edit-name" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="edit-email" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-password" class="form-label">Password (Kosongkan jika tidak ingin mengubah)</label>
                            <input type="password" name="password" class="form-control" id="edit-password">
                        </div>
                        <div class="mb-3">
                            <label for="edit-role" class="form-label">Role</label>
                            <select name="role" class="form-select" id="edit-role" required>
                                <option value="admin">Admin</option>
                                <option value="dosen">Dosen</option>
                                <option value="mahasiswa">Mahasiswa</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Pengguna</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        // Pre-fill Edit Modal with user data
        document.addEventListener('click', function(e) {
            if (e.target.matches('[data-bs-target="#editUserModal"]')) {
                const userId = e.target.getAttribute('data-id');
                const userName = e.target.getAttribute('data-name');
                const userEmail = e.target.getAttribute('data-email');
                const userRole = e.target.getAttribute('data-role');

                // Set form action URL
                const form = document.getElementById('edit-user-form');
                form.action = `/pengguna/${userId}`;

                // Pre-fill the form fields
                document.getElementById('edit-name').value = userName;
                document.getElementById('edit-email').value = userEmail;
                document.getElementById('edit-role').value = userRole;
            }
        });

        // Confirmation for Delete action (Admin/Dosen)
        function confirmDelete(userId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You will permanently delete this user.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the delete form if confirmed
                    document.getElementById('delete-form-' + userId).submit();
                }
            });
        }
    </script>
@endsection
