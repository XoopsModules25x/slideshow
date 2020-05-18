<{if $block.showtype == 'marquee'}>
<{include file='db:blocks/slideshow_marqueeslider.tpl'}>
<{elseif $block.showtype == 'nivo'}>
<{include file='db:blocks/slideshow_nivoslider.tpl'}>
<{elseif $block.showtype == 'slick'}>
<{include file='db:blocks/slideshow_slickslider.tpl'}>
<{/if}>



