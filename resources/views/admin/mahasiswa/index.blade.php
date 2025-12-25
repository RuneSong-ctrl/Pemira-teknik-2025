@extends('/admin/layouts/master',['title'=>'Mahasiswa'])

@section('content')
<div ui-view class="app-body" id="view">
  <div class="padding">
    <div class="box">
      <div class="box-header">
        <small>List Mahasiswa</small>
      </div>
      <div class="p-3 ">
        <table id="example" class="table table-striped table-bordered dt-responsive nowrap">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Nim</th>
              <th>Program Studi</th>
              <th>File</th>
              <th>Status</th>
              <th>Registered At</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody class="hasil">
            </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="verif" tabindex="-1" role="dialog" aria-hidden="true" style="z-index: 1055;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Konfirmasi Verifikasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah yakin ingin memverifikasi mahasiswa ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="btnConfirmVerif" class="btn btn-danger">Confirm</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-hidden="true" style="z-index: 1055;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Konfirmasi Hapus</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah yakin ingin menghapus data ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="btnConfirmDelete" class="btn btn-danger">Confirm</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="alert" tabindex="-1" role="dialog" aria-hidden="true" style="z-index: 1060;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center text-success">
        <h5><i class="fa fa-check"></i> Berhasil!</h5>
        <p>Data berhasil diproses.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('footer')
<script>
  $(document).ready(function() {

    $('#verif').appendTo("body");
    $('#delete').appendTo("body");
    $('#alert').appendTo("body");
    // ---------------------------------------------

    // Setup CSRF Token Laravel
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    loaddata();

    // 1. Tombol Buka Modal Verifikasi
    $(document).on('click', '.btn-open-verif', function() {
        var id = $(this).attr('data-id');
        console.log("Membuka Verif ID: " + id);
        $('#btnConfirmVerif').data('id', id); // Simpan ID
        $('#verif').modal('show');
    });

    // 2. Tombol Buka Modal Hapus
    $(document).on('click', '.btn-open-delete', function() {
        var id = $(this).attr('data-id');
        console.log("Membuka Delete ID: " + id);
        $('#btnConfirmDelete').data('id', id); // Simpan ID
        $('#delete').modal('show');
    });

    // 3. Eksekusi Confirm Verifikasi
    $(document).on("click", '#btnConfirmVerif', function(e) {
        e.preventDefault();
        var dataId = $(this).data('id');
        var $btn = $(this);

        if(!dataId) return alert("Error: ID Kosong");

        $btn.prop('disabled', true).text('Processing...');

        $.ajax({
            url: '/admin/mahasiswa/verif/' + dataId,
            type: 'put',
            success: function(response) {
                $('#verif').modal('hide');
                loaddata();
                $btn.prop('disabled', false).text('Confirm');
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                alert('Gagal Verifikasi');
                $btn.prop('disabled', false).text('Confirm');
            }
        });
    });

    // 4. Eksekusi Confirm Hapus
    $(document).on("click", '#btnConfirmDelete', function(e) {
        e.preventDefault();
        var dataId = $(this).data('id');
        var $btn = $(this);

        if(!dataId) return alert("Error: ID Kosong");

        $btn.prop('disabled', true).text('Deleting...');

        $.ajax({
            url: '/admin/mahasiswa/delete/' + dataId,
            type: 'delete',
            success: function(response) {
                $('#delete').modal('hide');
                $('#alert').modal('show'); // Munculkan notif sukses
                loaddata();
                $btn.prop('disabled', false).text('Confirm');
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                alert('Gagal Menghapus');
                $btn.prop('disabled', false).text('Confirm');
            }
        });
    });

    // Fungsi Load Data
    function loaddata() {
      $.ajax({
        url: '/admin/mahasiswa/data',
        type: 'get',
        dataType: 'html',
        success: function(data) {
          if ($.fn.DataTable.isDataTable('#example')) {
             $('#example').DataTable().destroy();
          }
          $('.hasil').html(data);
          $('#example').DataTable({
            "bStateSave": true,
            "fnStateSave": function (oSettings, oData) {
               localStorage.setItem('example', JSON.stringify(oData));
            },
            "fnStateLoad": function (oSettings, oData) {
               return JSON.parse(localStorage.getItem('example'));
            }
          });
        },
        error: function(data) {
          console.log("Error load table");
        }
      });
    };

  });
</script>
@endsection