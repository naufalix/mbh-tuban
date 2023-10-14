<!DOCTYPE html>
<html lang="en">

<head>
  @include('partials.index-head')
</head>

<body>
  
  @include('sections.topbar')
  @include('partials.index-header')
  @yield('hero')
  
  <main id="main">
    @yield('content')
  </main><!-- End #main -->

  @include('partials.index-footer')
  
  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  
  <div id="preloader"></div>
  
  @include('partials.index-script')

</body>

</html>