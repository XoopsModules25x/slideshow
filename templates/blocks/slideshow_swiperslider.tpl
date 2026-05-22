<{if $block.items}>
<div id="<{$block.swiper_id}>" class="swiper slideshow-swiper"
     style="width:<{$block.slidewidth}>px; max-width:100%; height:<{$block.slideheight}>px;">
    <div class="swiper-wrapper">
    <{foreach item=item from=$block.items}>
        <div class="swiper-slide">

            <{* ── YouTube embed ───────────────────────────────────── *}>
            <{if $item.item_type == 'youtube' && $item.embed_url}>
                <div class="slideshow-video-wrap">
                    <{if $item.item_link}>
                    <a href="<{$item.item_link}>" target="<{if $item.item_linktarget==1}>_blank<{else}>_self<{/if}>">
                    <{/if}>
                    <iframe class="slideshow-video"
                            src="<{$item.embed_url}>"
                            width="<{$block.imagewidth}>"
                            height="<{$block.imageheight}>"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen
                            title="<{$item.item_title|escape}>"></iframe>
                    <{if $item.item_link}></a><{/if}>
                </div>

            <{* ── Vimeo embed ─────────────────────────────────────── *}>
            <{elseif $item.item_type == 'vimeo' && $item.embed_url}>
                <div class="slideshow-video-wrap">
                    <{if $item.item_link}>
                    <a href="<{$item.item_link}>" target="<{if $item.item_linktarget==1}>_blank<{else}>_self<{/if}>">
                    <{/if}>
                    <iframe class="slideshow-video"
                            src="<{$item.embed_url}>"
                            width="<{$block.imagewidth}>"
                            height="<{$block.imageheight}>"
                            frameborder="0"
                            allow="autoplay; fullscreen; picture-in-picture"
                            allowfullscreen
                            title="<{$item.item_title|escape}>"></iframe>
                    <{if $item.item_link}></a><{/if}>
                </div>

            <{* ── Image ──────────────────────────────────────────── *}>
            <{else}>
                <{if $item.item_link}>
                <a href="<{$item.item_link}>"
                   target="<{if $item.item_linktarget==1}>_blank<{else}>_self<{/if}>"
                   title="<{$item.item_title|escape}>">
                <{/if}>
                <img class="slideshow-img img-fluid"
                     src="<{$item.imgurl}>"
                     width="<{$block.imagewidth}>"
                     height="<{$block.imageheight}>"
                     alt="<{$item.item_title|escape}>"
                     loading="lazy" />
                <{if $item.item_link}></a><{/if}>
            <{/if}>

            <{* ── Caption overlay ────────────────────────────────── *}>
            <{if $block.displaycaption == 1 && $item.item_caption}>
            <div class="slideshow-caption"><{$item.item_caption}></div>
            <{/if}>

        </div>
    <{/foreach}>
    </div>

    <{if $block.navigation == 1}>
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
    <{/if}>

    <{if $block.pagination == 1}>
    <div class="swiper-pagination"></div>
    <{/if}>
</div>

<style>
#<{$block.swiper_id}> { position:relative; overflow:hidden; }
#<{$block.swiper_id}> .swiper-slide { display:flex; align-items:center; justify-content:center; background:#000; position:relative; }
#<{$block.swiper_id}> .slideshow-img { width:100%; height:100%; object-fit:cover; display:block; }
#<{$block.swiper_id}> .slideshow-video-wrap { width:100%; height:100%; display:flex; align-items:center; justify-content:center; }
#<{$block.swiper_id}> .slideshow-video { max-width:100%; max-height:100%; }
#<{$block.swiper_id}> .slideshow-caption {
    position:absolute; bottom:0; left:0; right:0;
    background:rgba(0,0,0,.55); color:#fff;
    padding:8px 14px; font-size:.9em; text-align:center;
}
</style>

<script>
(function() {
    var el = document.getElementById('<{$block.swiper_id}>');
    if (!el || typeof Swiper === 'undefined') { return; }
    var opts = {
        effect:     '<{$block.sliderstyle}>',
        loop:       <{if $block.loop == 1}>true<{else}>false<{/if}>,
        speed:      600,
        <{if $block.autoplay == 1}>
        autoplay:   { delay: <{$block.autoplaytime}>, disableOnInteraction: false, pauseOnMouseEnter: true },
        <{/if}>
        <{if $block.navigation == 1}>
        navigation: { nextEl: '#<{$block.swiper_id}> .swiper-button-next', prevEl: '#<{$block.swiper_id}> .swiper-button-prev' },
        <{/if}>
        <{if $block.pagination == 1}>
        pagination: { el: '#<{$block.swiper_id}> .swiper-pagination', clickable: true },
        <{/if}>
        // Pause autoplay when a video slide becomes active
        on: {
            slideChange: function() {
                var active = el.querySelector('.swiper-slide-active');
                if (!active) { return; }
                var iframes = active.querySelectorAll('iframe');
                iframes.forEach(function(f) {
                    // reload src to reset video
                    var src = f.src;
                    f.src = '';
                    f.src = src;
                });
            }
        }
    };
    // cube / cards / flip require slidesPerView:1
    if (['cube','cards','flip'].indexOf('<{$block.sliderstyle}>') !== -1) {
        opts.grabCursor = true;
    }
    new Swiper('#<{$block.swiper_id}>', opts);
})();
</script>
<{/if}>
