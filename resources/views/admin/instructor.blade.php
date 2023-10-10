@extends('layouts.admin')
@section('content')
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-12 d-flex no-block align-items-center">
      <h4 class="page-title">Pengaturan tenaga pengajar</h4>
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
          <h5 class="card-title">Data tenaga pengajar</h5>
          <div class="table-responsive">
            <table id="myTable" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th style="width: 30px">No.</th>
                  <th>Nama</th>
                  <th>Jabatan</th>
                  <th>Jenis kelamin</th>
                  <th style="width: 120px">Tanggal diupdate</th>
                  <th style="width: 80px">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($instructors as $i)
                @php
                  $date = date_create($i->updated_at);
                  if($i->gender=="M"){$gender = "Laki-laki";}
                  elseif($i->gender=="F"){$gender = "Perempuan";}
                  else{$gender = "-";}
                @endphp
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$i->name}}</td>
                  <td>
                    <span class="badge badge-primary" style="font-size: 12px;">{{$i->position}}</span>
                  </td>
                  <td>
                    <span class="badge badge-success" style="font-size: 12px;">{{$gender}}</span>
                  </td>
                  <td>{{date_format($date,"d/m/Y H:i")}}</td>
                  <td>
                    <button type="button" class="btn btn-info btn-icon" data-toggle="modal" data-target="#edit" onclick="edit({{$i->id}})"><i class="mdi mdi-pencil"></i></button>
                    <button type="button" class="btn btn-danger btn-icon" data-toggle="modal" data-target="#hapus" onclick="hapus({{$i->id}})"><i class="fa fa-times"></i></button>
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
        <h5 class="modal-title">Tambah tenaga pengajar</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form class="form" method="post">
        @csrf
        <div class="modal-body">
          <div class="row mb-2">
            <div class="col-12 col-md-8">
              <label class="required fw-bold mb-2">Nama</label>
              <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="col-12 col-md-4">
              <label class="required fw-bold mb-2">Jenis kelamin</label>
              <select class="form-control" id="gender" name="gender" required>
                <option value="M">Laki-laki</option>
                <option value="F">Perempuan</option>
              </select>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-9">
              <label class="required fw-bold mb-2">Jabatan</label>
              <input type="text" class="form-control" id="position" name="position" required>
            </div>
            <div class="col-3">
              <label class="required fw-bold mb-2">Level</label>
              <input type="number" class="form-control" id="level" name="level" required>
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
        <h5 class="modal-title" id="et">Edit tenaga pendidik</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form class="form" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" class="d-none" id="eid" name="id" required>
        <div class="modal-body">
          <div class="row mb-2">
            <div class="col-12 col-md-8">
              <label class="required fw-bold mb-2">Nama</label>
              <input type="text" class="form-control" id="enm" name="name" required>
            </div>
            <div class="col-12 col-md-4">
              <label class="required fw-bold mb-2">Jenis kelamin</label>
              <select class="form-control" id="egn" name="gender" required>
                <option value="M">Laki-laki</option>
                <option value="F">Perempuan</option>
              </select>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-9">
              <label class="required fw-bold mb-2">Jabatan</label>
              <input type="text" class="form-control" id="eps" name="position" required>
            </div>
            <div class="col-3">
              <label class="required fw-bold mb-2">Level</label>
              <input type="number" class="form-control" id="elv" name="level" required>
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
        <h5 class="modal-title">Hapus tenaga pendidik</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form class="form" method="post" action="">
        @csrf
        <input type="hidden" class="d-none" id="hi" name="id">
        <div class="modal-body">
          <p id="hd">Apakah anda yakin ingin menghapus staff ini?</p>
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
			url: "/api/instructor/"+id,
			type: 'GET',
			dataType: 'json', // added data type
			success: function(response) {
        var mydata = response.data;
				$("#eid").val(id);
				$("#enm").val(mydata.name);
				$("#egn").val(mydata.gender);
				$("#eps").val(mydata.position);
				$("#elv").val(mydata.level);
        $("#et").text("Edit "+mydata.name);
			}
		});
	}
	
  function hapus(id){
		$.ajax({
			url: "/api/instructor/"+id,
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