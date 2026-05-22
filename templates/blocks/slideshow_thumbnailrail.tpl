<{if $block.items}>
<{assign var='rail_id' value=$block.rail_id}>

<div id="<{$rail_id}>-wrap" class="ss-rail-wrap">

    <{* ── Ana (büyük) slider ──────────────────────────────── *}>
    <div id="<{$rail_id}>-main" class="swiper ss-rail-main">
        <div class="swiper-wrapper">
        <{foreach item=item from=$block.items}>
            <div class="swiper-slide">
                <{if $item.item_link}>
                <a href="<{$item.item_link}>" target="<{if $item.item_linktarget==1}>_blank<{else}>_self<{/if}>">
                <{/if}>
                <img src="<{$item.imgurl}>"
                     alt="<{$item.item_title|escape}>"
                     loading="lazy"
                     class="ss-rail-img" />
                <{if $item.item_link}></a><{/if}>

                <{if $block.displaycaption == 1 && ($item.item_title || $item.item_caption)}>
                <div class="ss-rail-caption">
                    <{if $item.item_title}><strong><{$item.item_title}></strong><{/if}>
                    <{if $item.item_caption}><p><{$item.item_caption}></p><{/if}>
                </div>
                <{/if}>
            </div>
        <{/foreach}>
        </div>
        <div class="swiper-button-prev ss-rail-prev"></div>
        <div class="swiper-button-next ss-rail-next"></div>
    </div>

    <{* ── Thumbnail rail (sağ dikey) ──────────────────────── *}>
    <div id="<{$rail_id}>-thumbs" class="swiper ss-rail-thumbs">
        <div class="swiper-wrapper">
        <{foreach item=item from=$block.items}>
            <div class="swiper-slide ss-rail-thumb-slide">
                <img src="<{$item.imgurl}>"
                     alt="<{$item.item_title|escape}>"
                     loading="lazy" />
                <span class="ss-rail-thumb-title"><{$item.item_title|truncate:30:'...'}></span>
            </div>
        <{/foreach}>
        </div>
    </div>

</div>

<style>
#<{$rail_id}>-wrap {
    display: flex;
    gap: 8px;
    width: 100%;
    max-width: 100%;
    align-items: flex-start;
}
#<{$rail_id}>-main {
    flex: 1 1 auto;
    height: <{$block.mainheight}>px;
    min-width: 0;
    border-radius: 6px;
    overflow: hidden;
    position: relative;
    background: #111;
}
#<{$rail_id}>-main .ss-rail-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}
#<{$rail_id}>-main .ss-rail-caption {
    position: absolute;
    bottom: 0; left: 0; right: 0;
    background: linear-gradient(transparent, rgba(0,0,0,.75));
    color: #fff;
    padding: 24px 16px 12px;
}
#<{$rail_id}>-main .ss-rail-caption strong { font-size: 1.05em; display: block; margin-bottom: 4px; }
#<{$rail_id}>-main .ss-rail-caption p { font-size: .85em; margin: 0; opacity: .85; }

#<{$rail_id}>-main .ss-rail-prev,
#<{$rail_id}>-main .ss-rail-next {
    --swiper-navigation-size: 22px;
    background: rgba(0,0,0,.45);
    border-radius: 50%;
    width: 38px; height: 38px;
    top: 50%;
}

#<{$rail_id}>-thumbs {
    flex: 0 0 <{$block.thumbwidth}>px;
    height: <{$block.mainheight}>px;
    overflow: hidden;
}
#<{$rail_id}>-thumbs .swiper-wrapper { flex-direction: column; }
#<{$rail_id}>-thumbs .ss-rail-thumb-slide {
    width: <{$block.thumbwidth}>px !important;
    height: <{$block.thumbheight}>px !important;
    cursor: pointer;
    border-radius: 4px;
    overflow: hidden;
    border: 2px solid transparent;
    transition: border-color .2s, opacity .2s;
    opacity: .6;
    position: relative;
    flex-shrink: 0;
}
#<{$rail_id}>-thumbs .ss-rail-thumb-slide img {
    width: 100%; height: 100%;
    object-fit: cover; display: block;
}
#<{$rail_id}>-thumbs .ss-rail-thumb-slide.swiper-slide-thumb-active {
    border-color: #e74c3c;
    opacity: 1;
}
#<{$rail_id}>-thumbs .ss-rail-thumb-title {
    position: absolute;
    bottom: 0; left: 0; right: 0;
    background: rgba(0,0,0,.55);
    color: #fff;
    font-size: .72em;
    padding: 2px 5px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
@media (max-width: 600px) {
    #<{$rail_id}>-wrap { flex-direction: column; }
    #<{$rail_id}>-thumbs { display: none; }
    #<{$rail_id}>-main { height: 200px; }
}
</style>

<script>
(function(){
    if (typeof Swiper === 'undefined') return;
    var thumbsSwiper = new Swiper('#<{$rail_id}>-thumbs', {
        direction: 'vertical',
        spaceBetween: 6,
        slidesPerView: 'auto',
        freeMode: true,
        watchSlidesProgress: true,
    });
    new Swiper('#<{$rail_id}>-main', {
        loop: true,
        speed: 600,
        <{if $block.autoplay == 1}>
        autoplay: { delay: <{$block.autoplaytime}>, disableOnInteraction: false, pauseOnMouseEnter: true },
        <{/if}>
        navigation: {
            nextEl: '#<{$rail_id}>-main .ss-rail-next',
            prevEl: '#<{$rail_id}>-main .ss-rail-prev',
        },
        thumbs: { swiper: thumbsSwiper },
    });
})();
</script>
<{/if}>
