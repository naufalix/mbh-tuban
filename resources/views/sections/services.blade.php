<!-- ======= Our Services Section ======= -->
<section id="services" class="services sections-bg">
  <div class="container" data-aos="fade-up">

    <div class="section-header">
      <h2>Program Kami</h2>
      <p>Aperiam dolorum et et wuia molestias qui eveniet numquam nihil porro incidunt dolores placeat sunt id nobis omnis tiledo stran delop</p>
    </div>

    <div class="row gy-4 justify-content-center" data-aos="fade-up" data-aos-delay="100">

      @foreach ($programs as $p)
      <div class="col-lg-4 col-md-6">
        <div class="service-item  position-relative">
          <div class="icon">
            <i class="mdi mdi-book-plus"></i>
          </div>
          <h3>{{$p->name}}</h3>
          {!! Illuminate\Support\Str::markdown($p->body) !!}
        </div>
      </div><!-- End Service Item -->
      @endforeach

    </div>

  </div>
</section><!-- End Our Services Section -->