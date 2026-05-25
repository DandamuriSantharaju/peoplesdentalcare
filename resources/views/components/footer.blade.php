{{-- FOOTER COMPONENT --}}
{{-- This file is included in layouts/app.blade.php --}}
{{-- Used on every page automatically --}}

<footer class="footer-section" id="contact">

  <div class="footer-main">
    <div class="container-fluid px-0">
      <div class="footer-grid">

        {{-- COL 1 — Brand + Services + Contact --}}
        <div class="footer-col">
          <h4 class="footer-col-title">Peoples Dental Care</h4>
          <ul class="footer-links-list">
            <li><a href="#">All Services</a></li>
            <li><a href="#">Teeth Cleaning &amp; Scaling</a></li>
            <li><a href="#">Root Canal Treatments</a></li>
            <li><a href="#">Dental Fillings</a></li>
            <li><a href="#">Dentures</a></li>
            <li><a href="#">Crowns</a></li>
            <li><a href="#">Dental Implants</a></li>
          </ul>
          <div class="footer-contact-block">
            <h5 class="footer-sub-title">Contact Info</h5>
            <p class="footer-address">
              <i class="fas fa-map-marker-alt"></i>
              2nd floor, bus-stop, Hydernagar, above HDFC Bank, Hyder Nagar, Hyderabad, Telangana 500085
            </p>
            <p class="footer-contact-line">
              <i class="fas fa-envelope"></i>
              <a href="mailto:peopledentalclinic@gmail.com">peopledentalclinic@gmail.com</a>
            </p>
            <p class="footer-contact-line">
              <i class="fas fa-phone-alt"></i>
              <a href="tel:+919999999999">+91 99999 99999</a>
            </p>
            <div class="footer-socials">
              <a href="#"><i class="fab fa-facebook-f"></i></a>
              <a href="#"><i class="fab fa-instagram"></i></a>
              <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
          </div>
        </div>

        {{-- COL 2 — Quick Links --}}
        <div class="footer-col">
          <h4 class="footer-col-title">Quick Links</h4>
          <ul class="footer-links-list">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('home') }}#about">About Us</a></li>
            <li><a href="{{ route('home') }}#team">Our Team</a></li>
            <li><a href="{{ route('services') }}">Services</a></li>
            <li><a href="{{ route('home') }}#testimonials">Testimonials</a></li>
            <li><a href="{{ route('contact') }}">Contact Us</a></li>
            <li><a href="{{ route('home') }}#appointment">Appointment Form</a></li>
          </ul>
        </div>

        {{-- COL 3 — Legal --}}
        <div class="footer-col">
          <h4 class="footer-col-title">Legal</h4>
          <ul class="footer-links-list">
            <li><a href="#">Terms &amp; Conditions</a></li>
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">Cookie Policy</a></li>
          </ul>
        </div>

        {{-- COL 4 — Images --}}
        <div class="footer-col footer-img-col">
          <div class="footer-circles-row">
            <div class="footer-circle-img">
              <img src="{{ asset('assets/badge.png') }}" alt="Badge"/>
            </div>
            <div class="footer-circle-img">
              <img src="{{ asset('assets/badge1.png') }}" alt="Badge"/>
            </div>
          </div>
          <div class="footer-rect-img">
            <img src="{{ asset('assets/cerf.jpg') }}" alt="Certificate"/>
          </div>
        </div>

      </div>
    </div>
  </div>

  {{-- FOOTER BOTTOM --}}
  <div class="footer-bottom">
    <div class="container-fluid px-0">
      <p>&copy; {{ date('Y') }} Peoples Dental Care. All Rights Reserved.</p>
    </div>
  </div>

  <div class="footer-bg-overlay"></div>

</footer>