{{-- APPOINTMENT MODAL COMPONENT --}}
{{-- Include once in layouts/app.blade.php — works on every page --}}

<!-- Appointment Modal Overlay -->
<div class="appt-modal-overlay" id="apptModalOverlay">
  <div class="appt-modal-box" id="apptModalBox">

    <!-- Close Button -->
    <button class="appt-modal-close" id="apptModalClose">
      <i class="fas fa-times"></i>
    </button>

    <!-- Left Side -->
    <div class="appt-modal-left">
      <div class="appt-modal-brand">
        <i class="fas fa-tooth"></i>
      </div>
      <h2>Book Your Appointment</h2>
      <p>Take the first step toward a healthier, brighter smile. We'll confirm within 24 hours.</p>
      <ul class="appt-modal-features">
        <li><i class="fas fa-check-circle"></i> No hidden charges</li>
        <li><i class="fas fa-check-circle"></i> Certified specialists</li>
        <li><i class="fas fa-check-circle"></i> Advanced equipment</li>
        <li><i class="fas fa-check-circle"></i> Mon–Sat, 9AM–7PM</li>
      </ul>
      <div class="appt-modal-contact">
        <a href="tel:+919999999999">
          <i class="fas fa-phone-alt"></i> +91 99999 99999
        </a>
      </div>
    </div>

    <!-- Right Side — Form -->
    <div class="appt-modal-right">
      <h4>Fill In Your Details</h4>
      <p class="appt-modal-sub">We'll call you back to confirm your slot.</p>

      <!-- Success Message (hidden by default) -->
      <div class="appt-modal-success" id="apptModalSuccess" style="display:none;">
        <i class="fas fa-check-circle"></i>
        <strong>Appointment Booked!</strong>
        <span>We'll confirm your slot within 24 hours.</span>
      </div>

      <form id="apptModalForm" action="{{ route('appointment.store') }}" method="POST">
        @csrf
        <div class="appt-modal-row">
          <div class="appt-modal-field">
            <input type="text" name="name" class="appt-modal-input"
                   placeholder="Your Full Name" required/>
          </div>
          <div class="appt-modal-field">
            <input type="tel" name="phone" class="appt-modal-input"
                   placeholder="Phone Number" required/>
          </div>
        </div>
        <div class="appt-modal-row">
          <div class="appt-modal-field">
            <input type="email" name="email" class="appt-modal-input"
                   placeholder="Email Address (optional)"/>
          </div>
          <div class="appt-modal-field">
            <select name="service" class="appt-modal-input appt-modal-select">
              <option value="">Select Service</option>
              <option>General Dentistry</option>
              <option>Orthodontics</option>
              <option>Teeth Whitening</option>
              <option>Dental Implants</option>
              <option>Root Canal</option>
              <option>Smile Design</option>
              <option>Cosmetic Dentistry</option>
              <option>Paediatric Dental</option>
            </select>
          </div>
        </div>
        <div class="appt-modal-row">
          <div class="appt-modal-field">
            <input type="date" name="date" class="appt-modal-input"/>
          </div>
          <div class="appt-modal-field">
            <select name="time" class="appt-modal-input appt-modal-select">
              <option value="">Preferred Time</option>
              <option>9:00 AM</option>
              <option>10:00 AM</option>
              <option>11:00 AM</option>
              <option>1:00 PM</option>
              <option>3:00 PM</option>
              <option>5:00 PM</option>
            </select>
          </div>
        </div>
        <div class="appt-modal-field">
          <textarea name="notes" class="appt-modal-input appt-modal-textarea"
                    rows="3" placeholder="Additional Notes (optional)"></textarea>
        </div>
        <button type="submit" class="appt-modal-submit" id="apptModalSubmit">
          <i class="fas fa-calendar-check me-2"></i> CONFIRM APPOINTMENT
        </button>
      </form>
    </div>

  </div>
</div>

{{-- MODAL CSS --}}
<style>
.appt-modal-overlay {
  position: fixed;
  inset: 0;
  background: rgba(3, 20, 50, 0.80);
  z-index: 9999;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 16px;
  opacity: 0;
  pointer-events: none;
  transition: opacity 0.35s ease;
  backdrop-filter: blur(6px);
}
.appt-modal-overlay.open {
  opacity: 1;
  pointer-events: all;
}
.appt-modal-box {
  background: #fff;
  width: 100%;
  max-width: 860px;
  max-height: 92vh;
  overflow-y: auto;
  border-radius: 20px;
  display: grid;
  grid-template-columns: 1fr 1.4fr;
  position: relative;
  transform: translateY(40px) scale(0.97);
  transition: transform 0.4s cubic-bezier(0.22,1,0.36,1);
  box-shadow: 0 40px 100px rgba(3,30,60,0.40);
}
.appt-modal-overlay.open .appt-modal-box {
  transform: translateY(0) scale(1);
}

/* Close Button */
.appt-modal-close {
  position: absolute;
  top: 16px; right: 16px;
  width: 36px; height: 36px;
  border-radius: 50%;
  border: none;
  background: rgba(3,60,103,0.10);
  color: #033C67;
  font-size: 0.95rem;
  cursor: pointer;
  display: flex; align-items: center; justify-content: center;
  transition: all 0.25s ease;
  z-index: 10;
}
.appt-modal-close:hover { background: #033C67; color: #fff; }

/* Left Side */
.appt-modal-left {
  background: linear-gradient(160deg, #033C67 0%, #1D84B5 100%);
  padding: 48px 32px;
  display: flex;
  flex-direction: column;
  gap: 0;
  border-radius: 20px 0 0 20px;
}
.appt-modal-brand {
  width: 56px; height: 56px;
  background: rgba(255,255,255,0.15);
  border-radius: 14px;
  display: flex; align-items: center; justify-content: center;
  font-size: 1.5rem; color: #7DD3F8;
  margin-bottom: 22px;
}
.appt-modal-left h2 {
  font-family: 'Playfair Display', serif;
  font-size: 1.5rem; font-weight: 800;
  color: #fff; margin-bottom: 12px; line-height: 1.3;
}
.appt-modal-left p {
  font-size: 0.86rem; color: rgba(255,255,255,0.72);
  line-height: 1.75; margin-bottom: 24px;
}
.appt-modal-features {
  list-style: none; padding: 0; margin: 0 0 28px;
  display: flex; flex-direction: column; gap: 10px;
}
.appt-modal-features li {
  display: flex; align-items: center; gap: 10px;
  font-size: 0.84rem; color: rgba(255,255,255,0.88);
  font-weight: 500;
}
.appt-modal-features li i { color: #7DD3F8; }
.appt-modal-contact a {
  display: inline-flex; align-items: center; gap: 8px;
  color: #7DD3F8; font-size: 0.88rem; font-weight: 700;
  text-decoration: none;
}

/* Right Side */
.appt-modal-right {
  padding: 48px 36px;
  display: flex;
  flex-direction: column;
}
.appt-modal-right h4 {
  font-family: 'Playfair Display', serif;
  font-size: 1.35rem; font-weight: 800;
  color: #033C67; margin-bottom: 4px;
}
.appt-modal-sub {
  font-size: 0.83rem; color: #7a9ab5;
  margin-bottom: 24px;
}

/* Form */
.appt-modal-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 12px;
  margin-bottom: 12px;
}
.appt-modal-field { display: flex; flex-direction: column; }
.appt-modal-input {
  width: 100%;
  border: 1.5px solid #dce8f2;
  border-radius: 8px;
  padding: 11px 14px;
  font-size: 0.86rem;
  font-family: 'Inter', sans-serif;
  background: #f8fbfe;
  color: #1a2a3a;
  outline: none;
  transition: all 0.25s ease;
  appearance: none;
  -webkit-appearance: none;
}
.appt-modal-input::placeholder { color: #aabccc; }
.appt-modal-input:focus {
  border-color: #1D84B5;
  background: #fff;
  box-shadow: 0 0 0 3px rgba(29,132,181,0.12);
}
.appt-modal-select {
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%231D84B5' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 12px center;
  padding-right: 32px;
  cursor: pointer;
}
.appt-modal-textarea {
  resize: none; height: 80px; margin-bottom: 12px;
}
.appt-modal-submit {
  width: 100%;
  background: linear-gradient(135deg, #033C67, #1D84B5);
  color: #fff; border: none;
  border-radius: 10px;
  padding: 14px;
  font-size: 0.88rem; font-weight: 700;
  letter-spacing: 0.5px;
  cursor: pointer;
  transition: all 0.3s ease;
  margin-top: 4px;
  font-family: 'Inter', sans-serif;
  box-shadow: 0 6px 20px rgba(29,132,181,0.30);
}
.appt-modal-submit:hover {
  transform: translateY(-2px);
  box-shadow: 0 12px 30px rgba(29,132,181,0.40);
}

/* Success Message */
.appt-modal-success {
  background: #dcfce7;
  border: 1.5px solid #bbf7d0;
  border-radius: 12px;
  padding: 20px;
  text-align: center;
  margin-bottom: 20px;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 6px;
}
.appt-modal-success i {
  font-size: 2rem; color: #16a34a;
}
.appt-modal-success strong {
  font-size: 1rem; color: #16a34a;
}
.appt-modal-success span {
  font-size: 0.82rem; color: #555;
}

/* Responsive */
@media (max-width: 767px) {
  .appt-modal-box {
    grid-template-columns: 1fr;
    border-radius: 16px;
    max-height: 95vh;
  }
  .appt-modal-left { border-radius: 16px 16px 0 0; padding: 32px 24px; }
  .appt-modal-right { padding: 28px 24px; }
  .appt-modal-row { grid-template-columns: 1fr; }
}
</style>

{{-- MODAL JS --}}
<script>
// Open modal from anywhere
function openApptModal(preService = '') {
  const overlay = document.getElementById('apptModalOverlay');
  overlay.classList.add('open');
  document.body.style.overflow = 'hidden';
  // Pre-select service if passed
  if (preService) {
    const sel = document.querySelector('#apptModalForm select[name="service"]');
    if (sel) {
      [...sel.options].forEach(o => {
        if (o.text.toLowerCase().includes(preService.toLowerCase())) {
          o.selected = true;
        }
      });
    }
  }
}

function closeApptModal() {
  document.getElementById('apptModalOverlay').classList.remove('open');
  document.body.style.overflow = '';
}

// Close on overlay click
document.getElementById('apptModalOverlay').addEventListener('click', function(e) {
  if (e.target === this) closeApptModal();
});

// Close on X button
document.getElementById('apptModalClose').addEventListener('click', closeApptModal);

// Close on Escape
document.addEventListener('keydown', e => {
  if (e.key === 'Escape') closeApptModal();
});

// AJAX Form Submit — saves to DB without page reload
document.getElementById('apptModalForm').addEventListener('submit', async function(e) {
  e.preventDefault();
  const btn = document.getElementById('apptModalSubmit');
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
      // Show success message
      document.getElementById('apptModalSuccess').style.display = 'flex';
      this.style.display = 'none';
      // Auto close after 3 seconds
      setTimeout(() => {
        closeApptModal();
        // Reset form
        this.reset();
        this.style.display = '';
        document.getElementById('apptModalSuccess').style.display = 'none';
        btn.innerHTML = '<i class="fas fa-calendar-check me-2"></i> CONFIRM APPOINTMENT';
        btn.disabled = false;
      }, 3000);
    } else {
      btn.innerHTML = '<i class="fas fa-calendar-check me-2"></i> CONFIRM APPOINTMENT';
      btn.disabled = false;
      alert(data.message || 'Something went wrong. Please try again.');
    }
  } catch (err) {
    btn.innerHTML = '<i class="fas fa-calendar-check me-2"></i> CONFIRM APPOINTMENT';
    btn.disabled = false;
    alert('Network error. Please try again.');
  }
});
</script>