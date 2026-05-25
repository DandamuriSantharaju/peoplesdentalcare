{{-- SERVICES PAGE --}}
@extends('layouts.app')

@section('title', 'Services — Peoples Dental Care')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/services.css') }}"/>
@endsection

@section('content')

{{-- PAGE BANNER --}}
<div class="page-banner">
  <h1>Services</h1>
  <div class="breadcrumb-wrap">
    <a href="{{ route('home') }}">Home</a>
    <span><i class="fas fa-chevron-right"></i></span>
    <span class="current">Services</span>
  </div>
</div>

{{-- MARQUEE --}}
@include('components.marquee')

{{-- INTRO --}}
<section class="services-intro">
  <div class="container">
    <p class="intro-tag">Comprehensive · Personalized · Trusted</p>
    <h2 class="intro-title">Our Range of Dental Services</h2>
    <p class="intro-sub">Explore Comprehensive Solutions — All Tailored to Help Your Smile Shine Brighter</p>
  </div>
</section>

{{-- SERVICES GRID — rendered by JavaScript --}}
<section class="services-grid-section">
  <div class="container">
    <div class="srv-grid" id="srvGrid"></div>
  </div>
</section>

{{-- WHY US STRIP --}}
<section class="why-strip">
  <div class="container">
    <div class="why-grid">
      <div class="why-item">
        <div class="why-icon"><i class="fas fa-user-md"></i></div>
        <h5>Experienced Specialists</h5>
        <p>18+ certified dentists with decades of combined experience.</p>
      </div>
      <div class="why-item">
        <div class="why-icon"><i class="fas fa-microscope"></i></div>
        <h5>Advanced Technology</h5>
        <p>Digital X-rays, 3D imaging, and same-day crown systems.</p>
      </div>
      <div class="why-item">
        <div class="why-icon"><i class="fas fa-heart"></i></div>
        <h5>Painless Procedures</h5>
        <p>Patient comfort is our #1 priority at every appointment.</p>
      </div>
      <div class="why-item">
        <div class="why-icon"><i class="fas fa-rupee-sign"></i></div>
        <h5>Transparent Pricing</h5>
        <p>No hidden charges — honest, affordable care for everyone.</p>
      </div>
    </div>
  </div>
</section>

{{-- CTA --}}
<section class="cta-section">
  <div class="container">
    <h2>Ready for a Healthier Smile?</h2>
    <p>Book your consultation today — our friendly team is waiting to welcome you.</p>
    <a href="{{ route('home') }}#appointment" class="cta-btn">
      Book Appointment <i class="fas fa-calendar-alt"></i>
    </a>
  </div>
</section>

{{-- SERVICE DETAIL MODAL --}}
<div class="srv-modal-overlay" id="srvModalOverlay">
  <div class="srv-modal" id="srvModal">
    <button class="srv-modal-close" id="srvModalClose"><i class="fas fa-times"></i></button>
    <img class="srv-modal-img" id="srvModalImg" src="" alt=""/>
    <div class="srv-modal-body">
      <p class="srv-modal-tag" id="srvModalTag"></p>
      <h3 class="srv-modal-title" id="srvModalTitle"></h3>
      <p class="srv-modal-desc" id="srvModalDesc"></p>
      <ul class="srv-modal-features" id="srvModalFeatures"></ul>
      <a href="{{ route('home') }}#appointment" class="srv-modal-appt-btn">
        Book Appointment <i class="fas fa-arrow-right ms-2"></i>
      </a>
    </div>
  </div>
</div>

@endsection

@section('js')
<script>
const SERVICES = [
  { tag:"Preventive", title:"General Dentistry", desc:"Routine checkups, professional cleanings, fillings, and preventive treatments to keep your teeth strong and healthy for life.", img:"{{ asset('assets/download.jpeg') }}", features:["Comprehensive oral examination","Professional scaling & cleaning","Tooth-coloured fillings","X-rays & diagnostic imaging","Preventive fluoride treatments"] },
  { tag:"Cosmetic", title:"Teeth Whitening", desc:"Brighten your smile by several shades with our safe, professional in-clinic whitening treatments.", img:"https://images.unsplash.com/photo-1609840114035-3c981b782dfe?w=700&q=80", features:["In-clinic power whitening","Take-home whitening kits","Safe for enamel","Results last 12-18 months","Custom shade matching"] },
  { tag:"Restorative", title:"Dental Implants", desc:"Permanent, natural-looking tooth replacement solutions that look, feel, and function like real teeth.", img:"https://images.unsplash.com/photo-1622253692010-333f2da6031d?w=700&q=80", features:["Titanium & zirconia implants","Single tooth & full-arch solutions","Bone grafting when required","3D guided implant placement","Lifetime warranty on implants"] },
  { tag:"Periodontics", title:"Gum Treatment", desc:"Treat gum disease with deep cleaning, scaling and root planing, and targeted therapy.", img:"https://images.unsplash.com/photo-1629909613654-28e377c37b09?w=700&q=80", features:["Gum disease diagnosis","Deep cleaning & root planing","Laser gum therapy","Gum recession treatment","Maintenance programme"] },
  { tag:"Cosmetic", title:"Cosmetic Dentistry", desc:"Transform your smile with veneers, bonding, and reshaping options personalised for you.", img:"https://images.unsplash.com/photo-1606811841689-23dfddce3e95?w=700&q=80", features:["Porcelain & composite veneers","Smile design & makeovers","Dental bonding & reshaping","Gum contouring","Digital smile preview"] },
  { tag:"Orthodontics", title:"Orthodontics", desc:"Modern braces and clear aligners for beautifully aligned smiles at any age.", img:"https://images.unsplash.com/photo-1607613009820-a29f7bb81c04?w=700&q=80", features:["Metal & ceramic braces","Clear aligner therapy","Retainers & post-treatment care","Adult orthodontics","Teens & paediatric options"] },
  { tag:"Paediatric", title:"Pediatric Dentistry", desc:"Fun, gentle dental care designed just for growing kids.", img:"https://images.unsplash.com/photo-1600170311833-c2cf5280ce49?w=700&q=80", features:["Child-friendly environment","Dental sealants & fluoride","Thumb-sucking counselling","Space maintainers","Habit-breaking appliances"] },
  { tag:"Endodontics", title:"Root Canal Therapy", desc:"Relieve pain and preserve your natural teeth with our gentle root canal treatments.", img:"https://images.unsplash.com/photo-1629909615184-74f495363b67?w=700&q=80", features:["Single-visit root canals","Rotary endodontics","Microscope-assisted treatment","Post & core build-up","Crown placement after RCT"] }
];
const grid = document.getElementById('srvGrid');
SERVICES.forEach((srv, i) => {
  const card = document.createElement('div');
  card.className = 'srv-card';
  card.style.transitionDelay = (i * 0.08) + 's';
  card.innerHTML = `<div class="srv-img"><img src="${srv.img}" alt="${srv.title}" loading="lazy"/></div><div class="srv-body"><h5>${srv.title}</h5><p>${srv.desc.slice(0,100)}...</p><button class="srv-learn-btn" data-idx="${i}">Learn More <i class="fas fa-arrow-right"></i></button></div>`;
  grid.appendChild(card);
});
// const cardObs = new IntersectionObserver(entries => { entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); }); }, { threshold: 0.12 });
// document.querySelectorAll('.srv-card').forEach(c => cardObs.observe(c));
const cardObs = new IntersectionObserver(entries => {
  entries.forEach(e => {
    if (e.isIntersecting) {
      e.target.classList.add('visible');
      cardObs.unobserve(e.target);
    }
  });
}, { threshold: 0.05, rootMargin: '0px 0px -50px 0px' });

document.querySelectorAll('.srv-card').forEach(c => cardObs.observe(c));
const whyObs = new IntersectionObserver(entries => {
  entries.forEach(e => {
    if (e.isIntersecting) {
      e.target.classList.add('visible');
      whyObs.unobserve(e.target);
    }
  });
}, { threshold: 0.1 });
document.querySelectorAll('.why-item').forEach(w => whyObs.observe(w));
const overlay = document.getElementById('srvModalOverlay');
const closeBtn = document.getElementById('srvModalClose');
function openModal(idx) {
  const s = SERVICES[idx];
  document.getElementById('srvModalImg').src = s.img;
  document.getElementById('srvModalTag').textContent = s.tag;
  document.getElementById('srvModalTitle').textContent = s.title;
  document.getElementById('srvModalDesc').textContent = s.desc;
  document.getElementById('srvModalFeatures').innerHTML = s.features.map(f => `<li><i class="fas fa-check-circle"></i> ${f}</li>`).join('');
  overlay.classList.add('open');
  document.body.style.overflow = 'hidden';
}
function closeModal() { overlay.classList.remove('open'); document.body.style.overflow = ''; }
grid.addEventListener('click', e => { const btn = e.target.closest('[data-idx]'); if (btn) openModal(parseInt(btn.dataset.idx)); });
closeBtn.addEventListener('click', closeModal);
overlay.addEventListener('click', e => { if (e.target === overlay) closeModal(); });
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });
</script>
@endsection