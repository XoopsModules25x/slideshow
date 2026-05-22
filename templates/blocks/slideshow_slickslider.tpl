<{if $block.showtype == 'slick' && $block.items}>
<div class="slider <{$block.sliderstyle}> text-center">

<{foreach item=item from=$block.items}>
    <div>
        <{if $item.item_languagecode}>[<{$item.item_languagecode}>]<{/if}>

        <{* ── YouTube ── *}>
        <{if $item.item_type == 'youtube' && $item.embed_url}>
            <{if $item.item_link}><a href="<{$item.item_link}>" target="<{if $item.item_linktarget==1}>_blank<{else}>_self<{/if}>"><{/if}>
            <iframe src="<{$item.embed_url}>" width="<{$block.imagewidth}>" height="<{$block.imageheight}>"
                    frameborder="0" allowfullscreen title="<{$item.item_title|escape}>"></iframe>
            <{if $item.item_link}></a><{/if}>

        <{* ── Vimeo ── *}>
        <{elseif $item.item_type == 'vimeo' && $item.embed_url}>
            <{if $item.item_link}><a href="<{$item.item_link}>" target="<{if $item.item_linktarget==1}>_blank<{else}>_self<{/if}>"><{/if}>
            <iframe src="<{$item.embed_url}>" width="<{$block.imagewidth}>" height="<{$block.imageheight}>"
                    frameborder="0" allowfullscreen title="<{$item.item_title|escape}>"></iframe>
            <{if $item.item_link}></a><{/if}>

        <{* ── Image ── *}>
        <{else}>
            <{if $item.item_link}>
            <a target="<{if $item.item_linktarget==1}>_blank<{else}>_self<{/if}>"
               title="<{$item.item_title|escape}>" href="<{$item.item_link}>">
            <{/if}>
            <img title="<{$item.item_title|escape}>" class="img-fluid"
                 width="<{$block.imagewidth}>" height="<{$block.imageheight}>"
                 src="<{$item.imgurl}>" alt="<{$item.item_title|escape}>" loading="lazy" />
            <{if $item.item_link}></a><{/if}>
        <{/if}>

        <{if $block.displaycaption == 1 && $item.item_caption}><br><{$item.item_caption}><{/if}>
        <{if $item.item_languagecode}>[/<{$item.item_languagecode}>]<{/if}>
    </div>
<{/foreach}>

</div>
<{/if}>
