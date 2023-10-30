@extends('layouts.app')
@section('title', 'User')
@section('content')
    <div class="row">
        <div class="col d-flex justify-content-between mb-2">
            <a class="btn" style="background-color:#030A48; color: white" href="{{url('/dashboard')}}">
                Kembali</a>
            <button type="button" class="btn btn-success" style="background-color: #030A48;" data-bs-toggle="modal"
                    data-bs-target="#tambah-user-modal"> Tambah
            </button>
            <!-- Tambah User Modal -->
            <div class="modal fade" id="tambah-user-modal" tabindex="-1"
                 aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah User</h1>
                        </div>
                        <div class="modal-body">
                            <form id="tambah-user-form">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input placeholder="Username" type="text" class="form-control mb-3" name="username"
                                           required/>
                                    <label>Password</label>
                                    <input placeholder="Password" type="text" name="password" class="form-control mb-3"
                                           required autocomplete="off">
                                    <label>Role</label>
                                    <select name="role" class="form-select mb-3" required>
                                        <option selected value="keluarga">Keluarga</option>
                                        <option selected value="admin">Admin</option>
                                        <option selected value="kader">Kader</option>
                                    </select>
                                    <label class="d-block">File : </label>
                                    <div class="row d-flex align-items-center">
                                        <div class="col-3">
                                            <label for="fileUpload"
                                                   class="btn p-1 w-100 btn-outline-success form-control">Upload
                                                File</label>
                                                <input type="file" accept=".pdf, image/*, .txt, .doc, .docx" name="file" id="fileUpload" class="d-none">
                                        </div>
                                    @csrf
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" style="color: white" data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="submit" class="btn" style="background-color:#030A48; color:white;" form="tambah-user-form">Tambah</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center ">
        <div class="col-md">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-hovered DataTable">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>File</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                            ?>
                        @foreach($user as $u)
                            <tr idUser="{{$u->id}}">
                                <td class="col-1">{{$no++}}</td>
                                <td>{{$u->username}}</td>
                                <td class="text-capitalize">{{$u->role}}</td>
                                <td class="col-1">
                                    @if($u->file)
                                        <a class="btn btn-gradient" style="color: white"
                                           href="{{url("dashboard/user?path=$u->file", ['download'])}}">Download</a>
                                    @else
                                        <p>No File</p>
                                    @endif
                                </td>
                                <td class="col-2">
                                    <!-- Button trigger edit modal -->
                                    <button type="button" style="background-color:#030A48; color: white" class=" btn btn-gradient editBtn" data-bs-toggle="modal"
                                            data-bs-target="#edit-modal-{{$u->id}}" idUser="{{$u->id}}">
                                        Edit
                                    </button>
                                    <button class="btn hapusBtn" style="background-color: #F80000; color:white;">Hapus</button>
                                </td>
                            </tr>
                            <!-- Edit User Modal -->
                            <div class="modal fade" id="edit-modal-{{$u->id}}" tabindex="-1"
                                 aria-labelledby="exampleModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5 editBtn" id="exampleModalLabel">Edit User</h1>
                                        </div>
                                        <div class="modal-body">
                                            <form id="edit-user-form-{{$u->id}}" action="">
                                                <div class="form-group">
                                                    <label>Username</label>
                                                    <input placeholder="Username" type="text" class="form-control mb-3"
                                                           name="username"
                                                           value="{{$u->username}}"
                                                           required/>
                                                    <label>Role</label>
                                                    <select name="role" class="form-select mb-3" required>
                                                        <option @if($u->role == 'keluarga') selected
                                                                @endif value="keluarga">Keluarga
                                                        </option>
                                                        <option @if($u->role == 'admin') selected @endif value="admin">
                                                            Admin
                                                        </option>
                                                        <option @if($u->role == 'kader') selected @endif value="kader">
                                                            Kader
                                                        </option>
                                                    </select>
                                                    <label class="d-block">File : </label>
                                                    <div class="row d-flex align-items-center">
                                                        <div class="col-3">
                                                            <label
                                                                class="btn p-1 w-100 btn-outline-success form-control">
                                                                <span>Upload File</span>
                                                                <input type="file" name="file" class="d-none"
                                                                       id="fileUpload">
                                                            </label>
                                                        </div>
                                                    @csrf
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Cancel
                                            </button>
                                            <button type="submit" style="background-color:#030A48; color: white" class="btn btn-gradient edit-btn"
                                                    form="edit-user-form-{{$u->id}}">
                                                Edit
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('footer')
    <script type="module">
        $(document).ready(function () {
            $('.table').DataTable();
            $('#tambah-user-form').on('submit', function (e) {
                e.preventDefault();
                let data = new FormData(this);
                axios.post('/dashboard/user/tambah', Object.fromEntries(data))
                    .then(() => {
                        $('#tambah-user-modal').modal('hide');
                        swal.fire('Berhasil tambah data!', '', 'success').then(function () {
                            location.reload();
                        });
                    })
                    .catch(() => {
                        swal.fire('Berhasil Tambah Data!', '', 'success');
                    });
            });

            // Edit Pengguna
            $('.editBtn').on('click', function () {
                let id = $(this).attr('idUser');
                $(`#edit-user-form-${id}`).on('submit', function (e) {
                    e.preventDefault();
                    let data = new FormData(this);
                    axios.post(`/dashboard/user/${id}/edit`, Object.fromEntries(data))
                        .then(() => {
                            $(`#edit-modal-${id}`).modal('hide');
                            swal.fire('Berhasil edit data!', '', 'success').then(function () {
                                location.reload();
                            });
                        })
                        .catch(() => {
                            swal.fire('Berhasil edit data!', '', 'success');
                        });
                });
            });

            // Hapus Pengguna
            $('.table').on('click', '.hapusBtn', function () {
                let idUser = $(this).closest('tr').attr('idUser');
                swal.fire({
                    title: "Apakah anda ingin menghapus data ini?",
                    showCancelButton: true,
                    confirmButtonText: 'Setuju',
                    cancelButtonText: `Batal`,
                    confirmButtonColor: 'red'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.delete(`/dashboard/user/${idUser}/delete`)
                            .then(function (response) {
                                if (response.data.success) {
                                    swal.fire('Berhasil dihapus!', '', 'success').then(function () {
                                        location.reload();
                                    });
                                } else {
                                    swal.fire('Gagal dihapus!', '', 'warning').then(function () {
                                        location.reload();
                                    });
                                }
                            })
                            .catch(function (error) {
                                swal.fire('Data gagal dihapus!', '', 'error').then(function () {
                                    location.reload();
                                });
                            });
                    }
                });
            });
        });
    </script>
@endsection
