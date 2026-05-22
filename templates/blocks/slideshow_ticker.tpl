<{if $block.items}>
<{assign var='ticker_id' value=$block.ticker_id}>

<div id="<{$ticker_id}>" class="ss-ticker-wrap"
     style="height:<{$block.height}>px; background:<{$block.bgcolor}>; color:<{$block.textcolor}>;">

    <{* Sol etiket bandı *}>
    <div class="ss-ticker-label" style="background:<{$block.labelcolor}>; height:<{$block.height}>px; line-height:<{$block.height}>px;">
        <{$block.label}>
    </div>

    <{* Kayan alan *}>
    <div class="ss-ticker-viewport">
        <div class="ss-ticker-track" id="<{$ticker_id}>-track">
        <{* İki kopya — sonsuz döngü için *}>
        <{section name=copy loop=2}>
            <{foreach item=item from=$block.items}>
                <span class="ss-ticker-item">
                    <{if $item.item_link}>
                    <a href="<{$item.item_link}>"
                       target="<{if $item.item_linktarget==1}>_blank<{else}>_self<{/if}>"
                       style="color:<{$block.textcolor}>; text-decoration:none;">
                    <{/if}>
                    <{$item.item_title}>
                    <{if $item.item_link}></a><{/if}>
                    <span class="ss-ticker-sep" style="color:<{$block.labelcolor}>;"><{$block.separator}></span>
                </span>
            <{/foreach}>
        <{/section}>
        </div>
    </div>
</div>

<style>
#<{$ticker_id}> {
    display: flex;
    align-items: center;
    width: 100%;
    overflow: hidden;
    box-sizing: border-box;
    font-size: .85rem;
    font-family: inherit;
}
#<{$ticker_id}> .ss-ticker-label {
    flex: 0 0 auto;
    padding: 0 14px;
    font-weight: 700;
    font-size: .8rem;
    letter-spacing: .06em;
    text-transform: uppercase;
    color: #fff;
    white-space: nowrap;
    z-index: 1;
    position: relative;
}
#<{$ticker_id}> .ss-ticker-label::after {
    content: '';
    position: absolute;
    right: -10px; top: 0; bottom: 0;
    border-left: 10px solid <{$block.labelcolor}>;
    border-top: <{$block.height}>px solid transparent;
    /* ok şeklinde kenar */
}
#<{$ticker_id}> .ss-ticker-viewport {
    flex: 1;
    overflow: hidden;
    height: 100%;
    display: flex;
    align-items: center;
}
#<{$ticker_id}> .ss-ticker-track {
    display: flex;
    align-items: center;
    white-space: nowrap;
    will-change: transform;
}
#<{$ticker_id}> .ss-ticker-item {
    padding: 0 4px;
    font-size: .85rem;
}
#<{$ticker_id}> .ss-ticker-item a:hover {
    text-decoration: underline !important;
}
#<{$ticker_id}> .ss-ticker-sep {
    font-size: .8em;
}
</style>

<script>
(function(){
    var wrap  = document.getElementById('<{$ticker_id}>');
    var track = document.getElementById('<{$ticker_id}>-track');
    if (!wrap || !track) return;

    var speed      = <{$block.speed}>;   // px per second
    var pauseHover = <{$block.pauseonhover}>;
    var paused     = false;
    var offset     = 0;
    var last       = null;
    var halfWidth  = 0;

    function getHalfWidth() {
        return track.scrollWidth / 2;
    }

    function tick(ts) {
        if (last === null) last = ts;
        var delta = (ts - last) / 1000;
        last = ts;

        if (!paused) {
            offset += speed * delta;
            halfWidth = getHalfWidth();
            if (offset >= halfWidth) offset -= halfWidth;
            track.style.transform = 'translateX(-' + offset + 'px)';
        }
        requestAnimationFrame(tick);
    }

    if (pauseHover) {
        wrap.addEventListener('mouseenter', function(){ paused = true; });
        wrap.addEventListener('mouseleave', function(){ paused = false; last = null; });
    }

    requestAnimationFrame(tick);
})();
</script>
<{/if}>
