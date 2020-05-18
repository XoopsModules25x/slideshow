<div class='container-fluid'>
	<div class='row'>
	<div class='slick-slider responsive center-block text-center'>

<{foreach item=item from=$block.items}>
			<div><a title="<{$item.item_title}>" href="<{$item.item_link}>"><img class="img-fluid" width="<{$block.imagewidth}>" height="<{$block.imageheight}>" src="<{$item.imgurl}>" alt="<{$item.item_title}>" /></a><br><{$item.item_title}></div>
<{/foreach}>

</div></div></div>