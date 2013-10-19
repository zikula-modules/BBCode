{pageaddvar name='javascript' value='modules/BBCode/javascript/BBCode.js'}
{pageaddvar name='stylesheet' value='modules/BBCode/style/style.css'}
<div id="bbcode" class="bbcode">

    <div>
    <p>
        <input title="{gt text='Insert a link' domain="module_bbcode"}" type="button" accesskey="w" name="url" value=" {gt text='URL' domain="module_bbcode"} " class="btn btn-default btn-xs" onclick="AddBBCode('url')" />
        <input title="{gt text='Insert an email address' domain="module_bbcode"}" type="button" accesskey="m" name="mail" value=" {gt text='E-Mail' domain="module_bbcode"} "    class="btn btn-default btn-xs" onclick="AddBBCode('email')" />
        <input title="{gt text='Insert an image' domain="module_bbcode"}" type="button" accesskey="p" name="image" value=" {gt text='Image' domain="module_bbcode"} " class="btn btn-default btn-xs" onclick="AddBBCode('image')" />
        {if $modvars.BBCode.quote_enabled eq true}
        <input title="{gt text='Insert quote' domain="module_bbcode"}" type="button" accesskey="q" name="quote" value=" {gt text='Quote' domain="module_bbcode"} " class="btn btn-default btn-xs" onclick="AddBBCode('quote')" />
        {/if}
        {if $modvars.BBCode.spoiler_enabled eq true}
        <input title="{gt text='Hide text' domain="module_bbcode"}" type="button" accesskey="s" name="quote" value=" {gt text='Spoiler' domain="module_bbcode"} " class="btn btn-default btn-xs" onclick="AddBBCode('spoiler')" />
        {/if}
        {if $modvars.BBCode.code_enabled eq true}
            {if count($geshi_languages) eq 0}
            <input title="{gt text='Insert code' domain="module_bbcode"}" type="button" accesskey="c" name="code" value=" {gt text='Code' domain="module_bbcode"} " class="btn btn-default btn-xs" onclick="AddBBCode('code')" />
            {else}
            </p>
            <p>
                <label for="code">{gt text='Code' domain="module_bbcode"}:</label>
                <select title="{gt text='Insert code' domain="module_bbcode"}" id="code" name="code" onchange="AddBBCode('code', jQuery(this).val())">
                    <option value="" selected="selected">{gt text='Select code type' domain="module_bbcode"}</option>
                    <option value="">{gt text='No special code' domain="module_bbcode"}</option>
                    {foreach item=code from=$geshi_languages}
                    <option value="{$code|safehtml}">{$code|safehtml}</option>
                    {/foreach}
                </select>
            {/if}
        {/if}
    </p>
    <p class='buttons_row2'>
        <input title="{gt text='Open list' domain="module_bbcode"}" type="button" accesskey="l" name="listopen" value=" {gt text='ul' domain="module_bbcode"} " class="btn btn-default btn-xs" onclick="AddBBCode('listopen')" />
        <input title="{gt text='Add list entry' domain="module_bbcode"}" type="button" accesskey="o" name="listitem" value=" {gt text='li' domain="module_bbcode"} " class="btn btn-default btn-xs" onclick="AddBBCode('listitem')" />
        <input title="{gt text='Close list' domain="module_bbcode"}" type="button" accesskey="x" name="listclose" value=" {gt text='/ul' domain="module_bbcode"} " class="btn btn-default btn-xs" onclick="AddBBCode('listclose')" />
        <input title="{gt text='Bold text' domain="module_bbcode"}" type="button" accesskey="b" name="bold" value=" {gt text='b' domain="module_bbcode"} " class="btn btn-default btn-xs" onclick="AddBBCode('bold')" />
        <input title="{gt text='Italic text' domain="module_bbcode"}" type="button" accesskey="i" name="italic" value=" {gt text='i' domain="module_bbcode"} " class="btn btn-default btn-xs" onclick="AddBBCode('italic')" />
        <input title="{gt text='Underlined text' domain="module_bbcode"}" type="button" accesskey="u" name="underline" value=" {gt text='u' domain="module_bbcode"} " class="btn btn-default btn-xs" onclick="AddBBCode('underline')" />
        <!--<input title="{gt text='Strike out text' domain="module_bbcode"}" type="button" accesskey="u" name="strike" value=" {gt text='s' domain="module_bbcode"} " class="btn btn-default btn-xs" onclick="AddBBCode('strike')" />-->
    </p>
    </div>

    <div>
    {if $modvars.BBCode.color_enabled eq true}
        <label for="fontcolor">{gt text='Font color' domain="module_bbcode"}:</label>
        <select title="{gt text='Select font color' domain="module_bbcode"}" id="fontcolor" name="fontcolor" onchange="AddBBCode('color', jQuery(this).val())">
            <option style="color:black;" value="black">{gt text='Black' domain="module_bbcode"}</option>
            <option style="color:darkred;" value="darkred">{gt text='Dark Red' domain="module_bbcode"}</option>
            <option style="color:red;" value="red">{gt text='Red' domain="module_bbcode"}</option>
            <option style="color:orange;" value="orange">{gt text='Orange' domain="module_bbcode"}</option>
            <option style="color:brown;" value="brown">{gt text='Brown' domain="module_bbcode"}</option>
            <option style="color:yellow;" value="yellow">{gt text='Yellow' domain="module_bbcode"}</option>
            <option style="color:green;" value="green">{gt text='Green' domain="module_bbcode"}</option>
            <option style="color:olive;" value="olive">{gt text='Olive' domain="module_bbcode"}</option>
            <option style="color:cyan;" value="cyan">{gt text='Cyan' domain="module_bbcode"}</option>
            <option style="color:blue;" value="blue">{gt text='Blue' domain="module_bbcode"}</option>
            <option style="color:darkblue;" value="darkblue">{gt text='Dark Blue' domain="module_bbcode"}</option>
            <option style="color:indigo;" value="indigo">{gt text='Indigo' domain="module_bbcode"}</option>
            <option style="color:violet;" value="violet">{gt text='Violet' domain="module_bbcode"}</option>
            <option style="color:white;" value="white">{gt text='White' domain="module_bbcode"}</option>
            {if $modvars.BBCode.allow_usercolor eq "yes"}
            <option style="color:black;" value="#{gt text='Enter color code' domain="module_bbcode"}">{gt text='Self defined color' domain="module_bbcode"}</option>
            {/if}
        </select>&nbsp;
    {/if}
    {if $modvars.BBCode.size_enabled eq "yes"}
        <label for="fontsize">{gt text='Font size' domain="module_bbcode"}:</label>
        <select title="{gt text='Select font size' domain="module_bbcode"}" id="fontsize" name="fontsize" onchange="AddBBCode('size', jQuery(this).val())">
            <option value="tiny">{gt text='Tiny' domain="module_bbcode"}</option>
            <option value="small">{gt text='Small' domain="module_bbcode"}</option>
            <option value="normal" selected="selected">{gt text='Normal' domain="module_bbcode"}</option>
            <option value="large">{gt text='Large' domain="module_bbcode"}</option>
            <option value="huge">{gt text='Huge' domain="module_bbcode"}</option>
            {if $modvars.BBCode.allow_usersize eq "yes"}
            <option value="{gt text='Enter text size' domain="module_bbcode"}">{gt text='Self defined size' domain="module_bbcode"}</option>
            {/if}
        </select>
    {/if}
    </div>
</div>

<noscript>
    <p class="noscript">{gt text='Your browser does not support javascript or you turned it off. The BBCode interface has been disabled.' domain="module_bbcode"}</p>
</noscript>
