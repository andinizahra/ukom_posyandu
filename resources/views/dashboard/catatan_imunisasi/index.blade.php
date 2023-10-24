@extends('layouts.app')
@section('title', 'Catatan Imunisasi')
@section('content')
    <div class="row">
        <div class="col d-flex justify-content-between mb-2">
            <a class="btn btn-gradient" style="background-color:#030A48; color: white" href="{{url('/dashboard')}}">
                Kembali</a>
            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                    data-bs-target="#tambah-imunisasi-modal"> Tambah
            </button>
            <!-- Tambah imunisasi Modal -->
            <div class="modal fade" id="tambah-imunisasi-modal" tabindex="-1"
                 aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Imunisasi</h1>
                        </div>
                        <div class="modal-body">
                            <form id="tambah-imunisasi-form" enctype="multipart/form-data">
                                <div class="form-group">
                                    @auth
                                        <input type="hidden" name="id_user" class="d-none"
                                               value="{{ Auth::user()["id"] }}">
                                    @endauth
                                    <label>catatan imunisasi</label>
                                    <select name="id_catatan_imunisasi" id="catatanimunisasi" class="form-select mb-3">
                                        @foreach($catatan_imunisasi as $m)
                                        <option @if($m->catatan_imunisasi == 'polio') selected @endif value="polio">
                                            POLIO 1
                                        </option>
                                        <option @if($m->catatan_imunisasi == 'polio') selected @endif value="polio">
                                            POLIO 2
                                        </option>
                                        <option @if($m->catatan_imunisasi == 'polio') selected @endif value="polio">
                                            POLIO 3
                                        </option>
                                        @endforeach
                                    </select>
                                    <label>Tanggal Imunisasi</label>
                                    <input type="datetime-local" name="tanggal_imunisasi" id="tanggalimunisasi"
                                           class="form-control mb-3">
                                    <label>Deskripsi</label>
                                    <textarea name="ringkasan" class="form-control mb-3" rows="7"
                                              placeholder="Tulis ringkasan imunisasi disini..."
                                              style="resize: none"></textarea>
                                    <label class="d-block">File : </label>
                                    <div class="row d-flex align-items-center">
                                        <div class="col-3">
                                            <label for="fileUpload"
                                                   class="btn p-1 w-100 btn-outline-success form-control">Upload
                                                File</label>
                                                <input type="file" accept=".pdf, image/*, .txt, .doc, .docx" name="file" id="fileUpload" class="d-none">
                                        </div>
                                        <div class="col p-0">
                                            <p class="fileName m-0 d-inline-block"></p>
                                        </div>
                                    </div>
                                    @csrf
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" style="color: white" class="btn btn-secondary" onclick="clearText()"
                                    data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-gradient" form="tambah-imunisasi-form">Tambah</button>
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
                            <th>No</th>
                            <th>id catatan imunisasi</th>
                            <th>User</th>
                            <th>Tanggal imunisasi</th>
                            <th>Deskripsi</th>
                            <th>File</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $no = 1;
                        ?>
                        @foreach($catatan_imunisasi as $sc)
                            <tr idimunisasi="{{$m->id}}">
                                <td class="col-1">{{$no++}}</td>
                                <td class="col-1">{{$m->catatan->catatan_imunisasi}}</td>
                                <td class="col-1">{{$m->user->username}}</td>
                                <td class="col-2">{{$m->tanggal_imunisasi}}</td>
                                <td>{{$m->ringkasan}}</td>
                                <td class="col-1">
                                    @if($m->file)
                                        <a class="btn btn-gradient" style="color: white"
                                           href="{{url("dashboard/catatan_imunisasi?path=m->file", ['download'])}}">Download</a>
                                    @else
                                        <p>No File</p>
                                    @endif
                                </td>
                                <td class="col-2">
                                    <!-- Button trigger edit modal -->
                                    <button type="button" style="color: white" class=" btn btn-gradient" data-bs-toggle="modal"
                                            data-bs-target="#edit-modal-{{$m->id}}" idimunisasi="{{$m->id}}">
                                        Edit
                                    </button>
                                    <button class="hapusBtn btn btn-danger">Hapus</button>
                                </td>
                            </tr>
                            <!-- Edit Imunisasi Modal -->
                            <div class="modal fade" id="edit-modal-{{$m->id}}" tabindex="-1"
                                 aria-labelledby="exampleModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit imunisasi</h1>
                                        </div>
                                        <div class="modal-body">
                                            <form id="edit-imunisasi-form-{{$m->id}}" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    @auth
                                                        <input type="hidden" name="id_user" class="d-none"
                                                               value="{{ Auth::user()["id"] }}">
                                                    @endauth
                                                    <label>id catatan imunisasi</label>
                                                    <select name="id_catatan_imunisasi" id="catatanimunisasi"
                                                            class="form-select mb-3">
                                                        @foreach($catatan_imunisasi as $m)
                                                            <option value="{{$m->id}}"
                                                                    @if($m->id === $m->id_catatan_imunisasi) selected
                                                                @endif>{{$m->catatan_imunisasi}}</option>
                                                        @endforeach
                                                    </select>
                                                    <label>Tanggal imunisasi</label>
                                                    <input type="datetime-local" name="tanggal_imunisasi" id="tanggalimunisasi"
                                                           class="form-control mb-3"
                                                           value="{{$m->tanggal_imunisasi}}">
                                                    <label>Ringkasan</label>
                                                    <textarea name="ringkasan" class="form-control mb-3" rows="7"
                                                              placeholder="Tulis ringkasan imunisasi disini..."
                                                              style="resize: none">{{$m->ringkasan}}
                                                    </textarea>
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
                                                        <div class="col p-0">
                                                            <p class="fileName m-0 d-inline-block"></p>
                                                        </div>
                                                    </div>
                                                    @csrf
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" style="color: white" class="btn btn-secondary" onclick="clearText()"
                                                    data-bs-dismiss="modal">
                                                Cancel
                                            </button>
                                            <button type="submit" style="color: white" class="btn btn-gradient edit-btn"
                                                    form="edit-imunisasi-form-{{$m->id}}">
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
    <script>
        function clearText() {
            $(`.fileName`).text('');
            $('#fileUpload').val('');
        }
    </script>
    <script type="module">
        $('.table').DataTable();

        $('input[type=file]').on('change', function () {
            const fileName = $(this).val().replace(/.*(\/|\\)/, '');
            $(`.fileName`).text(fileName);
        })

        /*-------------------------- TAMBAH imunisasi -------------------------- */
        $('#tambah-imunisasi-form').on('submit', function (e) {
            e.preventDefault();
            let data = new FormData(e.target);
            console.log(Object.fromEntries(data))
            axios.post('/dashboard/catatan_imunisasi', data, {
                'Content-Type': 'multipart/form-data'
            })
                .then((res) => {
                    $('#tambah-imunisasi-modal').css('display', 'none')
                    swal.fire('Berhasil tambah data!', '', 'success').then(function () {
                        location.reload();
                    })
                })
                .catch((err) => {
                    swal.fire('Gagal tambah data!', '', 'warning');
                    console.log(err)
                });
        })

        /*-------------------------- EDIT imunisasi -------------------------- */
        $('.editBtn').on('click', function (e) {
            e.preventDefault();
            console.log('clicked');
            let id = $(this).attr('id_catatan_imunisasi');
            $(`#edit-imunisasi-form-${id}`).on('submit', function (e) {
                e.preventDefault();
                let data = new FormData(e.target);
                console.log(data);
                axios.post(`/dashboard/catatan_imunisasi/${id}/edit`, Object.fromEntries(data))
                    .then(() => {
                        $(`#edit-imunisasi-modal-${id}`).css('display', 'none')
                        swal.fire('Berhasil edit data!', '', 'success').then(function () {
                            location.reload();
                        })
                    })
                    .catch(() => {
                        swal.fire('Gagal tambah data!', '', 'warning');
                    })
            })
        })

        /*-------------------------- HAPUS USER -------------------------- */
        $('.table').on('click', '.hapusBtn', function () {
            let idimunisasi = $(this).closest('tr').attr('idimunisasi');
            swal.fire({
                title: "Apakah anda ingin menghapus data ini?",
                showCancelButton: true,
                confirmButtonText: 'Setuju',
                cancelButtonText: `Batal`,
                confirmButtonColor: 'red'
            }).then((result) => {
                if (result.isConfirmed) {
                    //dilakukan proses hapus
                    axios.delete(`/dashboard/catatan_imunisasi/${idimunisasi}`)
                        .then(function (response) {
                            console.log(response);
                            if (response.data.success) {
                                swal.fire('Berhasil di hapus!', '', 'success').then(function () {
                                    //Refresh Halaman
                                    location.reload();
                                });
                            } else {
                                swal.fire('Gagal di hapus!', '', 'warning');
                            }
                        }).catch(function (error) {
                        swal.fire('Data gagal di hapus!', '', 'error').then(function () {
                            //Refresh Halaman
                            location.reload();
                        });
                    });
                }
            });
        })
    </script>
@endsection
