{{-- SERVICE DETAIL PAGE --}}
@extends('layouts.app')

@section('title', 'General Dentistry — Peoples Dental Care')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/service-detail.css') }}"/>
@endsection

@section('content')

<div class="page-banner">
  <h1>General Dentistry</h1>
  <div class="breadcrumb-wrap">
    <a href="{{ route('home') }}">Home</a>
    <span class="sep"><i class="fas fa-chevron-right"></i></span>
    <a href="{{ route('services') }}">Services</a>
    <span class="sep"><i class="fas fa-chevron-right"></i></span>
    <span class="current">General Dentistry</span>
  </div>
</div>

@include('components.marquee')

<section class="service-detail-section">
  <div class="container">
    <div class="row g-5">

      {{-- MAIN CONTENT --}}
      <div class="col-lg-8">
        <div class="srv-hero-img-wrap reveal">
          <img src="{{ asset('assets/download.jpeg') }}" alt="General Dentistry"/>
        </div>
        <div class="reveal">
          <span class="srv-tag-label">Preventive Care</span>
          <h2 class="srv-main-title">Comprehensive Care For A Healthy Smile</h2>
          <div class="srv-divider"></div>
        </div>
        <div class="reveal">
          <p class="srv-body-text">At Peoples Dental Care, general dentistry is the foundation of everything we do. Our comprehensive approach covers everything from your very first checkup to ongoing preventive treatments.</p>
          <p class="srv-body-text">We believe that prevention is always better than cure. Our experienced team works with each patient individually, creating personalised care plans that address both current concerns and future risks.</p>
        </div>
        <div class="reveal">
          <h4 class="fw-bold mb-3" style="color:#033C67">What's Included</h4>
          <ul class="srv-features-list">
            <li><i class="fas fa-check-circle"></i> Comprehensive oral examination &amp; X-rays</li>
            <li><i class="fas fa-check-circle"></i> Professional scaling &amp; teeth cleaning</li>
            <li><i class="fas fa-check-circle"></i> Tooth-coloured composite fillings</li>
            <li><i class="fas fa-check-circle"></i> Preventive fluoride treatments</li>
            <li><i class="fas fa-check-circle"></i> Gum health assessment &amp; early detection</li>
            <li><i class="fas fa-check-circle"></i> Oral hygiene education &amp; home care tips</li>
          </ul>
        </div>
        <div class="reveal">
          <a href="{{ route('home') }}#appointment" class="srv-appt-btn">
            Book Appointment <i class="fas fa-calendar-alt"></i>
          </a>
        </div>
      </div>

      {{-- SIDEBAR --}}
      <div class="col-lg-4">
        <div class="sidebar-services-box reveal-left">
          <h5 class="sidebar-box-title">All Services</h5>
          <ul class="sidebar-services-list">
            <li><a href="{{ route('service.detail', 'general-dentistry') }}" class="active-srv">General Dentistry <i class="fas fa-chevron-right"></i></a></li>
            <li><a href="{{ route('service.detail', 'teeth-whitening') }}">Teeth Whitening <i class="fas fa-chevron-right"></i></a></li>
            <li><a href="{{ route('service.detail', 'dental-implants') }}">Dental Implants <i class="fas fa-chevron-right"></i></a></li>
            <li><a href="{{ route('service.detail', 'gum-treatment') }}">Gum Treatment <i class="fas fa-chevron-right"></i></a></li>
            <li><a href="{{ route('service.detail', 'cosmetic-dentistry') }}">Cosmetic Dentistry <i class="fas fa-chevron-right"></i></a></li>
            <li><a href="{{ route('service.detail', 'orthodontics') }}">Orthodontics <i class="fas fa-chevron-right"></i></a></li>
            <li><a href="{{ route('service.detail', 'pediatric-dentistry') }}">Pediatric Dentistry <i class="fas fa-chevron-right"></i></a></li>
            <li><a href="{{ route('service.detail', 'root-canal') }}">Root Canal Therapy <i class="fas fa-chevron-right"></i></a></li>
          </ul>
        </div>
        <div class="sidebar-cta-box reveal-left">
          <i class="fas fa-phone-alt"></i>
          <h5>Need Help? Call Us</h5>
          <p>Our team is available Mon–Sat, 9AM to 7PM for consultations and appointments.</p>
          <a href="tel:+919999999999" class="sidebar-cta-btn"><i class="fas fa-phone-alt"></i> +91 99999 99999</a>
        </div>
        <div class="sidebar-hours-box reveal-left">
          <h5 class="sidebar-box-title">Opening Hours</h5>
          <ul class="hours-list">
            <li><span class="day">Monday – Friday</span><span class="time">9:00 AM – 7:00 PM</span></li>
            <li><span class="day">Saturday</span><span class="time">9:00 AM – 5:00 PM</span></li>
            <li class="closed"><span class="day">Sunday</span><span class="time">Closed</span></li>
          </ul>
        </div>
      </div>

    </div>
  </div>
</section>

<section class="why-strip">
  <div class="container">
    <div class="row g-0" id="whyRow">
      <div class="col-6 col-md-3 why-item"><div class="why-icon"><i class="fas fa-user-md"></i></div><h5>18+ Specialists</h5><p>Certified dentists with decades of combined expertise.</p></div>
      <div class="col-6 col-md-3 why-item"><div class="why-icon"><i class="fas fa-microscope"></i></div><h5>Advanced Tech</h5><p>Digital X-rays, 3D imaging & same-day treatments.</p></div>
      <div class="col-6 col-md-3 why-item"><div class="why-icon"><i class="fas fa-heart"></i></div><h5>Painless Care</h5><p>Patient comfort is our #1 priority every single visit.</p></div>
      <div class="col-6 col-md-3 why-item"><div class="why-icon"><i class="fas fa-rupee-sign"></i></div><h5>Clear Pricing</h5><p>No hidden charges — honest & affordable for all.</p></div>
    </div>
  </div>
</section>

<section class="cta-section">
  <div class="container">
    <h2>Ready for a Healthier Smile?</h2>
    <p>Book your general dentistry consultation today.</p>
    <a href="{{ route('home') }}#appointment" class="cta-btn">Book Appointment <i class="fas fa-calendar-alt"></i></a>
  </div>
</section>

@endsection

@section('js')
<script>
const revealEls = document.querySelectorAll('.reveal, .reveal-left, .why-item');
const revealObs = new IntersectionObserver((entries) => {
  entries.forEach((entry, i) => {
    if (entry.isIntersecting) {
      setTimeout(() => entry.target.classList.add('visible'), i * 80);
      revealObs.unobserve(entry.target);
    }
  });
}, { threshold: 0.12 });
revealEls.forEach(el => revealObs.observe(el));
</script>
@endsection