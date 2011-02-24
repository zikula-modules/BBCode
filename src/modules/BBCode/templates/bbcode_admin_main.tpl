{* $Id: BBCode_admin_main.tpl 222 2010-07-29 12:42:23Z herr.vorragend $ *}

{include file=bbcode_admin_menu.tpl}

<h3>{gt text="Actually the BBCode hook is used with the following modules"}</h3>

<br /><p class="z-informationmsg"><a href="{modurl modname=modules type=admin func=main}" title="{gt text="Activate BBCode for more modules"}">{gt text="Activate BBCode for more modules"}</a></p>

<table class="z-admintable">
    <thead>
        <tr>
            <th>{gt text="Module"}</th>
            <th>{gt text="Displayname"}</th>
            <th>{gt text="Options"}</th>
        </tr>
    </thead>
    <tbody>
        {foreach item=mod from=$hookedmodules}
        <tr class="{cycle values="z-odd,z-even}">
            <td>{$mod.name}</td>
            <td>{$mod.displayname}</td>
            <td>
                <a href="{modurl modname=modules type=admin func=hooks id=$mod.id}" title="{gt text="Hook settings"}">{gt text="Hook settings"}</a>
            </td>
        </tr>
        {foreachelse}
        <tr class="z-admintableempty"><td colspan="3">{gt text="BBCode is not used with any module"}</td></tr>
        {/foreach}    
    </tbody>
</table>

{include file="bbcode_admin_footer.tpl"}
