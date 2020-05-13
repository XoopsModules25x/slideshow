<{includeq file="$xoops_rootpath/modules/slideshow/templates/admin/slideshow_header.tpl"}>
<table id="xo-topic-sort" class="outer" cellspacing="1" width="100%">
    <thead>
    <th><{$smarty.const._AM_SLIDESHOW_TOPIC_ID}></th>
    <th><{$smarty.const._AM_SLIDESHOW_TOPIC_TITLE}></th>
    <th><{$smarty.const._AM_SLIDESHOW_TOPIC_SHOWTYPE}></th>
    <th><{$smarty.const._AM_SLIDESHOW_TOPIC_ACTION}></th>
    </thead>
    <tbody class="xo-topic">
    <{foreach item=topic from=$topics}>
    <tr class="odd" id="mod_<{$topic.topic_id}>">
        <td class="width5 txtcenter"><img src="../assets/images/puce.png" alt=""/><{$topic.topic_id}></td>
        <td class="txtcenter width35 bold">
	        <a href="<{$topic.topic_showtype}>.php?topic=<{$topic.topic_id}>"><{$topic.topic_title}></a>
        </td>
        <td class="txtcenter width10 bold">
        <{$topic.topic_showtype}>
        </td>
        <td class="txtcenter width10 xo-actions">
            <a href="topic.php?op=edit_topic&amp;topic_id=<{$topic.topic_id}>"><img class="tooltip" src="<{xoAdminIcons edit.png}>" alt="<{$smarty.const._EDIT}>" title="<{$smarty.const._EDIT}>"/></a>
            <a href="topic.php?op=delete_topic&amp;topic_id=<{$topic.topic_id}>"><img class="tooltip" src="<{xoAdminIcons delete.png}>" alt="<{$smarty.const._DELETE}>" title="<{$smarty.const._DELETE}>"/></a>
        </td>
    </tr>
    <{/foreach}>
    </tbody>
</table>
<div class="pad5 marg5 center"><a title="MOHTAVA Project" href="http://www.mohtava.com"><img src="http://www.mohtava.com/uploads/logo/cms.png" alt="MOHTAVA Project" /></a></div>