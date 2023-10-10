@extends('layouts.admin')

@section('content')
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-12 d-flex no-block align-items-center">
      <h4 class="page-title">Dashboard</h4>
    </div>
  </div>
</div>
<div class="container-fluid">
  <!-- ============================================================== -->
  <!-- Sales Cards  -->
  <!-- ============================================================== -->
  <div class="row">

    <!-- Column -->
    <div class="col-12 col-md-3">
      <div class="card card-hover">
        <div class="box bg-dark d-flex">
          <div class="col-3 d-flex">
            <h1 class="font-light text-white m-0 d-flex"><i class="fas fa-building m-auto" style="font-size: 50px;"></i></h1>
          </div>
          <div class="col-9">
            <p class="text-light mt-2 mb-0">Fasilitas</p>
            <h2 class="text-white">{{count($facilities)}}</h2>
          </div>
        </div>
      </div>
    </div>

    <!-- Column -->
    <div class="col-12 col-md-3">
      <div class="card card-hover">
        <div class="box bg-dark d-flex">
          <div class="col-3">
            <h1 class="font-light text-white m-0"><i class="fas fa-image" style="font-size: 60px"></i></h1>
          </div>
          <div class="col-9">
            <p class="text-light mt-2 mb-0">Galeri</p>
            <h2 class="text-white">{{count($galleries)}}</h2>
          </div>
        </div>
      </div>
    </div>

    <!-- Column -->
    <div class="col-12 col-md-3">
      <div class="card card-hover">
        <div class="box bg-dark d-flex">
          <div class="col-3">
            <h1 class="font-light text-white m-0"><i class="mdi mdi-palette" style="font-size: 60px;"></i></h1>
          </div>
          <div class="col-9">
            <p class="text-light mt-2 mb-0">Karya</p>
            <h2 class="text-white">{{count($crafts)}}</h2>
          </div>
        </div>
      </div>
    </div>

    <!-- Column -->
    <div class="col-12 col-md-3">
      <div class="card card-hover">
        <div class="box bg-dark d-flex">
          <div class="col-3 d-flex">
            <h1 class="font-light text-white m-0 d-flex"><i class="fas fa-pencil-alt m-auto" style="font-size: 50px;"></i></h1>
          </div>
          <div class="col-9">
            <p class="text-light mt-2 mb-0">Postingan</p>
            <h2 class="text-white">{{count($posts)}}</h2>
          </div>
        </div>
      </div>
    </div>

    <!-- Column -->
    <div class="col-12 col-md-3">
      <div class="card card-hover">
        <div class="box bg-dark d-flex">
          <div class="col-3">
            <h1 class="font-light text-white m-0"><i class="mdi mdi-book-plus" style="font-size: 60px;"></i></h1>
          </div>
          <div class="col-9">
            <p class="text-light mt-2 mb-0">Program</p>
            <h2 class="text-white">{{count($programs)}}</h2>
          </div>
        </div>
      </div>
    </div>

    <!-- Column -->
    <div class="col-12 col-md-3">
      <div class="card card-hover">
        <div class="box bg-dark d-flex">
          <div class="col-3">
            <h1 class="font-light text-white m-0"><i class="mdi mdi-school" style="font-size: 60px;"></i></h1>
          </div>
          <div class="col-9">
            <p class="text-light mt-2 mb-0">Tenaga Pengajar</p>
            <h2 class="text-white">{{count($instructors)}}</h2>
          </div>
        </div>
      </div>
    </div>

    <!-- Column -->
    <div class="col-12 col-md-3">
      <div class="card card-hover">
        <div class="box bg-dark d-flex">
          <div class="col-3">
            <h1 class="font-light text-white m-0"><i class="mdi mdi-account-group" style="font-size: 60px;"></i></h1>
          </div>
          <div class="col-9">
            <p class="text-light mt-2 mb-0">Struktur Organisasi</p>
            <h2 class="text-white">{{count($organizations)}}</h2>
          </div>
        </div>
      </div>
    </div>

    
  </div>

</div>
@endsection