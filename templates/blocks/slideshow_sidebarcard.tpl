<{if $block.items}>
<{assign var='sc_id' value=$block.sc_id}>

<div id="<{$sc_id}>-wrap" class="ss-sc-wrap" style="max-width:<{$block.cardwidth}>px;">

    <div id="<{$sc_id}>" class="swiper ss-sc-swiper">
        <div class="swiper-wrapper">
        <{foreach item=item from=$block.items}>
            <div class="swiper-slide ss-sc-slide">
                <{* Thumbnail *}>
                <div class="ss-sc-thumb">
                    <{if $item.item_link}>
                    <a href="<{$item.item_link}>" target="<{if $item.item_linktarget==1}>_blank<{else}>_self<{/if}>">
                    <{/if}>
                    <img src="<{$item.imgurl}>"
                         alt="<{$item.item_title|escape}>"
                         loading="lazy"
                         style="width:<{$block.thumbsize}>px;height:<{$block.thumbsize}>px;" />
                    <{if $item.item_link}></a><{/if}>
                </div>

                <{* Metin *}>
                <div class="ss-sc-text">
                    <{if $item.item_link}>
                    <a class="ss-sc-title" href="<{$item.item_link}>" target="<{if $item.item_linktarget==1}>_blank<{else}>_self<{/if}>">
                        <{$item.item_title|truncate:55:'...'}>
                    </a>
                    <{else}>
                    <span class="ss-sc-title"><{$item.item_title|truncate:55:'...'}></span>
                    <{/if}>

                    <{if $block.displaycaption == 1 && $item.item_caption}>
                    <p class="ss-sc-caption"><{$item.item_caption|truncate:80:'...'}></p>
                    <{/if}>
                </div>
            </div>
        <{/foreach}>
        </div>

        <{* Progress bar yerine mini ok navigasyon *}>
        <div class="ss-sc-controls">
            <button class="ss-sc-btn ss-sc-prev">&#8592;</button>
            <div class="ss-sc-progress"><div class="ss-sc-progress-bar"></div></div>
            <button class="ss-sc-btn ss-sc-next">&#8594;</button>
        </div>
    </div>
</div>

<style>
#<{$sc_id}>-wrap {
    width: 100%;
    font-family: inherit;
}
#<{$sc_id}> .ss-sc-slide {
    display: flex !important;
    align-items: center;
    gap: 12px;
    padding: 10px 4px;
    border-bottom: 1px solid rgba(0,0,0,.08);
    height: auto !important;
    box-sizing: border-box;
}
#<{$sc_id}> .ss-sc-thumb {
    flex: 0 0 <{$block.thumbsize}>px;
}
#<{$sc_id}> .ss-sc-thumb img {
    object-fit: cover;
    border-radius: 4px;
    display: block;
    border-left: 3px solid <{$block.accentcolor}>;
    transition: transform .25s;
}
#<{$sc_id}> .ss-sc-thumb img:hover { transform: scale(1.04); }
#<{$sc_id}> .ss-sc-text {
    flex: 1 1 auto;
    min-width: 0;
}
#<{$sc_id}> .ss-sc-title {
    display: block;
    font-size: .9rem;
    font-weight: 600;
    color: #222;
    text-decoration: none;
    line-height: 1.35;
    margin-bottom: 4px;
    transition: color .2s;
}
#<{$sc_id}> a.ss-sc-title:hover { color: <{$block.accentcolor}>; }
#<{$sc_id}> .ss-sc-caption {
    font-size: .78rem;
    color: #777;
    margin: 0;
    line-height: 1.4;
}
#<{$sc_id}> .ss-sc-controls {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px 0 2px;
}
#<{$sc_id}> .ss-sc-btn {
    background: none;
    border: 1px solid #ddd;
    border-radius: 3px;
    padding: 2px 8px;
    cursor: pointer;
    font-size: 1rem;
    color: #555;
    transition: border-color .2s, color .2s;
}
#<{$sc_id}> .ss-sc-btn:hover { border-color: <{$block.accentcolor}>; color: <{$block.accentcolor}>; }
#<{$sc_id}> .ss-sc-progress {
    flex: 1;
    height: 3px;
    background: #eee;
    border-radius: 2px;
    overflow: hidden;
}
#<{$sc_id}> .ss-sc-progress-bar {
    height: 100%;
    background: <{$block.accentcolor}>;
    width: 0%;
    transition: width linear;
}
</style>

<script>
(function(){
    if (typeof Swiper === 'undefined') return;
    var delay  = <{$block.autoplaytime}>;
    var barEl  = document.querySelector('#<{$sc_id}> .ss-sc-progress-bar');

    function startBar(sw) {
        if (!barEl) return;
        barEl.style.transition = 'none';
        barEl.style.width = '0%';
        barEl.offsetHeight;
        barEl.style.transition = 'width ' + delay + 'ms linear';
        barEl.style.width = '100%';
    }

    var sw = new Swiper('#<{$sc_id}>', {
        direction: 'vertical',
        slidesPerView: 3,
        spaceBetween: 0,
        loop: true,
        speed: 500,
        <{if $block.autoplay == 1}>
        autoplay: { delay: delay, disableOnInteraction: false, pauseOnMouseEnter: true },
        <{/if}>
        on: {
            init: function(s) { startBar(s); },
            slideChange: function(s) { startBar(s); },
        }
    });

    document.querySelector('#<{$sc_id}> .ss-sc-prev').addEventListener('click', function(){ sw.slidePrev(); });
    document.querySelector('#<{$sc_id}> .ss-sc-next').addEventListener('click', function(){ sw.slideNext(); });
})();
</script>
<{/if}>
