/* ============================================
   PEOPLES DENTAL CARE — ADMIN PANEL JS
   Reusable for all admin pages
   ============================================ */

document.addEventListener('DOMContentLoaded', function () {

  // ── SIDEBAR MOBILE TOGGLE ──────────────────
  const sidebar        = document.querySelector('.sidebar');
  const sidebarOverlay = document.querySelector('.sidebar-overlay');
  const sidebarToggle  = document.querySelector('.sidebar-toggle');

  if (sidebarToggle) {
    sidebarToggle.addEventListener('click', function () {
      sidebar.classList.toggle('open');
      sidebarOverlay.classList.toggle('open');
    });
  }

  if (sidebarOverlay) {
    sidebarOverlay.addEventListener('click', function () {
      sidebar.classList.remove('open');
      sidebarOverlay.classList.remove('open');
    });
  }

  // ── AUTO HIDE ALERTS AFTER 4s ─────────────
  const alerts = document.querySelectorAll('.alert-success-custom, .alert-error-custom');
  alerts.forEach(alert => {
    setTimeout(() => {
      alert.style.transition = 'opacity 0.5s ease';
      alert.style.opacity    = '0';
      setTimeout(() => alert.remove(), 500);
    }, 4000);
  });

  // ── FILTER TABS ───────────────────────────
  window.filterTable = function(status, btn) {
    document.querySelectorAll('.filter-tab').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    document.querySelectorAll('#apptTable tbody tr[data-status]').forEach(row => {
      row.style.display = (status === 'all' || row.dataset.status === status) ? '' : 'none';
    });
  };

  // ── SEARCH INPUT ──────────────────────────
  const searchInput = document.getElementById('searchInput');
  if (searchInput) {
    searchInput.addEventListener('input', function () {
      const q = this.value.toLowerCase();
      document.querySelectorAll('#apptTable tbody tr[data-status]').forEach(row => {
        row.style.display = row.innerText.toLowerCase().includes(q) ? '' : 'none';
      });
    });
  }

  // ── MODAL OPEN / CLOSE ────────────────────
  window.openModal = function (overlayId) {
    document.getElementById(overlayId).classList.add('open');
    document.body.style.overflow = 'hidden';
  };

  window.closeModal = function (overlayId) {
    document.getElementById(overlayId).classList.remove('open');
    document.body.style.overflow = '';
  };

  // Close modal on overlay click
  document.querySelectorAll('.modal-overlay').forEach(overlay => {
    overlay.addEventListener('click', function (e) {
      if (e.target === this) {
        this.classList.remove('open');
        document.body.style.overflow = '';
      }
    });
  });

  // Close modal on Escape key
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
      document.querySelectorAll('.modal-overlay.open').forEach(overlay => {
        overlay.classList.remove('open');
        document.body.style.overflow = '';
      });
    }
  });

  // ── PASSWORD STRENGTH CHECKER ─────────────
  window.checkStrength = function (val) {
    const bar  = document.getElementById('pwdStrength');
    const hint = document.getElementById('pwdHint');
    if (!bar) return;
    if (!val) {
      bar.style.width = '0'; bar.style.background = '#e2e8f0';
      if (hint) hint.textContent = 'Enter a new password';
      return;
    }
    let score = 0;
    if (val.length >= 6)           score++;
    if (val.length >= 10)          score++;
    if (/[A-Z]/.test(val))         score++;
    if (/[0-9]/.test(val))         score++;
    if (/[^A-Za-z0-9]/.test(val))  score++;
    const levels = [
      { w: '20%', c: '#ef4444', t: 'Very Weak'   },
      { w: '40%', c: '#f97316', t: 'Weak'         },
      { w: '60%', c: '#eab308', t: 'Fair'          },
      { w: '80%', c: '#22c55e', t: 'Strong'        },
      { w: '100%',c: '#16a34a', t: 'Very Strong'  },
    ];
    const l = levels[score - 1] || levels[0];
    bar.style.width      = l.w;
    bar.style.background = l.c;
    if (hint) { hint.textContent = 'Password strength: ' + l.t; hint.style.color = l.c; }
  };

  // ── PASSWORD TOGGLE ───────────────────────
  window.toggleField = function (fieldId, iconId) {
    const f = document.getElementById(fieldId);
    const i = document.getElementById(iconId);
    if (!f || !i) return;
    if (f.type === 'password') { f.type = 'text';     i.className = 'fas fa-eye-slash'; }
    else                       { f.type = 'password'; i.className = 'fas fa-eye';       }
  };

  // ── IMAGE PREVIEW ─────────────────────────
  window.previewPhoto = function (input) {
    if (input.files && input.files[0]) {
      const reader      = new FileReader();
      const preview     = document.getElementById('editPhotoPreview');
      const placeholder = document.getElementById('editPhotoPlaceholder');
      reader.onload = e => {
        if (preview) { preview.src = e.target.result; preview.style.display = 'block'; }
        if (placeholder) placeholder.style.display = 'none';
      };
      reader.readAsDataURL(input.files[0]);
    }
  };

});