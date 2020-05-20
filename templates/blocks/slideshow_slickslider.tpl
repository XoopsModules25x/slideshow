<{if $block.showtype == 'slick'}>
<div class='slider single-item text-center'>
<{foreach item=item from=$block.items}>
<{if $smarty.now|date_format:"%Y-%m-%d %H:%M:%S" >= $item.item_startdate AND $smarty.now|date_format:"%Y-%m-%d %H:%M:%S" <= $item.item_enddate}>
	<{if $item.item_status =='1'}>
		<{if $item.item_languagecode}>[<{$item.item_languagecode}>]<{/if}>
				<div>
			<{if $item.item_link}> 
				<{if $item.item_linktarget==1}>
					<a target="_blank" title="<{$item.item_title}>" alt="<{$item.item_title}>" href="<{$item.item_link}>">
				<{else}>
					<a target="_self" title="<{$item.item_title}>" alt="<{$item.item_title}>" href="<{$item.item_link}>">
				<{/if}>
			<{/if}>
					<img title="<{$item.item_title}>" class="img-fluid" width="<{$block.imagewidth}>" height="<{$block.imageheight}>" src="<{$item.imgurl}>" alt="<{$item.item_title}>" />
			<{if $item.item_link}></a><{/if}>
				<{if $item.item_caption}><br><{$item.item_caption}><{/if}>
				</div>
		<{if $item.item_languagecode}>[/<{$item.item_languagecode}>]<{/if}>	
	<{/if}>
<{/if}>
<{/foreach}>

</div>
<{/if}>