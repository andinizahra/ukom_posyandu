@extends('layouts.app')
@section('title', 'Pencatatan Data Bayi')
@section('content')
    <div class="row">
        <div class="col d-flex justify-content-between mb-2">
            <a class="btn" style="background-color:#030A48; color: white" href="{{url('/dashboard')}}">
                Kembali</a>
            <button type="button" class="btn btn-success" style="background-color: #030A48;" data-bs-toggle="modal"
                    data-bs-target="#tambah-bayi-modal"> Tambah
            </button>
            <!-- Tambah bayi Modal -->
            <div class="modal fade" id="tambah-bayi-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah bayi</h1>
                        </div>
                        <div class="modal-body">
                            <form id="tambah-bayi-form" method="" action="">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input placeholder="Nama Lengkap" type="text" class="form-control mb-3" name="nama"
                                           required/>
                                    <label>Berat Badan</label>
                                    <input placeholder="Berat Badan Bayi" type="text" name="berat_badan" class="form-control mb-3"
                                           required>
                                    <label>Tinggi Badan</label>
                                    <input placeholder="Tinggi Badan Bayi" type="text" name="tinggi_badan" class="form-control mb-3"
                                                  required>
                                    <label>Golongan Darah</label>
                                    <select name="golongan_darah" class="form-select mb-3" required>
                                        <option selected value="A -/+">A -/+</option>
                                        <option selected value="B -/+">B -/+</option>
                                        <option selected value="O -/+">O -/+</option>
                                        <option selected value="AB -/+">AB -/+</option>
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
                            <button type="submit" class="btn btn-secondary" style="background-color:#030A48; color:white;" form="tambah-bayi-form">Tambah</button>
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
                            <th>Nama</th>
                            <th>Berat Badan</th>
                            <th>Tinggi Badan</th>
                            <th>Golongan Darah</th>
                            <th>File</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                            ?>
                        @foreach($bayi as $b)
                            <tr idBayi="{{$b->id}}">
                                <td class="col-1">{{$no++}}</td>
                                <td>{{$b->nama}}</td>
                                <td class="text-capitalize">{{$b->berat_badan}}</td>
                                <td class="text-capitalize">{{$b->tinggi_badan}}</td>
                                <td class="text-capitalize">{{$b->golongan_darah}}</td>
                                <td class="col-1">
                                    @if($b->file)
                                        <a class="btn btn-gradient" style="color: white"
                                           href="{{url("dashboard/bayi?path=$b->file", ['download'])}}">Download</a>
                                    @else
                                        <p>No File</p>
                                    @endif
                                </td>
                                <td class="col-2">
                                    <!-- Button trigger edit modal -->
                                    <button type="button" style="background-color:#030A48; color: white" class=" btn btn-gradient editBtn" data-bs-toggle="modal"
                                            data-bs-target="#edit-modal-{{$b->id}}" idBayi="{{$b->id}}">
                                        Edit
                                    </button>
                                    <button class="btn hapusBtn" style="background-color: #F80000; color:white;">Hapus</button>
                                </td>
                            </tr>
                            <!-- Edit bayi Modal -->
                            <div class="modal fade" id="edit-modal-{{$b->id}}" tabindex="-1"
                                 aria-labelledby="exampleModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5 editBtn" id="exampleModalLabel">Edit bayi</h1>
                                        </div>
                                        <div class="modal-body">
                                            <form id="edit-bayi-form-{{$b->id}}" action="">
                                                <div class="form-group">
                                                    <label>Nama</label>
                                                    <input placeholder="Nama Anak" type="text" class="form-control mb-3"
                                                           name="nama"
                                                           value="{{$b->nama}}"
                                                           required/>
                                                    <label>Berat Badan</label>
                                                    <input placeholder="Berat Badan Anak" type="text" class="form-control mb-3"
                                                                  name="berat_badan"
                                                                  value="{{$b->berat_badan}}"
                                                                  required/>
                                                    <label>Tinggi Badan</label>
                                                    <input placeholder="Tinggi Badan Anak" type="text" class="form-control mb-3"
                                                           name="tinggi_badan"
                                                           value="{{$b->tinggi_badan}}"
                                                           required/>
                                                    <label>Golongan Darah</label>
                                                    <select name="golongan_darah" class="form-select mb-3" required>
                                                        <option @if($b->gd == 'A -/+') selected @endif value="A -/+">
                                                            A -/+
                                                        </option>
                                                        <option @if($b->gd == 'B -/+') selected @endif value="B -/+">
                                                            B -/+
                                                        </option>
                                                        <option @if($b->gd == 'O -/+') selected @endif value="O -/+">
                                                            O -/+
                                                        </option>
                                                        <option @if($b->gd == 'AB -/+') selected @endif value="AB -/+">
                                                            AB -/+
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
                                                    form="edit-bayi-form-{{$b->id
                                                     }}">
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
        $('.table').DataTable();
        $('#tambah-bayi-form').on('submit', function (e) {
            e.preventDefault();
            let data = new FormData(this);
            console.log(Object.fromEntries(data));

            axios.post('/dashboard/bayi/tambah', Object.fromEntries(data))
                .then(() => {
                    $('#tambah-bayi-modal').css('display', 'none')
                    swal.fire('Berhasil tambah data!', '', 'success').then(function () {
                        location.reload();
                    })
                })
                .catch((err) => {
                    console.log(err.response);
                    swal.fire('Gagal tambah data!', '', 'warning');
                });
        })

    
        $('.editBtn').on('click', function (e) {
            e.preventDefault();
            console.log('clicked');
            let idBayi = $(this).attr('idBayi');
            $(`#edit-bayi-form-${idBayi}`).on('submit', function (e) {
                e.preventDefault();
                let data = new FormData(e.target);
                console.log(data);
                axios.post(`/dashboard/bayi/${idBayi}/edit`, Object.fromEntries(data))
                    .then(() => {
                        $(`#edit-bayi-modal-${idBayi}`).css('display', 'none')
                        swal.fire('Berhasil edit data-!', '', 'success').then(function () {
                            location.reload();
                        })
                    })
                    .catch((res) => {
                        console.log(res);
                        swal.fire('Gagal tambah data!', '', 'warning');
                    })
            })
        })




        $('.table').on('click', '.hapusBtn', function () {
            let idBayi = $(this).closest('tr').attr('idBayi');
            swal.fire({
                title: "Yakin ingin menghapus?",
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: `Batal`,
                confirmButtonColor: 'red'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(`/dashboard/bayi/${idBayi}/delete`)
                    .then(function (response) {
                        console.log(response);
                        if (response.data.success) {
                            swal.fire('Berhasil terhapus!', '', 'success').then(function () {
                                location.reload();
                            });
                        } else {
                            // swal.fire('Gagal di hapus!', '', 'warning').then(function () {
                            //     location.reload();
                            // });
                        }
                    }).catch(function (error) {
                        console.log(error);
                        swal.fire('Data anda gagal di hapus!', '', 'error').then(function () {
                            location.reload();
                        });
                    });
                }
            });
        })
    </script>
@endsection
