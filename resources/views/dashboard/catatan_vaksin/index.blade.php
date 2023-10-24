@extends('layouts.app')
@section('title', 'Catatan Vaksin')
@section('content')
    <div class="row">
        <div class="col d-flex justify-content-between mb-2">
            <a class="btn btn-gradient" style="background-color:#030A48; color: white" href="{{url('/dashboard')}}">
                Kembali</a>
            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                    data-bs-target="#tambah-vaksin-modal"> Tambah
            </button>
         <!-- Tambah -->
            <div class="modal fade" id="tambah-vaksin-modal" tabindex="-1"
                 aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Vaksin</h1>
                        </div>
                        <div class="modal-body">
                            <form id="tambah-vaksin-form">
                                <div class="form-group">
                                    <label>Jenis Vaksin</label>
                                    @foreach($catatan_vaksin as $vs)
                                    <option @if($vs->catatan_vaksin == 'polio') selected @endif value="polio">
                                        POLIO 1
                                    </option>
                                    <option @if($vs->catatan_vaksin == 'polio') selected @endif value="polio">
                                        POLIO 2
                                    </option>
                                    <option @if($vs->catatan_vaksin == 'polio') selected @endif value="polio">
                                        POLIO 3
                                    </option>
                                    @endforeach
                                    @csrf
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-gradient" form="tambah-vaksin-form">Tambah</button>
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
                            <th>Jenis Vaksin</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1;
                            ?>
                        @foreach($catatan_vaksin as $vs)
                            <tr idVaksin="{{$vs->id}}">
                                <td class="col-1">{{$no++}}</td>
                                <td>{{$vs->vaksin}}</td>
                                <td class="col-2">
                                    <!-- Button trigger edit modal -->
                                    <button type="button" class="editBtn btn btn-gradient" style="color: white" data-bs-toggle="modal"
                                            data-bs-target="#edit-modal-{{$vs->id}}" idVaksin="{{$vs->id}}">
                                        Edit
                                    </button>
                                    <button class="hapusBtn btn btn-danger">Hapus</button>
                                </td>
                            </tr>
                            <!-- Edit Jenis Vaksin Modal -->
                            <div class="modal fade" id="edit-modal-{{$vs->id}}" tabindex="-1"
                                 aria-labelledby="exampleModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Jenis Vaksin</h1>
                                        </div>
                                        <div class="modal-body">
                                            <form id="edit-vs-form-{{$vs->id}}">
                                                <div class="form-group">
                                                    <label>Jenis Vaksin</label>
                                                    <input placeholder="example" type="text" class="form-control mb-3"
                                                           name="vaksin"
                                                           value="{{$vs->vaksin}}"
                                                           required/>
                                                    @csrf
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" style="color: white" data-bs-dismiss="modal">
                                                Cancel
                                            </button>
                                            <button type="submit" style="color: white" class="btn btn-gradient edit-btn"
                                                    form="edit-vs-form-{{$vs->id}}">
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
        /*-------------------------- TAMBAH USER -------------------------- */
        $(`#tambah-vaksin-form`).on('submit', function (e) {
            e.preventDefault();
            let data = new FormData(e.target);
            axios.post('/catatan_vaksin/tambah', Object.fromEntries(data))
                .then(() => {
                    $(`#tambah-vaksin-modal`).css('display', 'none')
                    swal.fire('Berhasil tambah data!', '', 'success').then(function () {
                        location.reload();
                    }) 
                })
                .catch(() => {
                    swal.fire('Gagal tambah data!', '', 'warning');
                });
        })

        /*-------------------------- EDIT USER -------------------------- */
        $('.editBtn').on('click', function (e) {
            e.preventDefault();
            let idVaksin = $(this).attr('idVaksin');
            $(`#edit-vaksin-form-${idVaksin}`).on('submit', function (e) {
                e.preventDefault();
                let data = Object.fromEntries(new FormData(e.target));
                data['id'] = idVaksin;
                axios.post(`/dashboard/catatan_vaksin/edit`, data)
                    .then(() => {
                        $(`#edit-modal-${idVaksin}`).css('display', 'none')
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
            let idVaksin = $(this).closest('tr').attr('idVaksin');
            swal.fire({
                title: "Apakah anda ingin menghapus data ini?",
                showCancelButton: true,
                confirmButtonText: 'Setuju',
                cancelButtonText: `Batal`,
                confirmButtonColor: 'red'
            }).then((result) => {
                if (result.isConfirmed) {
                    //dilakukan proses hapus
                    axios.delete(`/dashboard/catatan_vaksin/delete`)
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
