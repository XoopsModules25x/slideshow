<{if $block.items}>
<{assign var='mosaic_id' value=$block.mosaic_id}>

<div id="<{$mosaic_id}>" class="ss-mosaic-grid">
<{foreach item=item from=$block.items}>
    <div class="ss-mosaic-cell">
        <{if $item.item_link}>
        <a href="<{$item.item_link}>" target="<{if $item.item_linktarget==1}>_blank<{else}>_self<{/if}>" class="ss-mosaic-link">
        <{else}>
        <span class="ss-mosaic-link">
        <{/if}>
            <img src="<{$item.imgurl}>"
                 alt="<{$item.item_title|escape}>"
                 loading="lazy"
                 class="ss-mosaic-img" />

            <div class="ss-mosaic-overlay">
                <{if $block.displaycaption == 1}>
                <div class="ss-mosaic-info">
                    <strong class="ss-mosaic-title"><{$item.item_title}></strong>
                    <{if $item.item_caption}>
                    <span class="ss-mosaic-caption"><{$item.item_caption|truncate:80:'...'}></span>
                    <{/if}>
                </div>
                <{/if}>
            </div>
        <{if $item.item_link}></a><{else}></span><{/if}>
    </div>
<{/foreach}>
</div>

<style>
#<{$mosaic_id}> {
    display: grid;
    grid-template-columns: repeat(<{$block.columns}>, 1fr);
    gap: <{$block.gap}>px;
    width: 100%;
}
#<{$mosaic_id}> .ss-mosaic-cell {
    position: relative;
    height: <{$block.cellheight}>px;
    overflow: hidden;
    border-radius: 4px;
    background: #111;
}
#<{$mosaic_id}> .ss-mosaic-link {
    display: block;
    width: 100%; height: 100%;
    text-decoration: none;
}
#<{$mosaic_id}> .ss-mosaic-img {
    width: 100%; height: 100%;
    object-fit: cover;
    display: block;
    transition: transform .45s ease;
}
#<{$mosaic_id}> .ss-mosaic-cell:hover .ss-mosaic-img {
    transform: scale(1.08);
}
#<{$mosaic_id}> .ss-mosaic-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(transparent 40%, rgba(0,0,0,.72) 100%);
    opacity: 0;
    transition: opacity .35s;
    display: flex;
    align-items: flex-end;
    padding: 12px;
    box-sizing: border-box;
}
#<{$mosaic_id}> .ss-mosaic-cell:hover .ss-mosaic-overlay { opacity: 1; }
#<{$mosaic_id}> .ss-mosaic-info { width: 100%; }
#<{$mosaic_id}> .ss-mosaic-title {
    display: block;
    color: #fff;
    font-size: .9rem;
    font-weight: 700;
    margin-bottom: 3px;
    line-height: 1.3;
    border-left: 3px solid <{$block.hovercolor}>;
    padding-left: 7px;
}
#<{$mosaic_id}> .ss-mosaic-caption {
    display: block;
    color: rgba(255,255,255,.8);
    font-size: .78rem;
    padding-left: 10px;
    line-height: 1.4;
}
@media (max-width: 600px) {
    #<{$mosaic_id}> { grid-template-columns: repeat(2, 1fr); }
    #<{$mosaic_id}> .ss-mosaic-cell { height: 120px; }
}
</style>
<{/if}>
