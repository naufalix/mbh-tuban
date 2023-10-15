@extends('layouts.index')

@section('content')
  <!-- ======= Breadcrumbs ======= -->
  <div class="breadcrumbs">
    <nav>
      <div class="container">
        <ol>
          <li><a href="/">Home</a></li>
          <li>{{$post->title}}</li>
        </ol>
      </div>
    </nav>
  </div><!-- End Breadcrumbs -->

  <!-- ======= Blog Details Section ======= -->
  <section id="blog" class="blog">
    <div class="container" data-aos="fade-up">

      <div class="row g-5">

        <div class="col-lg-8">

          <article class="blog-details">

            <div class="post-img">
              <img src="/assets/images/post/{{$post->image}}" alt="" class="img-fluid" style="width: 100%;">
            </div>

            <h2 class="title">{{$post->title}}</h2>

            <div class="meta-top">
              <ul>
                <li class="d-flex align-items-center"><i class="bi bi-person"></i>Admin</li>
                @php
                  $date = date_create($post->created_at);
                @endphp
                <li class="d-flex align-items-center">
                  <i class="bi bi-clock"></i>
                  <time datetime="{{date_format($date,"Y-m-d")}}">{{date_format($date,"d F Y")}}</time>
                </li>
              </ul>
            </div><!-- End meta top -->

            <div class="content">
              {!! Illuminate\Support\Str::markdown($post->body) !!}
            </div><!-- End post content -->


          </article><!-- End blog post -->

        </div>

        <div class="col-lg-4">

          <div class="sidebar">

            <div class="sidebar-item recent-posts">
              <h3 class="sidebar-title">Recent Posts</h3>

              <div class="mt-3">

                @foreach ($posts as $p)
                @php
                  $date = date_create($p->created_at);
                  if(strlen($p->title)<50){
                    $judul = $p->title;
                  }else{
                    $judul = substr($p->title,0,47)."...";
                  }
                @endphp
                <div class="post-item mt-3">
                  <img src="/assets/images/post/{{$p->image}}" alt="">
                  <div>
                    <h4><a href="/post/{{$p->slug}}">{{$judul}}</a></h4>
                    <time datetime="{{date_format($date,"Y-m-d")}}">{{date_format($date,"d F Y")}}</time>
                  </div>
                </div><!-- End recent post item-->
                @endforeach

              </div>

            </div><!-- End sidebar recent posts-->

          </div><!-- End Blog Sidebar -->

        </div>
      </div>

    </div>
  </section><!-- End Blog Details Section -->
@endsection