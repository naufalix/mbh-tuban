@extends('layouts.index')

@section('hero')
  @include('sections.hero')
@endsection

@section('content')
  @include('sections.about')
  {{-- @include('sections.clients') --}}
  {{-- @include('sections.stats-counter') --}}
  {{-- @include('sections.call-to-action') --}}
  @include('sections.services')
  {{-- @include('sections.testimonials') --}}
  @include('sections.portfolio')
  @include('sections.team')
  {{-- @include('sections.pricing')
  @include('sections.faq') --}}
  @include('sections.recent-posts')
  {{-- @include('sections.contact') --}}
@endsection