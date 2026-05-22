<{include file="$xoops_rootpath/modules/slideshow/templates/admin/slideshow_header.tpl"}>

<table id="xo-item-sort" class="outer" cellspacing="1" width="100%">
    <thead>
        <th><{$smarty.const._AM_SLIDESHOW_ITEM_IMG}></th>
        <th><{$smarty.const._AM_SLIDESHOW_ITEM_TITLE}></th>
        <th><{$smarty.const._AM_SLIDESHOW_ITEM_TYPE}></th>
        <th><{$smarty.const._AM_SLIDESHOW_ITEM_CAPTION}></th>
        <th><{$smarty.const._AM_SLIDESHOW_ITEM_LINK}></th>
        <th><{$smarty.const._AM_SLIDESHOW_ITEM_CATEGORY}></th>
        <th><{$smarty.const._AM_SLIDESHOW_ITEM_ORDER}></th>
        <th><{$smarty.const._AM_SLIDESHOW_ITEM_ACTIVE}></th>
        <th><{$smarty.const._AM_SLIDESHOW_ITEM_STARTDATE}></th>
        <th><{$smarty.const._AM_SLIDESHOW_ITEM_ENDDATE}></th>
        <th><{$smarty.const._AM_SLIDESHOW_ITEM_STATUS}></th>
        <th><{$smarty.const._AM_SLIDESHOW_ITEM_LANGUAGECODE}></th>
        <th><{$smarty.const._AM_SLIDESHOW_ITEM_ACTION}></th>
    </thead>
    <tbody class="xo-item">
    <{foreach item=item from=$items}>
    <tr class="odd" id="mod_<{$item.item_id}>">

        <!-- Thumbnail / Video preview -->
        <td class="txtcenter bold">
            <{if $item.item_type == 'youtube' || $item.item_type == 'vimeo'}>
                <{if $item.embed_url}>
                    <iframe style="max-width:120px;max-height:80px;" src="<{$item.embed_url}>"
                            frameborder="0" allowfullscreen></iframe>
                <{else}>
                    <span style="color:red;font-size:.8em;">Invalid URL</span>
                <{/if}>
            <{else}>
                <img style="max-width:100px;max-height:100px;" src="<{$item.imgurl}>" alt="<{$item.item_title|escape}>" />
            <{/if}>
        </td>

        <!-- Title -->
        <td class="txtcenter bold"><{$item.item_title}></td>

        <!-- Type badge -->
        <td class="txtcenter bold">
            <{if $item.item_type == 'youtube'}>
                <span style="background:#ff0000;color:#fff;padding:2px 6px;border-radius:3px;font-size:.8em;">YouTube</span>
            <{elseif $item.item_type == 'vimeo'}>
                <span style="background:#1ab7ea;color:#fff;padding:2px 6px;border-radius:3px;font-size:.8em;">Vimeo</span>
            <{else}>
                <span style="background:#5a7a2e;color:#fff;padding:2px 6px;border-radius:3px;font-size:.8em;">Image</span>
            <{/if}>
        </td>

        <!-- Caption -->
        <td class="txtcenter bold">
            <{if $item.item_caption}><{$item.item_caption}><{else}>-<{/if}>
        </td>

        <!-- Link -->
        <td class="txtcenter bold">
            <{if $item.item_link}>
                <a href="<{$item.item_link}>"><{$item.item_link}></a>
                <{if $item.item_linktarget==1}> *<{/if}>
            <{else}>-<{/if}>
        </td>

        <!-- Category -->
        <td class="txtcenter bold">
            <a title="<{$item.categorytitle}>"
               href="slideshow.php?category=<{$item.item_category}>"><{$item.categorytitle}></a>
        </td>

        <!-- Order -->
        <td class="width5 txtcenter">
            <img src="../assets/images/puce.png" alt="" /><{$item.item_order}>
        </td>

        <!-- Active toggle -->
        <td class="txtcenter width5 bold">
            <img class="cursorpointer"
                 id="item_status<{$item.item_id}>"
                 onclick="item_setStatus( { op: 'item_status', item_id: <{$item.item_id}> }, 'item_status<{$item.item_id}>', 'backend.php' )"
                 src="<{if $item.item_status}>../assets/images/ok.png<{else}>../assets/images/cancel.png<{/if}>"
                 alt="" />
        </td>

        <!-- Start date -->
        <td class="txtcenter width5 bold"><{$item.item_startdate}></td>

        <!-- End date -->
        <td class="txtcenter width5 bold"><{$item.item_enddate}></td>

        <!-- Running status -->
        <td class="txtcenter width5 bold">
            <{if $item.item_status==0}>
                <{$smarty.const._AM_SLIDESHOW_INACTIVE}>
            <{else}>
                <{if $item.item_startdate|date_format:"%Y/%m/%d %H:%M:%S" <= $smarty.now|date_format:"%Y/%m/%d %H:%M:%S"
                    && $smarty.now|date_format:"%Y/%m/%d %H:%M:%S" <= $item.item_enddate|date_format:"%Y/%m/%d %H:%M:%S"}>
                    <strong><{$smarty.const._AM_SLIDESHOW_RUNNING}></strong>
                <{elseif $item.item_startdate|date_format:"%Y/%m/%d %H:%M:%S" > $smarty.now|date_format:"%Y/%m/%d %H:%M:%S"}>
                    <strong><span style="color:orange"><{$smarty.const._AM_SLIDESHOW_UPCOMING}></span></strong>
                <{else}>
                    <strong><span style="color:red"><{$smarty.const._AM_SLIDESHOW_EXPIRED}></span></strong>
                <{/if}>
            <{/if}>
        </td>

        <!-- Language code -->
        <td class="txtcenter width5 bold">
            <{if $item.item_languagecode}><{$item.item_languagecode}><{else}>-<{/if}>
        </td>

        <!-- Actions -->
        <td class="txtcenter width10 xo-actions">
            <{if $item.item_type == 'image'}>
            <img class="tooltip"
                 onclick="display_dialog(<{$item.item_id}>, true, true, 'slide', 'slide', 400, 700);"
                 src="<{xoAdminIcons 'display.png'}>"
                 alt="<{$smarty.const._PREVIEW}>" title="<{$smarty.const._PREVIEW}>" />
            <{/if}>
            <a href="slideshow.php?op=edit_item&amp;item_id=<{$item.item_id}>">
                <img class="tooltip" src="<{xoAdminIcons 'edit.png'}>"
                     alt="<{$smarty.const._EDIT}>" title="<{$smarty.const._EDIT}>"/>
            </a>
            <a href="slideshow.php?op=delete_item&amp;item_id=<{$item.item_id}>">
                <img class="tooltip" src="<{xoAdminIcons 'delete.png'}>"
                     alt="<{$smarty.const._DELETE}>" title="<{$smarty.const._DELETE}>"/>
            </a>
        </td>
    </tr>
    <{/foreach}>
    </tbody>
</table>

<!-- Preview dialogs (images only) -->
<{foreach item=item from=$items}>
<{if $item.item_type == 'image'}>
<div id="dialog<{$item.item_id}>" title="<{$item.item_title}>" style="display:none;">
    <div class="marg5 pad5 ui-state-default ui-corner-all">
        <{$smarty.const._AM_SLIDESHOW_ITEM_CATEGORY}> :
        <span class="bold">
            <a href="slideshow.php?category=<{$item.item_category}>"><{$item.categorytitle}></a>
        </span>
    </div>
    <div class="marg5 pad5 ui-state-highlight ui-corner-all">
        <div class="pad5">
            <span class="bold"><{$smarty.const._AM_SLIDESHOW_ITEM_TITLE}> : <{$item.item_title}></span><br>
            <img class="ui-state-highlight left" width="300" src="<{$item.imgurl}>" alt="<{$item.item_title}>" />
        </div>
        <{if $item.item_caption}>
        <div class="pad5">
            <span class="bold"><{$smarty.const._AM_SLIDESHOW_ITEM_CAPTION}> : </span><{$item.item_caption}>
        </div>
        <{/if}>
        <div class="clear"></div>
    </div>
</div>
<{/if}>
<{/foreach}>

<div class="pagenav"><{$item_pagenav}></div>
