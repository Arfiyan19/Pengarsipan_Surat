@extends('layouts.layout')
@section('title', 'Surat')
@section('content')
{{-- card --}}
<div class="col-lg-12">
    <div class="card mb-4">
        <div class="col-lg-2">
            <br>
            <button id="createNewData" class="dt-button create-new btn btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button">
                <span><svg xmlns="http://www.w3.org/2000/svg" width="8" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus mr-50 font-small-4">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Arsipkan Surat</span>
            </button>
        </div>
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold">Arsip Surat</h6>
            <p class="m-0 font-weight-bold">Klik Lihat Untuk Menampilkan Surat</p>
        </div>
        <div class="card-body">
            <table class="data-table table table-sm table-bordered table-striped" id="data-table">
                <thead>
                    <tr>
                        <th>NomorSurat</th>
                        <th>Kategori</th>
                        <th>Judul</th>
                        <th>WaktuArsip</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>
{{-- end card --}}


<!-- Modal -->
<div class="modal fade text-left" id="modalBox" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalHeading">Tambah Data @yield('title')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="dataForm" name="dataForm" class="dataForm form-horizontal" enctype="multipart/form-data">
                    <!-- validator -->
                    <ul class="list-group" id="errors-validate">
                    </ul>
                    <!-- end -->

                    <input type="hidden" name="data_id" id="data_id">
                    <div class="form-group">
                        <label class="form-label" for="basic-icon-default-fullname">Nomor Surat</label>
                        <input type="text" class="form-control dt-full-name required" id="NomorSurat" name="NomorSurat" required="">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="basic-icon-default-post">Kategori</label>
                        <select name="Kategori" id="Kategori" class="form-control dt-post required">
                            <option selected disabled>Pilih</option>
                            <option value="Undangan">Undangan</option>
                            <option value="Pengumuman">Pengumuman</option>
                            <option value="Nota Dinas">Nota Dinas</option>
                            <option value="Pemberitahuan">Pemberitahuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="basic-icon-default-post">Judul</label>
                        <input type="text" id="Judul" class="form-control dt-post required" name="Judul">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="basic-icon-default-post">Waktu Pengarsipan</label>
                        <input type="datetime-local" id="waktu_arsip" class="form-control dt-post required" name="waktu_arsip">
                    </div>

                    <div class="form-group">
                        <label for="File">FIle (PDF)</label>
                        <br>
                        <input name="File" id="File" type="file" class="form-control dt-post required">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cencel</button>
                        <button type="submit" id="saveBtn" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->
@endsection

@push('scripts')
<script src="{{ asset('app-assests/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('app-assests/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('app-assests/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('app-assests/vendors/js/tables/datatable/responsive.bootstrap4.js') }}"></script>
<script src="{{ asset('app-assests/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('app-assests/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
<script>
    // start

    $(document).ready(function($) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // show foto on table
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('surat.index') }}",
            columns: [{
                    data: 'NomorSurat',
                    name: 'NomorSurat'
                },
                {
                    data: 'Kategori',
                    name: 'Kategori'
                },
                {
                    data: 'Judul',
                    name: 'Judul'
                },
                {
                    data: 'waktu_arsip',
                    name: 'waktu_arsip'
                },
                // {
                //     data: 'foto',
                //     name: 'foto',
                //     render: function(data, type, row) {
                //         return '<img src="{{ asset('
                //         storage / ') }}/' + data + '" width="50" height="50">';
                //     }
                // },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        // show modal
        $('#createNewData').click(function() {
            $('#saveBtn').val("create-Surat");
            $('#data_id').val('');
            $('#dataForm').trigger("reset");
            $('#modalHeading').html("Tambah Data");
            $('#modalBox').modal('show');
            $("#errors-validate").hide();
            $('#saveBtn').prop('disabled', false);
        });

        $('#foto').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });

        // store process
        $('#dataForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: "{{route('surat.store')}}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status == 'sukses') {
                        $('#modalBox').modal('hide');
                        Swal.fire("Selamat", data.message, "success");
                        $('#dataForm').trigger("reset");
                        table.draw();
                    } else {
                        $('#message-error').html(data.message).show()
                    }
                },
                error: function(data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save');
                }
            });
        });

        $('body').on('click', '.unduhData', function() {
            var data_id = $(this).data('id');
            $.ajax({
                type: "GET",
                url: "/unduh/" + data_id,
                data: {
                    data_id: data_id
                },
                xhrFields: {
                    responseTyepe: 'blob'
                },
                success: function(data) {
                    var a = document.createElement('a');
                    var url = window.URL.createObjectURL(data);
                    a.href = url;
                    a.download = data_id;
                    a.click();
                    window.URL.revokeObjectURL(url);
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        });

        $('body').on('click', '.editData', function() {
            var data_id = $(this).data('id');
            $.get($(location).attr('href') + '/' + data_id + '/edit', function(data) {
                $('#saveBtn').html("Update");
                $('#modalHeading').html("Edit Data");
                $('#modalBox').modal('show');
                $("#errors-validate").hide();
                $('#saveBtn').prop('disabled', false);
                // get data respone
                $('#data_id').val(data.id);
                $('#NomorSurat').val(data.NomorSurat);
                $('#Kategori').val(data.Kategori);
                $('#Judul').val(data.Judul);
                $('#File').val(data.File);
            })
        });
        // end
        // delete
        $('body').on('click', '.deleteData', function() {
            var data_id = $(this).data("id");
            Swal.fire({
                title: "Apa kamu yakin?",
                text: "Menghapus data ini!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!',
                dangerMode: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Terhapus!',
                        'Data berhasil dihapus.',
                        'success'
                    )
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('surat.store') }}" + '/' + data_id,
                        success: function(data) {
                            table.draw();
                        },
                        error: function(data) {
                            console.log('Error:', data);
                        }
                    });
                }
            })
        });
        // end delete
    });
</script>
@endpush