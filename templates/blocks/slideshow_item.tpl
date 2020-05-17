<{if $block.showtype == 'marquee'}>
	<div class="marquee-block" width="<{$block.slidewidth}>" height="<{$block.slideheight}>">
		<ul id="marquee2" class="marquee">
			<{foreach item=item from=$block.items}>
			<li><a title="<{$item.item_title}>" href="<{$item.item_link}>"><img class="img-fluid" width="<{$block.imagewidth}>" height="<{$block.imageheight}>" src="<{$item.imgurl}>" alt="<{$item.item_title}>" /></a><br><{$item.item_title}></li>
			<{/foreach}>
		</ul>
	</div>
<{/if}>

