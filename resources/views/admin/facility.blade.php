@extends('layouts.admin')
@section('content')
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-12 d-flex no-block align-items-center">
      <h4 class="page-title">Pengaturan fasilitas</h4>
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
          <h5 class="card-title">Data fasilitas</h5>
          <div class="table-responsive">
            <table id="myTable" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th style="width: 30px">No.</th>
                  <th>Nama</th>
                  <th>Foto</th>
                  <th style="width: 120px">Tanggal</th>
                  <th style="width: 80px">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($facilities as $f)
                @php
                  if($f->image){ $image=$f->image; }
                  else{ $image="default.png"; }
                @endphp
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$f->name}}</td>
                  <td>
                    <img class="rounded" src="/assets/images/facility/{{$image}}" style="width: 100px; aspect-ratio:16/9; object-fit: cover;">
                  </td>
                  @php
                    $date = date_create($f->created_at);
                  @endphp
                  <td>{{date_format($date,"d M Y")}}</td>
                  <td>
                    <button type="button" class="btn btn-info btn-icon" data-toggle="modal" data-target="#edit" onclick="edit({{$f->id}})"><i class="mdi mdi-pencil"></i></button>
                    <button type="button" class="btn btn-danger btn-icon" data-toggle="modal" data-target="#hapus" onclick="hapus({{$f->id}})"><i class="fa fa-times"></i></button>
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
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah fasilitas baru</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form class="form" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="row mb-2">
            <div class="col-12">
              <label class="required fw-bold mb-2">Nama fasilitas</label>
              <input type="text" class="form-control" id="name" name="name" required>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-12">
              <label class="required fw-bold mb-2">Foto fasilitas</label>
              <input type="file" class="form-control" name="image" required>
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

<div class="modal fade" id="edit" tabindex="-1" role="dialog"aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="et">Edit fasilitas</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form class="form" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" class="d-none" id="eid" name="id" required>
        <div class="modal-body">
          <div class="row mb-2">
            <div class="col-12">
              <label class="required fw-bold mb-2">Nama fasilitas</label>
              <input type="text" class="form-control" id="enm" name="name" required>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-12">
              <label class="required fw-bold mb-2">Foto fasilitas</label>
              <input type="file" class="form-control" name="image">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-secondary me-3" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-info" name="submit" value="update">Simpan</button>
        </div>
      </form>

    </div>
  </div>
</div>

<div class="modal fade" id="hapus" tabindex="-1" role="dialog"aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus fasilitas</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form class="form" method="post" action="">
        @csrf
        <input type="hidden" class="d-none" id="hi" name="id">
        <div class="modal-body">
          <p id="hd">Apakah anda yakin ingin menghapus fasilitas ini?</p>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-secondary me-3" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-danger" name="submit" value="destroy">Hapus</button>
        </div>
      </form>

    </div>
  </div>
</div>

@endsection

@section('script')
<script>
  $('#myTable').DataTable();
  
  function edit(id){
		$.ajax({
			url: "/api/facility/"+id,
			type: 'GET',
			dataType: 'json', // added data type
			success: function(response) {
        var mydata = response.data;
				$("#eid").val(id);
				$("#enm").val(mydata.name);
        $("#et").text("Edit "+mydata.name);
			}
		});
	}
	
  function hapus(id){
		$.ajax({
			url: "/api/facility/"+id,
			type: 'GET',
			dataType: 'json', // added data type
			success: function(response) {
        var mydata = response.data;
				$("#hi").val(id);
				$("#hd").text('Apakah anda yakin ingin menghapus "'+mydata.name+'"?');
			}
		});
	}
</script>
@endsection