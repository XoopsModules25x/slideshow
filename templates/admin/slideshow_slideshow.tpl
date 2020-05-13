<{includeq file="$xoops_rootpath/modules/slideshow/templates/admin/slideshow_header.tpl"}>
<table id="xo-item-sort" class="outer" cellspacing="1" width="100%">
    <thead>
    <th><{$smarty.const._AM_SLIDESHOW_ITEM_ID}></th>
    <th><{$smarty.const._AM_SLIDESHOW_ITEM_ORDER}></th>
    <th><{$smarty.const._AM_SLIDESHOW_ITEM_TITLE}></th>
    <th><{$smarty.const._AM_SLIDESHOW_ITEM_IMG}></th>
    <th><{$smarty.const._AM_SLIDESHOW_ITEM_TOPIC}></th>
    <th><{$smarty.const._AM_SLIDESHOW_ITEM_DEFAULT}></th>
    <th><{$smarty.const._AM_SLIDESHOW_ITEM_STATUS}></th>
    <th><{$smarty.const._AM_SLIDESHOW_ITEM_ACTION}></th>
    </thead>
    <tbody class="xo-item">
    <{foreach item=item from=$items}>
    <tr class="odd" id="mod_<{$item.item_id}>">
        <td class="width5 txtcenter"><img src="../images/puce.png" alt=""/><{$item.item_id}></td>
        <td class="width5 txtcenter"><img src="../assets/images/puce.png" alt=""/><{$item.item_order}></td>
        <td class="txtcenter bold">
	        <{$item.item_title}>
        </td>
        <td class="txtcenter bold">
		        <img style="max-width: 100px; max-height: 100px;" src="<{$item.imgurl}>" alt="<{$item.item_title}>" />
        </td>
        <td class="txtcenter bold">
	        <a title="<{$item.topictitle}>" href="slideshow.php?topic=<{$item.item_topic}>"><{$item.topictitle}></a>
        </td>
        <td class="txtcenter width5 bold">
	         <img class="cursorpointer xo-defaultimg" id="item_default<{$item.item_id}>" onclick="item_setDefault( { op: 'item_default', item_id: <{$item.item_id}> , topic_id: <{$item.item_topic}> }, 'item_default<{$item.item_id}>', 'backend.php' )" src="<{if $item.item_default}>../assets/images/ok.png<{else}>../assets/images/cancel.png<{/if}>" alt=""/>
        </td>
        <td class="txtcenter width5 bold">
            <img class="cursorpointer" id="item_status<{$item.item_id}>" onclick="item_setStatus( { op: 'item_status', item_id: <{$item.item_id}> }, 'item_status<{$item.item_id}>', 'backend.php' )" src="<{if $item.item_status}>../assets/images/ok.png<{else}>../assets/images/cancel.png<{/if}>" alt=""/>
        </td>
        <td class="txtcenter width10 xo-actions">
            <img class="tooltip" onclick="display_dialog(<{$item.item_id}>, true, true, 'slide', 'slide', 400, 700);" src="<{xoAdminIcons display.png}>" alt="<{$smarty.const._PREVIEW}>" title="<{$smarty.const._PREVIEW}>" />
            <a href="slideshow.php?op=edit_item&amp;item_id=<{$item.item_id}>"><img class="tooltip" src="<{xoAdminIcons edit.png}>" alt="<{$smarty.const._EDIT}>" title="<{$smarty.const._EDIT}>"/></a>
            <a href="slideshow.php?op=delete_item&amp;item_id=<{$item.item_id}>"><img class="tooltip" src="<{xoAdminIcons delete.png}>" alt="<{$smarty.const._DELETE}>" title="<{$smarty.const._DELETE}>"/></a>
        </td>
    </tr>
    <{/foreach}>
    </tbody>
</table>

<{foreach item=item from=$items}>
	<div id="dialog<{$item.item_id}>" title="<{$item.item_title}>" style='display:none;'>
	<div class="marg5 pad5 ui-state-default ui-corner-all">
		<{$smarty.const._AM_SLIDESHOW_ITEM_TOPIC}> : <span class="bold"><a href="slideshow.php?topic=<{$item.item_topic}>"><{$item.topictitle}></a></span>
	</div>
	<div class="marg5 pad5 ui-state-highlight ui-corner-all">
	   <div class="pad5"><span class="bold"><{$smarty.const._AM_SLIDESHOW_ITEM_TITLE}> : <{$item.item_title}></span></div>
		<div class="pad5"><span class="bold"><{$smarty.const._AM_SLIDESHOW_ITEM_TEXT}> : </span><img class="ui-state-highlight right" width="300" src="<{$item.imgurl}>" alt="<{$item.item_title}>" /><{$item.item_text}></div>
		<div class="clear"></div>
   </div>
	</div>
<{/foreach}>

<div class="pagenav"><{$item_pagenav}></div>
<div class="pad5 marg5 center"><a title="MOHTAVA Project" href="http://www.mohtava.com"><img src="http://www.mohtava.com/uploads/logo/cms.png" alt="MOHTAVA Project" /></a></div>