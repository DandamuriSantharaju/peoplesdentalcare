{{-- HOME PAGE --}}
{{-- Extends the main layout (has header, navbar, footer automatically) --}}

@extends('layouts.app')

@section('title', 'Peoples Dental Care — Creating Smiles')

@section('content')

{{-- HERO CAROUSEL --}}
<section class="hero-section" id="home">
  <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
    <div class="carousel-inner">

      {{-- Slide 1 --}}
      <div class="carousel-item active">
        <div class="container">
          <div class="row align-items-center hero-row">
            <div class="col-lg-7 hero-left">
              <p class="hero-tag">MODERN DENTAL CARE</p>
              <h1 class="hero-title">Bright Smiles Begin<br>with Trusted Hands</h1>
              <p class="hero-desc">We combine skill, sincerity, and science to<br>elevate every smile</p>
              <a href="#" onclick="openApptModal()" class="btn btn-hero-appoint">
                MAKE AN APPOINTMENT <i class="fas fa-arrow-right ms-2"></i>
              </a>
              <div class="hero-stats">
                <div class="hero-stat"><strong>20.9K</strong><span>Happy Customers</span></div>
                <div class="hero-stat"><strong>25+</strong><span>Years Experience</span></div>
                <div class="hero-stat"><strong>18+</strong><span>Specialists</span></div>
                <div class="hero-stat"><strong>95%</strong><span>Satisfaction Rate</span></div>
              </div>
            </div>
            <div class="col-lg-5 hero-right d-none d-lg-flex">
              <div class="hero-img-wrap">
                <img src="{{ asset('assets/images.jpg') }}" alt="Dental Care" class="hero-img"/>
              </div>
            </div>
          </div>
        </div>
      </div>

      {{-- Slide 2 --}}
      <div class="carousel-item">
        <div class="container">
          <div class="row align-items-center hero-row">
            <div class="col-lg-7 hero-left">
              <p class="hero-tag">ADVANCED TECHNOLOGY</p>
              <h1 class="hero-title">Digital Dentistry<br>Redefined Today</h1>
              <p class="hero-desc">From same-day crowns to 3D imaging —<br>painless, precise, and fast</p>
              <a href="#appointment" class="btn btn-hero-appoint">
                MAKE AN APPOINTMENT <i class="fas fa-arrow-right ms-2"></i>
              </a>
              <div class="hero-stats">
                <div class="hero-stat"><strong>20.9K</strong><span>Happy Customers</span></div>
                <div class="hero-stat"><strong>25+</strong><span>Years Experience</span></div>
                <div class="hero-stat"><strong>18+</strong><span>Specialists</span></div>
                <div class="hero-stat"><strong>95%</strong><span>Satisfaction Rate</span></div>
              </div>
            </div>
            <div class="col-lg-5 hero-right d-none d-lg-flex">
              <div class="hero-img-wrap">
                <img src="https://images.unsplash.com/photo-1629909613654-28e377c37b09?w=520&q=85" alt="Digital Dentistry" class="hero-img"/>
              </div>
            </div>
          </div>
        </div>
      </div>

      {{-- Slide 3 --}}
      <div class="carousel-item">
        <div class="container">
          <div class="row align-items-center hero-row">
            <div class="col-lg-7 hero-left">
              <p class="hero-tag">FAMILY FRIENDLY CARE</p>
              <h1 class="hero-title">Caring For Every<br>Smile in Your Family</h1>
              <p class="hero-desc">Comprehensive dental care for every age —<br>gentle, affordable, and trusted</p>
              <a href="#appointment" class="btn btn-hero-appoint">
                MAKE AN APPOINTMENT <i class="fas fa-arrow-right ms-2"></i>
              </a>
              <div class="hero-stats">
                <div class="hero-stat"><strong>20.9K</strong><span>Happy Customers</span></div>
                <div class="hero-stat"><strong>25+</strong><span>Years Experience</span></div>
                <div class="hero-stat"><strong>18+</strong><span>Specialists</span></div>
                <div class="hero-stat"><strong>95%</strong><span>Satisfaction Rate</span></div>
              </div>
            </div>
            <div class="col-lg-5 hero-right d-none d-lg-flex">
              <div class="hero-img-wrap">
                <img src="https://images.unsplash.com/photo-1607613009820-a29f7bb81c04?w=520&q=85" alt="Family Dental" class="hero-img"/>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
    <button class="carousel-control-prev hero-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
      <i class="fas fa-chevron-left"></i>
    </button>
    <button class="carousel-control-next hero-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
      <i class="fas fa-chevron-right"></i>
    </button>
  </div>
</section>

{{-- MARQUEE BAR --}}
@include('components.marquee')

{{-- WELCOME / ABOUT SECTION --}}
<section class="welcome-section" id="about">
  <div class="container-fluid px-0">
    <div class="row g-0">
      <div class="col-lg-5 welcome-left">
        <div class="wl-img-grid">
          <div class="wl-img-box wl-reveal" style="--delay:0.1s">
            <img src="{{ asset('assets/images1.jpeg') }}" alt="Clinic"/>
          </div>
          <div class="wl-img-box wl-reveal" style="--delay:0.2s">
            <img src="https://images.unsplash.com/photo-1606811841689-23dfddce3e95?w=500&q=80" alt="Dentist"/>
          </div>
        </div>
        <div class="wl-badges wl-reveal" style="--delay:0.3s">
          <div class="review-badge google-badge">
            <div class="review-badge-logo">
              <span style="color:#4285F4">G</span><span style="color:#EA4335">o</span><span style="color:#FBBC05">o</span><span style="color:#4285F4">g</span><span style="color:#34A853">l</span><span style="color:#EA4335">e</span>
            </div>
            <div class="review-stars">★★★★★</div>
            <div class="review-label">Verified customer Reviews</div>
          </div>
          <div class="review-badge practo-badge">
            <div class="practo-logo">practo</div>
            <div class="practo-good">Good</div>
            <div class="review-stars">★★★★★</div>
          </div>
        </div>
        <div class="wl-videos wl-reveal" style="--delay:0.4s">
          <div class="video-card">
            <video autoplay muted loop playsinline>
              <source src="{{ asset('assets/implant_video.mp4') }}" type="video/mp4"/>
            </video>
            <div class="video-overlay"><i class="fas fa-play-circle"></i></div>
          </div>
          <div class="video-card">
            <video autoplay muted loop playsinline>
              <source src="{{ asset('assets/peoples_dental_care.mp4') }}" type="video/mp4"/>
            </video>
            <div class="video-overlay"><i class="fas fa-play-circle"></i></div>
          </div>
        </div>
      </div>
      <div class="col-lg-7 welcome-right">
        <div class="welcome-content wl-reveal" style="--delay:0.15s">
          <h2 class="welcome-title">Welcome to Peoples Dental Care</h2>
          <p class="welcome-body">
            Peoples dental care was established in 2016 with the aim of providing ethical, comfortable and affordable treatment by compassionate and professional team of doctors.
          </p>
          <p class="welcome-body">
            We're not just improving smiles — we're building lasting relationships based on trust, comfort, and outstanding results.
          </p>
          <a href="{{ route('services') }}" class="welcome-link">Top-Rated Dental Care in Hyderabad</a>
        </div>
        <div class="welcome-side-img wl-reveal" style="--delay:0.25s">
          <img src="https://images.unsplash.com/photo-1629909613654-28e377c37b09?w=500&q=80" alt="Dental procedure"/>
        </div>
      </div>
    </div>
  </div>
  <div class="fixed-call-cards" id="fixedCards">
    <a href="tel:+919999999999" class="fixed-card">
      <i class="fas fa-phone-volume"></i>
      <span>Call for a<br>Healthier Smile</span>
    </a>
    <a href="tel:+919999999999" class="fixed-card">
      <i class="fas fa-phone-volume"></i>
      <span>Call for a<br>Healthier Smile</span>
    </a>
    <a href="tel:+919999999999" class="fixed-card">
      <i class="fas fa-phone-volume"></i>
      <span>Call for a<br>Healthier Smile</span>
    </a>
  </div>
</section>

{{-- DENTAL SOLUTIONS SECTION --}}
<section class="dental-solutions-section" id="services">
  <div class="container">
    <div class="solutions-heading">
      <h2>Dental Solutions</h2>
      <p>Innovative Dental Solutions for Every Smile</p>
    </div>
    <div class="bento-grid">
      <div class="bento-card">
        <img src="{{ asset('assets/download.jpeg') }}">
        <div class="card-btn"><button>General Dentistry</button></div>
        <div class="card-content">
          <h4>General Dentistry</h4>
          <p>Complete dental care including checkups, cleaning and preventive treatments.</p>
          <a href="{{ route('service.detail', 'general-dentistry') }}" class="srv-learn-btn">Learn More</a>
        </div>
      </div>
      <div class="bento-card big">
        <img src="https://images.unsplash.com/photo-1606811841689-23dfddce3e95?w=900&q=80">
        <div class="card-btn"><button>Orthodontics</button></div>
        <div class="card-content">
          <h4>Orthodontics</h4>
          <p>Modern braces and aligners for beautifully aligned smiles.</p>
          <a href="{{ route('services') }}">LEARN MORE</a>
        </div>
      </div>
      <div class="bento-card">
        <img src="https://images.unsplash.com/photo-1629909613654-28e377c37b09?w=700&q=80">
        <div class="card-btn"><button>Oral Hygiene</button></div>
        <div class="card-content">
          <h4>Oral Hygiene</h4>
          <p>Professional cleaning and healthy oral care for strong teeth.</p>
          <a href="{{ route('services') }}">LEARN MORE</a>
        </div>
      </div>
      <div class="bento-card">
        <img src="{{ asset('assets/download (1).jpeg') }}">
        <div class="card-btn"><button>Digital Dentistry</button></div>
        <div class="card-content">
          <h4>Digital Dentistry</h4>
          <p>Digital dentistry represents a revolutionary transformation in oral healthcare.</p>
          <a href="{{ route('services') }}">LEARN MORE</a>
        </div>
      </div>
      <div class="bento-card">
        <img src="https://images.unsplash.com/photo-1609840114035-3c981b782dfe?w=700&q=80">
        <div class="card-btn"><button>Teeth Whitening</button></div>
        <div class="card-content">
          <h4>Teeth Whitening</h4>
          <p>Brighten your smile with safe and effective whitening treatments.</p>
          <a href="{{ route('services') }}">LEARN MORE</a>
        </div>
      </div>
      <div class="bento-card">
        <img src="https://images.unsplash.com/photo-1622253692010-333f2da6031d?w=700&q=80">
        <div class="card-btn"><button>Cosmetic Dentistry</button></div>
        <div class="card-content">
          <h4>Cosmetic Dentistry</h4>
          <p>Modern digital tools improve accuracy, comfort and treatment speed.</p>
          <a href="{{ route('services') }}">LEARN MORE</a>
        </div>
      </div>
      <div class="bento-card">
        <img src="https://images.unsplash.com/photo-1600170311833-c2cf5280ce49?w=700&q=80">
        <div class="card-btn"><button>Dental Implants</button></div>
        <div class="card-content">
          <h4>Dental Implants</h4>
          <p>Permanent tooth replacement solutions for natural confident smiles.</p>
          <a href="{{ route('services') }}">LEARN MORE</a>
        </div>
      </div>
    </div>
    <div class="solutions-btn-wrap">
      <a href="{{ route('services') }}" class="solutions-main-btn">VIEW ALL SERVICES</a>
    </div>
  </div>
</section>

{{-- TESTIMONIALS --}}
<section class="testimonials-section" id="testimonials">
  <div class="container">
    <div class="text-center mb-5">
      <p class="section-tag">TESTIMONIALS</p>
      <h2 class="testimonials-title">Happy Customers</h2>
      <p class="testimonials-sub">Real smiles — see why patients trust Peoples Dental Care.</p>
    </div>
    <div class="testi-carousel-wrap">
      <div class="testi-track" id="testiTrack"></div>
      <div class="testi-dots" id="testiDots"></div>
    </div>
  </div>
</section>

{{-- TEAM SECTION --}}
<section class="team-section" id="team">
  <div class="container-fluid px-3">
    <div class="text-center team-heading-wrap">
      <p class="section-tag">Our Experts</p>
      <h2 class="team-main-title">Meet the Partners</h2>
      <p class="team-main-sub">There are three independent Partners at Peoples Dental Care Hyderabad Practice.</p>
    </div>
    <div class="team-grid">
      <div class="team-card-new">
        <div class="team-img-area">
          <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=600&q=80" alt="Dr. Harish Kumar"/>
        </div>
        <div class="team-info-bar">
          <div><h5>Dr. Harish Kumar</h5><span>General Dentist &amp; Partner</span></div>
          <a href="#" class="team-learn-btn">LEARN MORE</a>
        </div>
      </div>
      <div class="team-card-new">
        <div class="team-img-area">
          <img src="https://images.unsplash.com/photo-1594824476967-48c8b964273f?w=600&q=80" alt="Dr. Meena Rao"/>
        </div>
        <div class="team-info-bar">
          <div><h5>Dr. Meena Rao</h5><span>Orthodontist &amp; Partner</span></div>
          <a href="#" class="team-learn-btn">LEARN MORE</a>
        </div>
      </div>
      <div class="team-card-new">
        <div class="team-img-area">
          <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=600&q=80" alt="Dr. Sonal Gupta"/>
        </div>
        <div class="team-info-bar">
          <div><h5>Dr. Sonal Gupta</h5><span>Paediatric Dentist &amp; Partner</span></div>
          <a href="#" class="team-learn-btn">LEARN MORE</a>
        </div>
      </div>
    </div>
    <div class="team-btn-wrap">
      <a href="#" class="team-view-all-btn">VIEW ALL DOCTORS</a>
    </div>
  </div>
</section>

{{-- STATS --}}
<section class="stats-section" id="stats">
  <div class="stats-overlay"></div>
  <div class="container position-relative">
    <div class="stats-grid">
      <div class="stat-item"><span class="stat-num" data-target="25">0</span><span class="stat-plus">+</span><p class="stat-label">Years Experience</p></div>
      <div class="stat-item"><span class="stat-num" data-target="95">0</span><span class="stat-plus">%</span><p class="stat-label">Satisfaction Rate</p></div>
      <div class="stat-item"><span class="stat-num" data-target="20900">0</span><span class="stat-plus">+</span><p class="stat-label">Happy Patients</p></div>
      <div class="stat-item"><span class="stat-num" data-target="18">0</span><span class="stat-plus">+</span><p class="stat-label">Specialists</p></div>
    </div>
  </div>
</section>

{{-- BLOG --}}
<section class="blog-section" id="blog">
  <div class="container-fluid px-0">
    <div class="text-center blog-heading-wrap">
      <p class="section-tag">READ OUR BLOG</p>
      <h2 class="blog-main-title">Check Out Latest Articles</h2>
    </div>
    <div class="blog-grid">
      <div class="blog-card-new">
        <div class="blog-img-wrap">
          <img src="https://images.unsplash.com/photo-1609840114035-3c981b782dfe?w=600&q=80" alt="Blog"/>
          <span class="blog-tag">Emergency</span>
        </div>
        <div class="blog-card-body">
          <div class="blog-meta-row"><span><i class="fas fa-calendar-alt"></i> May 10, 2026</span><span><i class="fas fa-user"></i> Dr. Anil</span></div>
          <h5>What is a Dental Emergency?</h5>
          <p>Your smile is one of the first things people notice. Learn when to seek emergency dental care...</p>
          <a href="#" class="blog-read-more">Read More <i class="fas fa-arrow-right"></i></a>
        </div>
      </div>
      <div class="blog-card-new">
        <div class="blog-img-wrap">
          <img src="https://images.unsplash.com/photo-1606811841689-23dfddce3e95?w=600&q=80" alt="Blog"/>
          <span class="blog-tag">Tips</span>
        </div>
        <div class="blog-card-body">
          <div class="blog-meta-row"><span><i class="fas fa-calendar-alt"></i> May 5, 2026</span><span><i class="fas fa-user"></i> Dr. Meena</span></div>
          <h5>Top 5 Tips for Healthy Teeth</h5>
          <p>Simple daily habits that keep your teeth strong and your smile bright for life...</p>
          <a href="#" class="blog-read-more">Read More <i class="fas fa-arrow-right"></i></a>
        </div>
      </div>
      <div class="blog-card-new">
        <div class="blog-img-wrap">
          <img src="{{ asset('assets/download (2).jpeg') }}" alt="Blog"/>
          <span class="blog-tag">Orthodontics</span>
        </div>
        <div class="blog-card-body">
          <div class="blog-meta-row"><span><i class="fas fa-calendar-alt"></i> Apr 28, 2026</span><span><i class="fas fa-user"></i> Dr. Vikram</span></div>
          <h5>Braces vs Clear Aligners</h5>
          <p>Which orthodontic option is right for you? We compare both in detail...</p>
          <a href="#" class="blog-read-more">Read More <i class="fas fa-arrow-right"></i></a>
        </div>
      </div>
      <div class="blog-card-new">
        <div class="blog-img-wrap">
          <img src="https://images.unsplash.com/photo-1629909613654-28e377c37b09?w=600&q=80" alt="Blog"/>
          <span class="blog-tag">Whitening</span>
        </div>
        <div class="blog-card-body">
          <div class="blog-meta-row"><span><i class="fas fa-calendar-alt"></i> Apr 20, 2026</span><span><i class="fas fa-user"></i> Dr. Sonal</span></div>
          <h5>Is Teeth Whitening Safe?</h5>
          <p>Everything you need to know about professional whitening treatments...</p>
          <a href="#" class="blog-read-more">Read More <i class="fas fa-arrow-right"></i></a>
        </div>
      </div>
    </div>
    <div class="blog-btn-wrap">
      <a href="#" class="blog-view-all-btn">VIEW ALL BLOGS</a>
    </div>
  </div>
</section>

{{-- APPOINTMENT --}}
<section class="appointment-section" id="appointment">
  <div class="container-fluid px-0">
    <div class="appt-wrap">
      <div class="appt-left">
        <p class="section-tag light-tag">BOOK YOUR APPOINTMENT</p>
        <h2 class="appt-title">Book Your Dental Care<br>Appointment With Us</h2>
        <p class="appt-desc">Take the first step toward a healthier, brighter smile.</p>
        <ul class="appt-features">
          <li><i class="fas fa-check-circle"></i> No hidden charges — transparent pricing</li>
          <li><i class="fas fa-check-circle"></i> Experienced &amp; certified dental specialists</li>
          <li><i class="fas fa-check-circle"></i> Modern clinic with advanced equipment</li>
          <li><i class="fas fa-check-circle"></i> Flexible timings — Mon to Sat, 9AM–7PM</li>
        </ul>
        <div class="appt-contact-info">
          <a href="tel:+919999999999" class="appt-contact-item">
            <div class="appt-contact-icon"><i class="fas fa-phone-alt"></i></div>
            <div><span>Call Us Anytime</span><strong>+91 99999 99999</strong></div>
          </a>
          <a href="mailto:peopledentalclinic@gmail.com" class="appt-contact-item">
            <div class="appt-contact-icon"><i class="fas fa-envelope"></i></div>
            <div><span>Email Us</span><strong>peopledentalclinic@gmail.com</strong></div>
          </a>
        </div>
      </div>
      <div class="appt-right">
        <h4 class="appt-form-title">Fill In Your Details</h4>
        <p class="appt-form-sub">We'll confirm your appointment within 24 hours.</p>
        <!-- <form class="appt-form" action="{{ route('appointment.store') }}" method="POST"> -->
        <form class="appt-form" id="homeApptForm" action="{{ route('appointment.store') }}" method="POST">
          @csrf
          <div class="appt-row">
            <div class="appt-field"><input type="text" name="name" placeholder="Your Full Name" class="appt-input" required/></div>
            <div class="appt-field"><input type="tel" name="phone" placeholder="Phone Number" class="appt-input" required/></div>
          </div>
          <div class="appt-row">
            <div class="appt-field"><input type="email" name="email" placeholder="Email Address" class="appt-input"/></div>
            <div class="appt-field">
              <select name="service" class="appt-input appt-select">
                <option value="">Select Service</option>
                <option>General Dentistry</option>
                <option>Orthodontics</option>
                <option>Teeth Whitening</option>
                <option>Dental Implants</option>
                <option>Root Canal</option>
                <option>Smile Design</option>
                <option>Paediatric Dental</option>
              </select>
            </div>
          </div>
          <div class="appt-row">
            <div class="appt-field"><input type="date" name="date" class="appt-input"/></div>
            <div class="appt-field">
              <select name="time" class="appt-input appt-select">
                <option value="">Preferred Time</option>
                <option>9:00 AM</option><option>10:00 AM</option>
                <option>11:00 AM</option><option>1:00 PM</option>
                <option>3:00 PM</option><option>5:00 PM</option>
              </select>
            </div>
          </div>
          <div class="appt-field">
            <textarea name="notes" class="appt-input appt-textarea" rows="3" placeholder="Additional Notes (optional)"></textarea>
          </div>
          <!-- <button type="submit" class="appt-submit-btn" id="apptSubmitBtn">
            CONFIRM APPOINTMENT <i class="fas fa-arrow-right ms-2"></i>
          </button> -->
          <div id="homeApptSuccess" style="display:none;background:#dcfce7;border:1.5px solid #bbf7d0;border-radius:12px;padding:18px;text-align:center;margin-bottom:16px;">
  <i class="fas fa-check-circle" style="color:#16a34a;font-size:1.8rem;display:block;margin-bottom:8px;"></i>
  <strong style="color:#16a34a;display:block;">Appointment Booked!</strong>
  <span style="color:#555;font-size:0.83rem;">We'll confirm your slot within 24 hours.</span>
</div>

<button type="submit" class="appt-submit-btn" id="apptSubmitBtn">
  CONFIRM APPOINTMENT <i class="fas fa-arrow-right ms-2"></i>
</button>
        </form>
      </div>
    </div>
  </div>
</section>
<script>
document.getElementById('homeApptForm').addEventListener('submit', async function(e) {
  e.preventDefault();

  const btn = document.getElementById('apptSubmitBtn');
  btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Booking...';
  btn.disabled = true;

  const formData = new FormData(this);

  try {
    const res = await fetch(this.action, {
      method: 'POST',
      headers: { 'X-Requested-With': 'XMLHttpRequest' },
      body: formData
    });

    const data = await res.json();

    if (data.success) {
      // Show success, hide form fields
      document.getElementById('homeApptSuccess').style.display = 'block';
      this.reset();

      // Reset button after 4 seconds
      setTimeout(() => {
        document.getElementById('homeApptSuccess').style.display = 'none';
        btn.innerHTML = 'CONFIRM APPOINTMENT <i class="fas fa-arrow-right ms-2"></i>';
        btn.disabled = false;
      }, 4000);
    } else {
      btn.innerHTML = 'CONFIRM APPOINTMENT <i class="fas fa-arrow-right ms-2"></i>';
      btn.disabled = false;
      alert('Something went wrong. Please try again.');
    }
  } catch (err) {
    btn.innerHTML = 'CONFIRM APPOINTMENT <i class="fas fa-arrow-right ms-2"></i>';
    btn.disabled = false;
    alert('Network error. Please try again.');
  }
});
</script>
@endsection