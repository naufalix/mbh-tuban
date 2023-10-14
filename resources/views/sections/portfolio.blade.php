<!-- ======= Portfolio Section ======= -->
<section id="portfolio" class="portfolio sections-bg">
  <div class="container" data-aos="fade-up">

    <div class="section-header">
      <h2>Galeri</h2>
      <p>Quam sed id excepturi ccusantium dolorem ut quis dolores nisi llum nostrum enim velit qui ut et autem uia reprehenderit sunt deleniti</p>
    </div>

    <div class="portfolio-isotope" data-portfolio-filter="*" data-portfolio-layout="masonry" data-portfolio-sort="original-order" data-aos="fade-up" data-aos-delay="100">

      <div class="d-none">
        <ul class="portfolio-flters">
          <li data-filter="*" class="filter-active">All</li>
          <li data-filter=".filter-app">App</li>
          <li data-filter=".filter-product">Product</li>
          <li data-filter=".filter-branding">Branding</li>
          <li data-filter=".filter-books">Books</li>
        </ul><!-- End Portfolio Filters -->
      </div>

      <div class="row gy-4 portfolio-container">

        @foreach ($galleries as $g)
        <div class="col-xl-4 col-md-6 portfolio-item filter-app">
          <div class="portfolio-wrap">
            <a href="assets/images/gallery/{{$g->image}}" data-gallery="portfolio-gallery-app" class="glightbox">
              <img src="assets/images/gallery/{{$g->image}}" class="img-fluid" alt="" style="aspect-ratio: 4/3; object-fit: cover;">
            </a>
            <div class="portfolio-info">
              <h4><a href="portfolio-details.html" title="More Details">{{$g->name}}</a></h4>
            </div>
          </div>
        </div><!-- End Portfolio Item -->
        @endforeach

      </div><!-- End Portfolio Container -->

    </div>

  </div>
</section><!-- End Portfolio Section -->