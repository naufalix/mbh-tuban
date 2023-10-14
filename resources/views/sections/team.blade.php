<!-- ======= Our Team Section ======= -->
<section id="team" class="team">
  <div class="container" data-aos="fade-up">

    <div class="section-header">
      <h2>Fasilitas</h2>
      <p>Nulla dolorum nulla nesciunt rerum facere sed ut inventore quam porro nihil id ratione ea sunt quis dolorem dolore earum</p>
    </div>

    <div class="row gy-4">

      @foreach ($facilities as $f)
      <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
        <div class="member">
          <img src="assets/images/facility/{{$f->image}}" class="img-fluid" alt="" style="aspect-ratio:1/1; object-fit:cover">
          <h4>{{$f->name}}</h4>
          {{-- <span>Web Development</span> --}}
          <div class="social d-none">
            <a href=""><i class="bi bi-twitter"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>
      </div><!-- End Team Member -->
      @endforeach

    </div>

  </div>
</section><!-- End Our Team Section -->