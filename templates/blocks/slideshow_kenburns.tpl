<{if $block.items}>
<{assign var='kb_id' value=$block.kb_id}>
<{assign var='total'  value=$block.items|count}>

<div id="<{$kb_id}>" class="ss-kb-wrap" style="height:<{$block.height}>px;">

    <{* ── Slide'lar ─────────────────────────────────────────── *}>
    <{foreach item=item from=$block.items name=kbloop}>
    <div class="ss-kb-slide<{if $smarty.foreach.kbloop.first}> active<{/if}>"
         data-src="<{$item.imgurl}>"
         data-link="<{$item.item_link}>"
         data-target="<{if $item.item_linktarget==1}>_blank<{else}>_self<{/if}>"
         data-title="<{$item.item_title|escape}>"
         data-caption="<{$item.item_caption|escape}>">
    </div>
    <{/foreach}>

    <{* ── Overlay ───────────────────────────────────────────── *}>
    <{if $block.overlay != 'none'}>
    <div class="ss-kb-overlay ss-kb-overlay-<{$block.overlay}>"></div>
    <{/if}>

    <{* ── İçerik (başlık + buton) ───────────────────────────── *}>
    <div class="ss-kb-content">
        <div class="ss-kb-text">
            <h2 class="ss-kb-title"></h2>
            <p class="ss-kb-caption"></p>
            <{if $block.showbutton == 1}>
            <a class="ss-kb-btn" href="#" target="_self"><{$block.buttontext}></a>
            <{/if}>
        </div>
    </div>

    <{* ── Navigation ────────────────────────────────────────── *}>
    <button class="ss-kb-nav ss-kb-prev" aria-label="Önceki">&#8249;</button>
    <button class="ss-kb-nav ss-kb-next" aria-label="Sonraki">&#8250;</button>

    <{* ── Dots ──────────────────────────────────────────────── *}>
    <div class="ss-kb-dots">
        <{section name=d loop=$total}>
        <span class="ss-kb-dot<{if $smarty.section.d.first}> active<{/if}>"></span>
        <{/section}>
    </div>
</div>

<style>
#<{$kb_id}> {
    position: relative;
    width: 100%;
    overflow: hidden;
    background: #000;
    font-family: inherit;
}
#<{$kb_id}> .ss-kb-slide {
    position: absolute;
    inset: 0;
    background-size: cover;
    background-position: center;
    opacity: 0;
    transition: opacity 1.2s ease;
    transform-origin: center;
}
#<{$kb_id}> .ss-kb-slide.active {
    opacity: 1;
    animation: ssKenBurns <{$block.autoplaytime}>ms ease-in-out forwards;
}
@keyframes ssKenBurns {
    0%   { transform: scale(1)    translate(0,0); }
    50%  { transform: scale(1.08) translate(-1%,-1%); }
    100% { transform: scale(1.12) translate(1%,1%); }
}
#<{$kb_id}> .ss-kb-overlay { position:absolute; inset:0; pointer-events:none; }
#<{$kb_id}> .ss-kb-overlay-dark  { background: linear-gradient(135deg, rgba(0,0,0,.55) 0%, rgba(0,0,0,.2) 100%); }
#<{$kb_id}> .ss-kb-overlay-light { background: linear-gradient(135deg, rgba(255,255,255,.4) 0%, rgba(255,255,255,.1) 100%); }

#<{$kb_id}> .ss-kb-content {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    padding: 0 6%;
    z-index: 3;
}
#<{$kb_id}> .ss-kb-text { max-width: 560px; }
#<{$kb_id}> .ss-kb-title {
    color: #fff;
    font-size: clamp(1.4rem, 4vw, 2.6rem);
    font-weight: 700;
    margin: 0 0 10px;
    text-shadow: 0 2px 8px rgba(0,0,0,.6);
    opacity: 0;
    transform: translateY(20px);
    transition: opacity .7s .5s, transform .7s .5s;
}
#<{$kb_id}>.loaded .ss-kb-title { opacity: 1; transform: translateY(0); }
#<{$kb_id}> .ss-kb-caption {
    color: rgba(255,255,255,.88);
    font-size: clamp(.85rem, 2vw, 1.05rem);
    margin: 0 0 18px;
    text-shadow: 0 1px 4px rgba(0,0,0,.5);
    opacity: 0;
    transform: translateY(16px);
    transition: opacity .7s .75s, transform .7s .75s;
}
#<{$kb_id}>.loaded .ss-kb-caption { opacity: 1; transform: translateY(0); }
#<{$kb_id}> .ss-kb-btn {
    display: inline-block;
    background: #e74c3c;
    color: #fff;
    padding: 10px 28px;
    border-radius: 3px;
    text-decoration: none;
    font-size: .95rem;
    font-weight: 600;
    letter-spacing: .03em;
    opacity: 0;
    transform: translateY(14px);
    transition: opacity .7s 1s, transform .7s 1s, background .2s;
}
#<{$kb_id}> .ss-kb-btn:hover { background: #c0392b; }
#<{$kb_id}>.loaded .ss-kb-btn { opacity: 1; transform: translateY(0); }

#<{$kb_id}> .ss-kb-nav {
    position: absolute;
    top: 50%; transform: translateY(-50%);
    z-index: 4;
    background: rgba(0,0,0,.35);
    border: none;
    color: #fff;
    font-size: 2.2rem;
    line-height: 1;
    width: 48px; height: 48px;
    border-radius: 50%;
    cursor: pointer;
    transition: background .2s;
}
#<{$kb_id}> .ss-kb-nav:hover { background: rgba(0,0,0,.65); }
#<{$kb_id}> .ss-kb-prev { left: 16px; }
#<{$kb_id}> .ss-kb-next { right: 16px; }

#<{$kb_id}> .ss-kb-dots {
    position: absolute;
    bottom: 14px; left: 50%; transform: translateX(-50%);
    display: flex; gap: 7px; z-index: 4;
}
#<{$kb_id}> .ss-kb-dot {
    width: 8px; height: 8px;
    border-radius: 50%;
    background: rgba(255,255,255,.45);
    cursor: pointer;
    transition: background .3s, transform .3s;
}
#<{$kb_id}> .ss-kb-dot.active { background: #fff; transform: scale(1.3); }
@media (max-width:600px) {
    #<{$kb_id}> { height: 240px !important; }
    #<{$kb_id}> .ss-kb-title { font-size: 1.1rem; }
}
</style>

<script>
(function(){
    var wrap   = document.getElementById('<{$kb_id}>');
    if (!wrap) return;

    var slides   = wrap.querySelectorAll('.ss-kb-slide');
    var dots     = wrap.querySelectorAll('.ss-kb-dot');
    var titleEl  = wrap.querySelector('.ss-kb-title');
    var capEl    = wrap.querySelector('.ss-kb-caption');
    var btnEl    = wrap.querySelector('.ss-kb-btn');
    var current  = 0;
    var total    = slides.length;
    var timer    = null;
    var delay    = <{$block.autoplaytime}>;

    // Resimleri background olarak set et
    slides.forEach(function(s) {
        s.style.backgroundImage = 'url(' + s.dataset.src + ')';
    });

    function showSlide(idx) {
        slides[current].classList.remove('active');
        dots[current].classList.remove('active');
        wrap.classList.remove('loaded');

        current = (idx + total) % total;
        var s = slides[current];
        s.classList.add('active');
        dots[current].classList.add('active');

        // Ken Burns animasyonu yeniden tetikle
        s.style.animation = 'none';
        s.offsetHeight; // reflow
        s.style.animation = '';

        // İçerik güncelle
        if (titleEl) titleEl.textContent = s.dataset.title || '';
        if (capEl)   capEl.textContent   = s.dataset.caption || '';
        if (btnEl) {
            btnEl.href   = s.dataset.link   || '#';
            btnEl.target = s.dataset.target || '_self';
            btnEl.style.display = (s.dataset.link && s.dataset.link !== '') ? '' : 'none';
        }

        requestAnimationFrame(function(){ wrap.classList.add('loaded'); });
        resetTimer();
    }

    function resetTimer() {
        clearInterval(timer);
        timer = setInterval(function(){ showSlide(current + 1); }, delay);
    }

    wrap.querySelector('.ss-kb-prev').addEventListener('click', function(){ showSlide(current - 1); });
    wrap.querySelector('.ss-kb-next').addEventListener('click', function(){ showSlide(current + 1); });
    dots.forEach(function(d, i){ d.addEventListener('click', function(){ showSlide(i); }); });

    showSlide(0);
})();
</script>
<{/if}>
