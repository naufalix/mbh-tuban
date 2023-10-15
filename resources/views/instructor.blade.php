@extends('layouts.index')

@section('content')

  <!-- ======= Blog Details Section ======= -->
  <section id="blog" class="blog">
    <div class="container" data-aos="fade-up">

      <table class="table table-bordered">
        <tr>
          <th><p class="m-2">Nama</p></th>
          <th><p class="m-2">Jabatan</p></th>
          <th><p class="m-2">Jenis kelamin</p></th>
        </tr>
        @foreach ($instructors as $i)
        @php
          if($i->gender=="M"){$gender = "Laki-laki";}
          elseif($i->gender=="F"){$gender = "Perempuan";}
          else{$gender = "-";}
        @endphp
        <tr>
          <td><p class="m-2">{{$i->name}}</p></td>
          <td><p class="m-2">{{$i->position}}</p></td>
          <td><p class="m-2">{{$gender}}</p></td>
        </tr>
        @endforeach
      </table>
      

    </div>
  </section><!-- End Blog Details Section -->
@endsection