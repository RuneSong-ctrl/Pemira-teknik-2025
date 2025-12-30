<div class="app-header white box-shadow-z1 border-bottom">
    <div class="navbar navbar-toggleable-sm flex-row align-items-center px-4 py-2">
        
        <a data-toggle="modal" data-target="#aside" class="hidden-lg-up mr-3 text-muted btn btn-icon">
            <i class="material-icons">&#xe5d2;</i>
        </a>

        <div class="d-flex flex-column">
            <h5 class="mb-0 text-dark font-weight-bold" id="pageTitle" ng-bind="$state.current.data.title">
                {{ $title ?? 'Dashboard' }}
            </h5>
            <small class="text-muted hidden-xs-down" style="font-size: 0.8rem;">Administrator Panel</small>
        </div>

        <ul class="nav navbar-nav ml-auto flex-row align-items-center">
            <li class="nav-item">
                <a href="/logout" class="btn-logout-custom d-flex align-items-center" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="material-icons mr-2 text-danger" style="font-size: 1.2rem;">power_settings_new</i>
                    <span class="font-weight-600">Logout</span>
                </a>
                <form id="logout-form" action="/logout" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>

    </div>
</div>

<style>
    .app-header {
        height: 70px;
        display: flex;
        align-items: center;
        z-index: 1020; 
    }

    .btn-logout-custom {
        background-color: #fff;
        border: 1px solid #e1e4e8;
        padding: 8px 20px;
        border-radius: 50px;
        color: #444;
        transition: all 0.3s ease;
        text-decoration: none !important;
        box-shadow: 0 2px 5px rgba(0,0,0,0.02);
    }

    .btn-logout-custom:hover {
        background-color: #ffeaea;
        border-color: #ffcccc;
        color: #dc3545;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(220, 53, 69, 0.1);
    }
    
    .font-weight-600 {
        font-weight: 600;
    }
</style>

@extends('/admin/layouts/master',['title'=>'Calon'])
@section('content')
<div ui-view class="app-body" id="view">
  <div class="padding">
    <div class="box">
      <div class="box-header">
        <h4 style="position: relative;top:10px">List Calon</h4>
      </div>

      <hr>

      <div class="p-3">
        <a href="/admin/calon/create" class="btn btn-success">Create</a>

        <table id="calon" class="table table-striped table-bordered dt-responsive nowrap">
          <thead>
            <tr>
              <th>Nama Panggilan</th>
              <th>Jenis calon</th>
              <th>Visi</th>
              <th>Misi</th>
              <th>Photo</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($calon as $item)
            <tr>
              <td>{{$item->nama_panggilan}}</td>
              <td>{{$item->jenis_calon}}</td>
              <td>{!!substr($item->visi, 0, 100) . '...'!!}</td>
              <td>{!!substr($item->misi, 0, 100) . '...'!!}</td>
              <td><img src="{{$item->takeimage}}" alt="avatar" style="width: 100px"></td>
              <td><a class="btn btn-primary" href="/admin/calon/edit/{{$item->id}}">Edit</a> | <a href="#myModal"
                  class="trash btn btn-danger" data-id="{{$item->id}}" data-nama="{{$item->nama_panggilan}}"
                  role="button" data-toggle="modal">Hapus</a></td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>
    </div>
  </div>
</div>

<div class="modal small fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 id="myModalLabel">Delete Confirmation</h3>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
        <p class="error-text">
          <i class="fa fa-warning modal-icon"></i>
          apakah anda yakin ingin menghapus item ini?
        </p>
      </div>
      <div class="modal-footer">
        <form id="modalDelete" action="#" method="post">
          @method('delete')
          @csrf
          <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancel</button>
          <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('footer')
<script>
  $(document).ready(function() {
    $('#myModal').appendTo("body");

    $('#calon').DataTable({
      order : false,
    });

    $("#calon").on('click','.trash', function () { 
      var id = $(this).data('id');
      var nama = $(this).data('nama');
      var title = document.getElementById("myModalLabel");
      title.innerHTML = "Data : "+ nama;
      
      $('#modalDelete').attr('action', '/admin/calon/delete/' + id);
    });
  });
</script>
@endsection