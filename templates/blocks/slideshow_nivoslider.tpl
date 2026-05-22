<{if $block.showtype == 'nivo' && $block.items}>
<div class="slider-wrapper theme-<{$block.sliderstyle}>">
<div id="slider" class="nivoSlider">

<{foreach item=item from=$block.items}>
    <{* ── YouTube ── *}>
    <{if $item.item_type == 'youtube' && $item.embed_url}>
        <div class="slideshow-video-wrap">
            <{if $item.item_link}><a href="<{$item.item_link}>" target="<{if $item.item_linktarget==1}>_blank<{else}>_self<{/if}>"><{/if}>
            <iframe src="<{$item.embed_url}>" width="<{$block.imagewidth}>" height="<{$block.imageheight}>"
                    frameborder="0" allowfullscreen title="<{$item.item_title|escape}>"></iframe>
            <{if $item.item_link}></a><{/if}>
        </div>
    <{* ── Vimeo ── *}>
    <{elseif $item.item_type == 'vimeo' && $item.embed_url}>
        <div class="slideshow-video-wrap">
            <{if $item.item_link}><a href="<{$item.item_link}>" target="<{if $item.item_linktarget==1}>_blank<{else}>_self<{/if}>"><{/if}>
            <iframe src="<{$item.embed_url}>" width="<{$block.imagewidth}>" height="<{$block.imageheight}>"
                    frameborder="0" allowfullscreen title="<{$item.item_title|escape}>"></iframe>
            <{if $item.item_link}></a><{/if}>
        </div>
    <{* ── Image ── *}>
    <{else}>
        <{if $item.item_languagecode}>[<{$item.item_languagecode}>]<{/if}>
        <{if $item.item_link}>
            <a target="<{if $item.item_linktarget==1}>_blank<{else}>_self<{/if}>"
               title="<{$item.item_title|escape}>" href="<{$item.item_link}>">
        <{/if}>
        <{if $block.displaycaption == 1 && $item.item_caption}>
            <img title="#<{$item.item_id}>" class="img-fluid"
                 width="<{$block.imagewidth}>" height="<{$block.imageheight}>"
                 src="<{$item.imgurl}>" alt="<{$item.item_title|escape}>" loading="lazy" />
        <{else}>
            <img class="img-fluid"
                 width="<{$block.imagewidth}>" height="<{$block.imageheight}>"
                 src="<{$item.imgurl}>" alt="<{$item.item_title|escape}>" loading="lazy" />
        <{/if}>
        <{if $item.item_link}></a><{/if}>
        <{if $item.item_languagecode}>[/<{$item.item_languagecode}>]<{/if}>
    <{/if}>
<{/foreach}>

</div>

<{foreach item=item from=$block.items}>
    <{if $item.item_caption}>
        <div id="<{$item.item_id}>" class="nivo-html-caption"><{$item.item_caption}></div>
    <{/if}>
<{/foreach}>

</div>
<{/if}>
