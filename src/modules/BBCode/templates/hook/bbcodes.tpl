{ajaxheader modname='BBCode' filename='BBCode.js'}
{pageaddvar name='stylesheet' value='modules/BBCode/style/style.css'}
<fieldset>
    <legend>{gt text="BBCode"}</legend>

    <div id="bbcode" class="bbcode">

        {if $images}
        <div class="z-formrow z-formnote">
        <p>
            {gt text='Insert a link' assign='title'}{bbcodebutton name="url" title=$title key="w" image="bb_url.gif"}
            {gt text='Insert an email address' assign='title'}{bbcodebutton name="email" title=$title key="m" image="bb_email.gif"}
            {gt text='Insert an image' assign='title'}{bbcodebutton name="image" title=$title key="p" image="bb_image.gif"}
            {gt text='Insert quote' assign='title'}{bbcodebutton name="quote" title=$title key="q" image="bb_quote.gif"}
            {gt text='Insert code' assign='title'}{bbcodebutton name="code" title=$title key="c" image="bb_code.gif"}
        </p>
        <p>
            {gt text='Open list' assign='title'}{bbcodebutton name="listopen" title=$title key="l" image="bb_openlist.gif"}
            {gt text='Add list entry' assign='title'}{bbcodebutton name="listitem" title=$title key="o" image="bb_listitem.gif"}
            {gt text='Close list' assign='title'}{bbcodebutton name="listclose" title=$title key="x" image="bb_closelist.gif"}
            {gt text='Bold text' assign='title'}{bbcodebutton name="bold" title=$title key="b" image="bb_bold.gif"}
            {gt text='Italic text' assign='title'}{bbcodebutton name="italic" title=$title key="i" image="bb_italic.gif"}
            {gt text='Underlined text' assign='title'}{bbcodebutton name="underline" title=$title key="u" image="bb_underline.gif"}
        </p>
        </div>
        {else}
        <div class="z-formlist z-formbuttons z-buttons">
        <p>
            <input title="{gt text='Insert a link' domain="module_bbcode"}" type="button" accesskey="w" name="url" value=" {gt text='URL' domain="module_bbcode"} " class="bbcode_button z-bt-small" onclick="AddBBCode('url')" />
            <input title="{gt text='Insert an email address' domain="module_bbcode"}" type="button" accesskey="m" name="mail" value=" {gt text='E-Mail' domain="module_bbcode"} "    class="bbcode_button z-bt-small" onclick="AddBBCode('email')" />
            <input title="{gt text='Insert an image' domain="module_bbcode"}" type="button" accesskey="p" name="image" value=" {gt text='Image' domain="module_bbcode"} " class="bbcode_button z-bt-small" onclick="AddBBCode('image')" />
            {if $modvars.BBCode.quote_enabled eq true}
            <input title="{gt text='Insert quote' domain="module_bbcode"}" type="button" accesskey="q" name="quote" value=" {gt text='Quote' domain="module_bbcode"} " class="bbcode_button z-bt-small" onclick="AddBBCode('quote')" />
            {/if}
            {if $modvars.BBCode.spoiler_enabled eq true}
            <input title="{gt text='Hide text' domain="module_bbcode"}" type="button" accesskey="s" name="quote" value=" {gt text='Spoiler' domain="module_bbcode"} " class="bbcode_button z-bt-small" onclick="AddBBCode('spoiler')" />
            {/if}
            {if $modvars.BBCode.code_enabled eq true}
                {if count($geshi_languages) eq 0}
                <input title="{gt text='Insert code' domain="module_bbcode"}" type="button" accesskey="c" name="code" value=" {gt text='Code' domain="module_bbcode"} " class="bbcode_button z-bt-small" onclick="AddBBCode('code')" />
                {else}
                </p>
                <p>
                    <label for="code">{gt text='Code' domain="module_bbcode"}:</label>
                    <select title="{gt text='Insert code' domain="module_bbcode"}" id="code" name="code" onchange="AddBBCode('code', $F('code'))">
                        <option value="" selected="selected">{gt text='Select code type' domain="module_bbcode"}</option>
                        <option value="">{gt text='No special code' domain="module_bbcode"}</option>
                        {foreach item=code from=$geshi_languages}
                        <option value="{$code|safehtml}">{$code|safehtml}</option>
                        {/foreach}
                    </select>
                {/if}
            {/if}
        </p>
        <p>
            <input title="{gt text='Open list' domain="module_bbcode"}" type="button" accesskey="l" name="listopen" value=" {gt text='ul' domain="module_bbcode"} " class="bbcode_button2 z-bt-small" onclick="AddBBCode('listopen')" />
            <input title="{gt text='Add list entry' domain="module_bbcode"}" type="button" accesskey="o" name="listitem" value=" {gt text='li' domain="module_bbcode"} " class="bbcode_button2 z-bt-small" onclick="AddBBCode('listitem')" />
            <input title="{gt text='Close list' domain="module_bbcode"}" type="button" accesskey="x" name="listclose" value=" {gt text='/ul' domain="module_bbcode"} " class="bbcode_button2 z-bt-small" onclick="AddBBCode('listclose')" />
            <input title="{gt text='Bold text' domain="module_bbcode"}" type="button" accesskey="b" name="bold" value=" {gt text='b' domain="module_bbcode"} " class="bbcode_button2 z-bt-small" onclick="AddBBCode('bold')" />
            <input title="{gt text='Italic text' domain="module_bbcode"}" type="button" accesskey="i" name="italic" value=" {gt text='i' domain="module_bbcode"} " class="bbcode_button2 z-bt-small" onclick="AddBBCode('italic')" />
            <input title="{gt text='Underlined text' domain="module_bbcode"}" type="button" accesskey="u" name="underline" value=" {gt text='u' domain="module_bbcode"} " class="bbcode_button2 z-bt-small" onclick="AddBBCode('underline')" />
            <input title="{gt text='Strike out text' domain="module_bbcode"}" type="button" accesskey="u" name="strike" value=" {gt text='s' domain="module_bbcode"} " class="bbcode_button2 z-bt-small" onclick="AddBBCode('strike')" />
        </p>
        </div>
        {/if}

        {if $modvars.BBCode.color_enabled eq true}
        <p class="z-formnote">
            <label for="fontcolor">{gt text='Font color' domain="module_bbcode"}:</label>
            <select title="{gt text='Select font color' domain="module_bbcode"}" id="fontcolor" name="fontcolor" onchange="AddBBCode('color', $F('fontcolor'))">
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
        </p>
        {/if}
        {if $modvars.BBCode.size_enabled eq "yes"}
        <p class="z-formnote">
            <label for="fontsize">{gt text='Font size' domain="module_bbcode"}:</label>
            <select title="{gt text='Select font size' domain="module_bbcode"}" id="fontsize" name="fontsize" onchange="AddBBCode('size', $F('fontsize'))">
                <option value="tiny">{gt text='Tiny' domain="module_bbcode"}</option>
                <option value="small">{gt text='Small' domain="module_bbcode"}</option>
                <option value="normal" selected="selected">{gt text='Normal' domain="module_bbcode"}</option>
                <option value="large">{gt text='Large' domain="module_bbcode"}</option>
                <option value="huge">{gt text='Huge' domain="module_bbcode"}</option>
                {if $modvars.BBCode.allow_usersize eq "yes"}
                <option value="{gt text='Enter text size' domain="module_bbcode"}">{gt text='Self defined size' domain="module_bbcode"}</option>
                {/if}
            </select>
        </p>
        {/if}
    </div>

    <noscript>
        <p class="noscript">{gt text='Your browser does not support javascript or you turned it off. The BBCode interface has been disabled.' domain="module_bbcode"}</p>
    </noscript>
</fieldset>