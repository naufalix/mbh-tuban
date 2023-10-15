@extends('layouts.index')

@section('content')

  <!-- ======= Blog Details Section ======= -->
  <section id="blog" class="blog">
    <div class="container" data-aos="fade-up">

      @foreach ($organizations as $o)
      <article class="blog-details mb-3">
        <h2 class="title mb-3 text-center">{{$o->name}}</h2>
        
        <div class="row">
          <div class="col-12 col-md-6 mb-3">
            <div class="card">
              <div class="card-body text-center">
                <p>Ketua :</p>
                <h3>{{$o->chairman}}</h3>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6 mb-3">
            <div class="card">
              <div class="card-body text-center">
                <p>Wakil Ketua :</p>
                <h3>{{$o->vice_chairman}}</h3>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6 mb-3">
            <div class="card">
              <div class="card-body text-center">
                <p>Sekertaris :</p>
                <h3>{{$o->secretary}}</h3>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6 mb-3">
            <div class="card">
              <div class="card-body text-center">
                <p>Bendahara :</p>
                <h3>{{$o->treasurer}}</h3>
              </div>
            </div>
          </div>
        </div>

        <style>
          .anggota li::marker{font-size: 22px;margin-top: 30px;font-weight: bold;}
          /* .anggota li{width: 400px}
          .anggota ol{display: flex} */
        </style>

        <div class="content anggota">
          <h3 class="text-center">Anggota : </h3>
          <br>
          {!! Illuminate\Support\Str::markdown($o->member) !!}
        </div><!-- End post content -->
      </article><!-- End blog post -->
      <br>
      @endforeach

    </div>
  </section><!-- End Blog Details Section -->
@endsection