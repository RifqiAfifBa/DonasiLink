<div id="imageLightbox"
     class="fixed inset-0 z-[70] hidden items-center justify-center p-4 sm:p-8 bg-ink-900/85 backdrop-blur-md opacity-0 transition-opacity duration-300"
     role="dialog" aria-modal="true" aria-label="Pratinjau gambar">

    <button type="button" data-lightbox-close aria-label="Tutup"
            class="absolute top-4 right-4 z-10 w-11 h-11 rounded-full flex items-center justify-center text-white bg-white/10 hover:bg-white/20 backdrop-blur-sm transition-colors">
        <i class="fas fa-times text-lg"></i>
    </button>

    <a id="lightboxDownload" href="#" download target="_blank" aria-label="Unduh gambar"
       class="absolute top-4 right-16 z-10 w-11 h-11 rounded-full flex items-center justify-center text-white bg-white/10 hover:bg-white/20 backdrop-blur-sm transition-colors">
        <i class="fas fa-arrow-down text-base"></i>
    </a>

    <div id="lightboxCard" class="relative max-w-5xl w-full max-h-full flex flex-col items-center scale-95 opacity-0 transition-all duration-300">
        <img id="lightboxImage" src="" alt="" class="max-w-full max-h-[80vh] rounded-2xl shadow-2xl object-contain bg-ink-800 ring-1 ring-white/10">
        <div id="lightboxCaption" class="hidden mt-4 max-w-2xl px-4 py-2.5 rounded-xl bg-white/10 backdrop-blur-md text-center text-sm text-white"></div>
    </div>
</div>

<script>
(function() {
    const overlay   = document.getElementById('imageLightbox');
    const card      = document.getElementById('lightboxCard');
    const img       = document.getElementById('lightboxImage');
    const caption   = document.getElementById('lightboxCaption');
    const download  = document.getElementById('lightboxDownload');

    function open(src, alt, captionText) {
        img.src = src;
        img.alt = alt || '';
        download.href = src;
        if (captionText) {
            caption.textContent = captionText;
            caption.classList.remove('hidden');
        } else {
            caption.classList.add('hidden');
        }
        overlay.classList.remove('hidden');
        overlay.classList.add('flex');
        document.body.style.overflow = 'hidden';
        requestAnimationFrame(() => {
            overlay.classList.replace('opacity-0', 'opacity-100');
            card.classList.replace('scale-95', 'scale-100');
            card.classList.replace('opacity-0', 'opacity-100');
        });
    }

    function close() {
        overlay.classList.replace('opacity-100', 'opacity-0');
        card.classList.replace('scale-100', 'scale-95');
        card.classList.replace('opacity-100', 'opacity-0');
        setTimeout(() => {
            overlay.classList.add('hidden');
            overlay.classList.remove('flex');
            document.body.style.overflow = '';
            img.src = '';
        }, 280);
    }

    // Delegate clicks on [data-lightbox] anywhere in document
    document.addEventListener('click', (e) => {
        const trigger = e.target.closest('[data-lightbox]');
        if (!trigger) return;
        e.preventDefault();
        const src = trigger.dataset.lightbox || trigger.getAttribute('href');
        if (!src) return;
        open(src, trigger.dataset.lightboxAlt || trigger.querySelector('img')?.alt || '', trigger.dataset.lightboxCaption || '');
    });

    overlay.addEventListener('click', (e) => {
        if (e.target === overlay || e.target.hasAttribute('data-lightbox-close') || e.target.closest('[data-lightbox-close]')) {
            close();
        }
    });
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !overlay.classList.contains('hidden')) close();
    });

    window.DonasiLink = window.DonasiLink || {};
    window.DonasiLink.openLightbox = open;
})();
</script>
