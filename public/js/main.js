/* Picklymart storefront JS — no build step required (XAMPP friendly) */
document.addEventListener('DOMContentLoaded', function () {

    /* Header search toggle */
    var searchBtn = document.getElementById('searchToggle');
    var searchInput = document.getElementById('headerSearch');
    if (searchBtn && searchInput) {
        searchBtn.addEventListener('click', function (e) {
            if (!searchInput.classList.contains('open')) {
                e.preventDefault();
                searchInput.classList.add('open');
                searchInput.focus();
            } else if (searchInput.value.trim() !== '') {
                window.location.href = '/search?q=' + encodeURIComponent(searchInput.value.trim());
            }
        });
        searchInput.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' && searchInput.value.trim() !== '') {
                window.location.href = '/search?q=' + encodeURIComponent(searchInput.value.trim());
            }
        });
    }

    /* Simple horizontal carousels */
    document.querySelectorAll('[data-carousel]').forEach(function (wrap) {
        var track = wrap.querySelector('.carousel-track');
        if (!track) return;
        wrap.querySelectorAll('[data-dir]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var step = track.clientWidth * 0.6;
                track.scrollBy({ left: btn.dataset.dir === 'next' ? step : -step, behavior: 'smooth' });
            });
        });
    });

    /* Product page: quantity stepper + total price */
    var qtyInput = document.getElementById('qtyInput');
    if (qtyInput) {
        var unitPrice = parseFloat(qtyInput.dataset.price || 0);
        var totalEl = document.getElementById('totalPrice');
        var sync = function () {
            var q = Math.max(1, parseInt(qtyInput.value || 1, 10));
            if (totalEl) totalEl.textContent = '৳' + (unitPrice * q).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        };
        document.querySelectorAll('[data-step]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var q = Math.max(1, parseInt(qtyInput.value || 1, 10)) + (btn.dataset.step === 'plus' ? 1 : -1);
                qtyInput.value = Math.max(1, q);
                sync();
            });
        });
        qtyInput.addEventListener('input', sync);
        sync();
    }

    /* Product page: gallery thumbnails */
    var mainImg = document.getElementById('pdpMainImg');
    if (mainImg) {
        document.querySelectorAll('.pdp-thumbs img').forEach(function (t) {
            t.addEventListener('click', function () {
                mainImg.src = t.dataset.full || t.src;
                document.querySelectorAll('.pdp-thumbs img').forEach(function (x) { x.classList.remove('active'); });
                t.classList.add('active');
            });
        });
    }

    /* Rating picker */
    var rateSelect = document.getElementById('rateSelect');
    if (rateSelect) {
        rateSelect.addEventListener('change', function () {
            document.querySelectorAll('.rate-stars-preview').forEach(function (el) {
                var v = parseInt(rateSelect.value, 10) || 0;
                el.textContent = '★★★★★'.slice(0, v) + '☆☆☆☆☆'.slice(0, 5 - v);
            });
        });
    }
});
