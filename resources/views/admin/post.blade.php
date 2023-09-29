@extends('layouts.admin')
@section('content')
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-12 d-flex no-block align-items-center">
      <h4 class="page-title">Pengaturan postingan</h4>
      <div class="ml-auto text-right">
        <button class="btn btn-info" data-toggle="modal" data-target="#tambah">Tambah</button>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Data postingan</h5>
          <div class="table-responsive">
            <table id="myTable" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Judul postingan</th>
                  <th>Isi postingan</th>
                  <th>Foto</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($posts as $p)
                @php
                  if($p->image){ $image=$p->image; }
                  else{ $image="default.png"; }
                @endphp
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$p->title}}</td>
                  <td>{{substr($p->body,0,120)}}...</td>
                  <td>
                    <img class="rounded" src="/assets/images/post/{{$image}}" style="width: 100px; aspect-ratio:16/9; object-fit: cover; border: 2px solid white">
                  </td>
                  <td>
                    <button type="button" class="btn btn-info btn-sm rounded"><i class="mdi mdi-pencil"></i></button>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="tambah" tabindex="-1" role="dialog"aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah postingan baru</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form class="form" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="row mb-2">
            <div class="col-12 col-md-7">
              <label class="required fw-bold mb-2">Judul postingan</label>
              <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="col-12 col-md-5">
              <label class="required fw-bold mb-2">Foto postingan</label>
              <input type="file" class="form-control" name="image">
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-12">
              <label class="required fw-bold mb-2">URL/Permalink</label>
              <input type="text" class="form-control" id="slug" name="slug" readonly>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-12">
              <label class="required fw-bold mb-2">Isi postingan</label>
              <textarea class="form-control" id="body" name="body" rows="8" required></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-secondary me-3" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-info" name="submit" value="store">Submit</button>
        </div>
      </form>

    </div>
  </div>
</div>
@endsection

@section('script')
<script>
  $('#myTable').DataTable();
</script>
<script>
  $("#title").on('keyup', function () {
		var judul = $("#title").val();
		var link = judul.replace(/[^a-z0-9]+/gi, '-').replace(/^-*|-*$/g, '').toLowerCase();
		$("#slug").val(link);
	});
</script>
@endsection