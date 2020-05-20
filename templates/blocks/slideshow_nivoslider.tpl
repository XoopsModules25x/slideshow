<{if $block.showtype == 'nivo'}>
<div class="slider-wrapper theme-light">
   <div id="slider" class="nivoSlider">
<{foreach item=item from=$block.items}>
<a title="<{$item.item_title}>" href="<{$item.item_link}>"><img class="img-fluid" width="<{$block.imagewidth}>" height="<{$block.imageheight}>" src="<{$item.imgurl}>" alt="<{$item.item_title}>" /></a><br><{$item.item_title}>
	<{/foreach}>
</div>

</div>
<div style="clear: both;"></div>
<{/if}>
