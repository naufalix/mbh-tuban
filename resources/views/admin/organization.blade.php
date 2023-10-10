@extends('layouts.admin')
@section('content')
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-12 d-flex no-block align-items-center">
      <h4 class="page-title">Struktur Organisasi</h4>
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
          <h5 class="card-title">Data struktur organisasi</h5>
          <div class="table-responsive">
            <table id="myTable" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th style="width: 30px">No.</th>
                  <th>Nama</th>
                  <th>Ketua</th>
                  <th>Wakil ketua</th>
                  <th>Sekertaris</th>
                  <th>Bendahara</th>
                  <th style="width: 120px">Tanggal diupdate</th>
                  <th style="width: 80px">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($organizations as $o)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$o->name}}</td>
                  <td>{{$o->chairman}}</td>
                  <td>{{$o->vice_chairman}}</td>
                  <td>{{$o->secretary}}</td>
                  <td>{{$o->treasurer}}</td>
                  @php
                    $date = date_create($o->updated_at);
                  @endphp
                  <td>{{date_format($date,"d/m/Y H:i")}}</td>
                  <td>
                    <button type="button" class="btn btn-info btn-icon" data-toggle="modal" data-target="#edit" onclick="edit({{$o->id}})"><i class="mdi mdi-pencil"></i></button>
                    <button type="button" class="btn btn-danger btn-icon" data-toggle="modal" data-target="#hapus" onclick="hapus({{$o->id}})"><i class="fa fa-times"></i></button>
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
        <h5 class="modal-title">Tambah struktur organisasi</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form class="form" method="post">
        @csrf
        <div class="modal-body">
          <div class="row mb-2">
            <div class="col-12">
              <label class="required fw-bold mb-2">Nama</label>
              <input type="text" class="form-control" id="name" name="name" required>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-12 col-md-6">
              <label class="required fw-bold mb-2">Ketua</label>
              <input type="text" class="form-control" id="chairman" name="chairman" required>
            </div>
            <div class="col-12 col-md-6">
              <label class="required fw-bold mb-2">Wakil ketua</label>
              <input type="text" class="form-control" id="vice_chairman" name="vice_chairman" required>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-12 col-md-6">
              <label class="required fw-bold mb-2">Sekertaris</label>
              <input type="text" class="form-control" id="secretary" name="secretary" required>
            </div>
            <div class="col-12 col-md-6">
              <label class="required fw-bold mb-2">Bendahara</label>
              <input type="text" class="form-control" id="treasurer" name="treasurer" required>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-12">
              <label class="required fw-bold mb-2">Anggota</label>
              <textarea class="form-control" id="member" name="member" rows="8" required></textarea>
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
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="et">Edit struktur organisasi</h5>
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
              <label class="required fw-bold mb-2">Nama</label>
              <input type="text" class="form-control" id="enm" name="name" required>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-12 col-md-6">
              <label class="required fw-bold mb-2">Ketua</label>
              <input type="text" class="form-control" id="ech" name="chairman" required>
            </div>
            <div class="col-12 col-md-6">
              <label class="required fw-bold mb-2">Wakil ketua</label>
              <input type="text" class="form-control" id="evc" name="vice_chairman" required>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-12 col-md-6">
              <label class="required fw-bold mb-2">Sekertaris</label>
              <input type="text" class="form-control" id="esc" name="secretary" required>
            </div>
            <div class="col-12 col-md-6">
              <label class="required fw-bold mb-2">Bendahara</label>
              <input type="text" class="form-control" id="etr" name="treasurer" required>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-12">
              <label class="required fw-bold mb-2">Anggota</label>
              <textarea class="form-control" id="emm" name="member" rows="8" required></textarea>
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
        <h5 class="modal-title">Hapus struktur organisasi</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form class="form" method="post" action="">
        @csrf
        <input type="hidden" class="d-none" id="hi" name="id">
        <div class="modal-body">
          <p id="hd">Apakah anda yakin ingin menghapus struktur organisasi ini?</p>
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
			url: "/api/organization/"+id,
			type: 'GET',
			dataType: 'json', // added data type
			success: function(response) {
        var mydata = response.data;
				$("#eid").val(id);
				$("#enm").val(mydata.name);
				$("#ech").val(mydata.chairman);
				$("#evc").val(mydata.vice_chairman);
				$("#esc").val(mydata.secretary);
				$("#etr").val(mydata.treasurer);
				$("#emm").val(mydata.member);
        $("#et").text("Edit "+mydata.name);
			}
		});
	}
	
  function hapus(id){
		$.ajax({
			url: "/api/organization/"+id,
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