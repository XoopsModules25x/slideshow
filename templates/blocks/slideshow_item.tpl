<{if $block.showtype == 'sliderkit'}>
<div class="sliderkit newslider-vertical" width="<{$block.slidewidth}>" height="<{$block.slideheight}>">
	<div class="sliderkit-nav">
		<div class="sliderkit-nav-clip">
			<ul>
			<{foreach item=item from=$block.items}>
				<li><a href="<{$item.item_link}>" title="<{$item.item_title}>"><{$item.item_title}></a></li>
			<{/foreach}>
			</ul>
		</div>
	</div>
	<div class="sliderkit-panels">
	   <{foreach item=item from=$block.items}>
		<div class="sliderkit-panel">
			<div class="sliderkit-news">
				<a href="#" title="<{$item.item_title}>"><img src="<{$item.imgurl}>" alt="<{$item.item_title}>" class="img-fluid" width="<{$block.imagewidth}>" height="<{$block.imageheight}>"  /></a>
				<h3><a title="<{$item.item_title}>" href="<{$item.item_link}>"><{$item.item_title}></a></h3>
				<p><{$item.item_text|truncate:200}> <a title="<{$item.item_title}>" class="sliderkit-news-readmore" href="<{$item.item_link}>"><{$smarty.const._MB_SLIDESHOW_MORE}></a></p>
			</div>
		</div>
      <{/foreach}>
	</div>
</div>
<{/if}>


<{if $block.showtype == 'scrollable'}>
<div class="slider" width="<{$block.slidewidth}>" height="<{$block.slideheight}>">
	<div class="main">
		<div class="pages">
			<div class="page">
				<div class="scrollable">
					<div class="items">
					<{foreach item=item from=$block.items}>
						<div class="item">
							<div class="itemleft"><img width="<{$block.imagewidth}>" height="<{$block.imageheight}>" src="<{$item.imgurl}>" alt="<{$item.item_title}>" /></div>
							<div class="itemright">
								<h2><{$item.item_title}></h2>
								<div class="itemshort"><{$item.item_text}></div>
								<div class="itemmore"><a title="More" href="<{$item.item_link}>">More</a></div>
							</div>
						   <div class="clear"></div>
						</div>
					<{/foreach}>
					</div>
				</div>
				<div class="navi">
				<{foreach item=item from=$block.items}>
					<a title="<{$item.item_title}>" class="tooltip<{if $item.item_default == 1}> active<{/if}>" href="#<{$item.item_id}>"></a>
				<{/foreach}>
				</div>
			</div>
		</div>
	</div>
</div>	
<{/if}>

<{if $block.showtype == 'marquee'}>
	<div class="marquee-block" width="<{$block.slidewidth}>" height="<{$block.slideheight}>">
		<ul id="marquee2" class="marquee">
			<{foreach item=item from=$block.items}>
			<li><a title="<{$item.item_title}>" href="<{$item.item_link}>"><img class="img-fluid" width="<{$block.imagewidth}>" height="<{$block.imageheight}>" src="<{$item.imgurl}>" alt="<{$item.item_title}>" /></a><br><{$item.item_title}></li>
			<{/foreach}>
		</ul>
	</div>
<{/if}>

