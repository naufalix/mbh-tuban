<!-- ======= Recent Blog Posts Section ======= -->
<section id="recent-posts" class="recent-posts sections-bg">
  <div class="container" data-aos="fade-up">

    <div class="section-header">
      <h2>Recent Blog Posts</h2>
      <p>Consequatur libero assumenda est voluptatem est quidem illum et officia imilique qui vel architecto accusamus fugit aut qui distinctio</p>
    </div>

    <div class="row gy-4">

      @foreach ($posts as $p)
      <div class="col-xl-4 col-md-6">
        <article>
          <div class="post-img">
            <img src="assets/images/post/{{$p->image}}" alt="" class="img-fluid">
          </div>
          <h2 class="title">
            @php
              $date = date_create($p->created_at);
              if(strlen($p->title)<50){
                $judul = $p->title;
              }else{
                $judul = substr($p->title,0,47)."...";
              }
            @endphp
            <a href="/post/{{$p->slug}}">{{$judul}}</a>
          </h2>
          <div class="d-flex align-items-center">
            <img src="assets/images/users/default.png" alt="" class="img-fluid post-author-img flex-shrink-0">
            <div class="post-meta">
              <p class="post-author">Admin</p>
              <p class="post-date">
                <time datetime="{{date_format($date,"Y-m-d")}}">{{date_format($date,"d F Y")}}</time>
              </p>
            </div>
          </div>
        </article>
      </div><!-- End post list item -->
      @endforeach


    </div><!-- End recent posts list -->

  </div>
</section><!-- End Recent Blog Posts Section -->