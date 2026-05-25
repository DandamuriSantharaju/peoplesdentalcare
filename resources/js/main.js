
document.addEventListener('DOMContentLoaded', () => {


const teamTexts = document.querySelectorAll(
  '.team-heading-wrap .section-tag, .team-main-title, .team-main-sub'
);

const teamCards = document.querySelectorAll('.team-card-new');


const teamTextObserver = new IntersectionObserver((entries) => {

  entries.forEach(entry => {

    if (entry.isIntersecting) {

      entry.target.classList.add('show-team-text');

    }

  });

}, {
  threshold: 0.2
});

teamTexts.forEach(text => {
  teamTextObserver.observe(text);
});


const teamCardObserver = new IntersectionObserver((entries) => {

  entries.forEach(entry => {

    if (entry.isIntersecting) {

      teamCards.forEach((card, index) => {

        setTimeout(() => {

          card.classList.add('show-team-card');

        }, index * 250);

      });

    }

  });

}, {
  threshold: 0.2
});

const teamSection = document.querySelector('.team-section');

if (teamSection) {
  teamCardObserver.observe(teamSection);
}


const testiTexts = document.querySelectorAll(
  '.section-tag, .testimonials-title, .testimonials-sub'
);

const testiObserver = new IntersectionObserver((entries) => {

  entries.forEach(entry => {

    if (entry.isIntersecting) {

      entry.target.classList.add('show-text');

    }

  });

}, {
  threshold: 0.2
});

testiTexts.forEach(text => {
  testiObserver.observe(text);
});


const bentoCards = document.querySelectorAll('.bento-card');

const bentoObserver = new IntersectionObserver((entries) => {

  entries.forEach(entry => {

    if(entry.isIntersecting){

      entry.target.classList.add('show-card');

    }

  });

}, {
  threshold: 0.15
});

bentoCards.forEach(card => {
  bentoObserver.observe(card);
});


const aboutElements = document.querySelectorAll(
  '.wl-img-box, .wl-badges, .wl-videos, .welcome-content, .welcome-side-img'
);

function revealOnScroll() {

  const triggerBottom = window.innerHeight * 0.85;

  aboutElements.forEach(el => {

    const rect = el.getBoundingClientRect();

    if (rect.top < triggerBottom && rect.bottom > 0) {

      el.classList.add('wl-animate');

    } else {

      el.classList.remove('wl-animate');

    }

  });

}

window.addEventListener('scroll', revealOnScroll);

revealOnScroll();

  const apptSubmitBtn = document.getElementById('apptSubmitBtn');
  if (apptSubmitBtn) {
    apptSubmitBtn.addEventListener('click', () => {
      const inputs = document.querySelectorAll('.appt-input');
      let valid = true;

      inputs.forEach(input => {
        if (input.tagName !== 'TEXTAREA' && !input.value.trim()) {
          input.style.borderColor = '#ef4444';
          valid = false;
        } else {
          input.style.borderColor = 'rgba(255,255,255,0.18)';
        }
      });

      if (valid) {
        apptSubmitBtn.innerHTML = '✓ Appointment Confirmed!';
        apptSubmitBtn.style.background = '#16a34a';
        setTimeout(() => {
          apptSubmitBtn.innerHTML = 'CONFIRM APPOINTMENT <i class="fas fa-arrow-right ms-2"></i>';
          apptSubmitBtn.style.background = '';
          inputs.forEach(i => i.value = '');
        }, 3000);
      }
    });
  }

  const statNums = document.querySelectorAll('.stat-num');

  function formatNum(val, target) {
    if (target >= 1000) {
      return (val / 1000).toFixed(1) + 'K';
    }
    return Math.floor(val);
  }

  function animateCounter(el) {
    const target = parseInt(el.getAttribute('data-target'));
    const duration = 2000;
    const steps = 60;
    const increment = target / steps;
    let current = 0;
    let step = 0;

    const timer = setInterval(() => {
      step++;
      current += increment;

      if (step >= steps) {
        current = target;
        clearInterval(timer);
      }

      el.textContent = formatNum(current, target);
    }, duration / steps);
  }

  const statsObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const nums = entry.target.querySelectorAll('.stat-num');
        nums.forEach(num => animateCounter(num));
        statsObserver.unobserve(entry.target);
      }
    });
  }, { threshold: 0.4 });

  const statsSection = document.querySelector('.stats-section');
  if (statsSection) statsObserver.observe(statsSection);

const navbar = document.querySelector('.main-navbar');

window.addEventListener('scroll', () => {
  if (!navbar) return;
  if (window.scrollY > 60) {
    navbar.classList.add('scrolled');
  } else {
    navbar.classList.remove('scrolled');
  }
});

  const targets = document.querySelectorAll(
    '.service-card, .testimonial-card, .team-card, .blog-card, .about-feat, .stat-box, .wl-reveal'
  );

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry, i) => {
      if (entry.isIntersecting) {
        setTimeout(() => {
          entry.target.classList.add('in-view');
        }, i * 100);

        observer.unobserve(entry.target);
      }
    });
  }, {
    threshold: 0.1
  });

  targets.forEach(el => {
    observer.observe(el);
  });

  const sections = document.querySelectorAll('section[id], footer[id]');
  const navLinks = document.querySelectorAll('.nav-link');

  const scrollSpy = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {

        navLinks.forEach(link => {
          link.classList.remove('active');

          if (link.getAttribute('href') === '#' + entry.target.id) {
            link.classList.add('active');
          }
        });

      }
    });
  }, {
    threshold: 0.35
  });

  sections.forEach(section => {
    scrollSpy.observe(section);
  });

  const apptBtn = document.querySelector('.appoint-form .btn-primary-custom');

  if (apptBtn) {

    apptBtn.addEventListener('click', () => {

      const inputs = document.querySelectorAll('.appoint-form .custom-input');

      let valid = true;

      inputs.forEach(input => {

        if (!input.value.trim()) {
          input.style.borderColor = '#ef4444';
          valid = false;
        } else {
          input.style.borderColor = '';
        }

      });

      if (valid) {

        apptBtn.innerHTML = '✓ Appointment Confirmed!';
        apptBtn.style.background = '#16a34a';

        setTimeout(() => {

          apptBtn.innerHTML =
            'Confirm Appointment <i class="fas fa-arrow-right ms-2"></i>';

          apptBtn.style.background = '';

          inputs.forEach(input => {
            input.value = '';
          });

        }, 3000);

      }

    });

  }

  // ---- Back To Top Button ----
  const backBtn = document.createElement('a');

  backBtn.href = '#';
  backBtn.className = 'back-to-top';

  backBtn.innerHTML = '<i class="fas fa-arrow-up"></i>';

  backBtn.style.cssText = `
    position: fixed;
    bottom: 24px;
    right: 24px;
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background: #033C67;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    font-size: 0.9rem;
    box-shadow: 0 4px 16px rgba(26,58,92,0.30);
    opacity: 0;
    pointer-events: none;
    transition: all 0.3s ease;
    z-index: 999;
  `;

  document.body.appendChild(backBtn);

  window.addEventListener('scroll', () => {

    if (window.scrollY > 300) {
      backBtn.style.opacity = '1';
      backBtn.style.pointerEvents = 'auto';
    } else {
      backBtn.style.opacity = '0';
      backBtn.style.pointerEvents = 'none';
    }

  });

  backBtn.addEventListener('click', (e) => {

    e.preventDefault();

    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });

  });

});

/* ============================================
   TESTIMONIALS CAROUSEL
   ============================================ */
(function () {
  const reviews = [
    { name: "Robert Wilson",   text: "I've been to the dentist several times so I know the drill. But Peoples Dental Care is truly different — the team is warm, professional, and genuinely caring. My anxiety was put to rest instantly and the treatment was completely painless. Highly recommend to anyone looking for trusted dental care!" },
    { name: "Priya Sharma",    text: "The clinic is immaculate, well-equipped and the doctors are incredibly knowledgeable. I came in for a root canal and was nervous, but Dr. Anil made the whole experience comfortable and stress-free. The staff is friendly and the appointment process is seamless. Will definitely be coming back!" },
    { name: "Rahul Mehta",     text: "Outstanding service and excellent results! I got my teeth whitening done here and I couldn't be happier with the outcome. The procedure was safe, quick, and the improvement was remarkable. The doctors explained every step clearly and made sure I was comfortable throughout. 10/10 experience!" },
    { name: "Ananya Reddy",    text: "Best dental clinic in Hyderabad! Dr. Meena handled my child's first dental visit with such patience and kindness. The paediatric care here is exceptional. No tears, no fear — just smiles! The waiting area is child-friendly and the overall environment is very welcoming." },
    { name: "Suresh Babu",     text: "I had my dental implants done here and the results are absolutely fantastic. The procedure was smooth and the recovery was quick. The doctors are highly skilled and use the latest technology. I can eat, speak and smile confidently now. Thank you Peoples Dental Care!" },
    { name: "Kavitha Nair",    text: "Very professional team and excellent dental care. I had orthodontic treatment done here and the results exceeded my expectations. The doctor monitored my progress regularly and always ensured I was comfortable. The clinic is hygienic and modern. Truly the best dental clinic!" },
  ];

  const track  = document.getElementById('testiTrack');
  const dotsEl = document.getElementById('testiDots');
  if (!track || !dotsEl) return;

  let current = 0;

  function isMobile() { return window.innerWidth < 768; }
  function perSlide()  { return isMobile() ? 1 : 3; }
  function totalSlides(){ return Math.ceil(reviews.length / perSlide()); }

  function render() {
    const per   = perSlide();
    const total = totalSlides();
    const slice = reviews.slice(current * per, current * per + per);

    track.style.gridTemplateColumns = isMobile() ? '1fr' : 'repeat(3,1fr)';
    track.innerHTML = slice.map(r => `
      <div class="testi-card">
        <h5>${r.name}</h5>
        <div class="testi-stars">★★★★★</div>
        <p>"${r.text}"</p>
      </div>
    `).join('');

    dotsEl.innerHTML = '';
    for (let i = 0; i < total; i++) {
      const btn = document.createElement('button');
      btn.className = 'testi-dot' + (i === current ? ' active' : '');
      btn.setAttribute('aria-label', 'Slide ' + (i + 1));
      btn.addEventListener('click', () => { current = i; render(); });
      dotsEl.appendChild(btn);
    }
  }

  render();
  setInterval(() => {
    current = (current + 1) % totalSlides();
    render();
  }, 3000);

  window.addEventListener('resize', render);
})();