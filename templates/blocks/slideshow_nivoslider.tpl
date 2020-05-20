<{if $block.showtype == 'nivo'}>
<div class="slider-wrapper theme-light">
<div id="slider" class="nivoSlider">
<{foreach item=item from=$block.items}>
<{if $smarty.now|date_format:"%Y-%m-%d %H:%M:%S" >= $item.item_startdate AND $smarty.now|date_format:"%Y-%m-%d %H:%M:%S" <= $item.item_enddate}>
	<{if $item.item_status =='1'}>
		<{if $item.item_languagecode}>[<{$item.item_languagecode}>]<{/if}>
			<{if $item.item_link}> 
				<{if $item.item_linktarget==1}>
					<a target="_blank" title="<{$item.item_title}>" alt="<{$item.item_title}>" href="<{$item.item_link}>">
				<{else}>
					<a target="_self" title="<{$item.item_title}>" alt="<{$item.item_title}>" href="<{$item.item_link}>">
				<{/if}>
			<{/if}>
			
			<{if $item.item_caption}>
					<img title="#<{$item.item_id}>" class="img-fluid" width="<{$block.imagewidth}>" height="<{$block.imageheight}>" src="<{$item.imgurl}>" alt="<{$item.item_title}>" />
			<{else}>
					<img class="img-fluid" width="<{$block.imagewidth}>" height="<{$block.imageheight}>" src="<{$item.imgurl}>" alt="<{$item.item_title}>" />
			<{/if}>
			<{if $item.item_link}></a><{/if}>
		<{if $item.item_languagecode}>[/<{$item.item_languagecode}>]<{/if}>
	<{/if}>
<{/if}>
<{/foreach}>
</div>

<{foreach item=item from=$block.items}>
<{if $smarty.now|date_format:"%Y-%m-%d %H:%M:%S" >= $item.item_startdate AND $smarty.now|date_format:"%Y-%m-%d %H:%M:%S" <= $item.item_enddate}>
	<{if $item.item_caption}>
		<div id="<{$item.item_id}>" class="nivo-html-caption">
			<{$item.item_caption}>
		</div>
	<{/if}>
<{/if}>
<{/foreach}>

</div>
<{/if}>
