<{if $block.showtype == 'marquee'}>
	<div class="marquee-block" width="<{$block.slidewidth}>" height="<{$block.slideheight}>">
		<ul id="marquee2" class="marquee">
			<{foreach item=item from=$block.items}>
			<li><a title="<{$item.item_title}>" href="<{$item.item_link}>"><img class="img-fluid" width="<{$block.imagewidth}>" height="<{$block.imageheight}>" src="<{$item.imgurl}>" alt="<{$item.item_title}>" /></a><br><{$item.item_title}></li>
			<{/foreach}>
		</ul>
	</div>
<{/if}>


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


<{if $block.showtype == 'slick'}>

<div class='container-fluid'>
	<div class='row'>
	<div class='slick-slider responsive center-block text-center'>

<{foreach item=item from=$block.items}>
			<div><a title="<{$item.item_title}>" href="<{$item.item_link}>"><img class="img-fluid" width="<{$block.imagewidth}>" height="<{$block.imageheight}>" src="<{$item.imgurl}>" alt="<{$item.item_title}>" /></a><br><{$item.item_title}></div>
<{/foreach}>

</div></div></div>


<{/if}>



