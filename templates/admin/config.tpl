{ajaxheader modname='BBCode' filename='BBCode_admin.js'}

{adminheader}
<div class="z-admin-content-pagetitle">
    {icon type="config" size="small"}
    <h3>{gt text='Settings'}</h3>
</div>

<p class="z-warningmsg">{gt text="Notice! Please allow the used HTML tags in the SecurityCenter."}</p>

{form cssClass="z-form"}
{formvalidationsummary}

<fieldset>
    <legend>{gt text='Configuration [code][/code]'}</legend>
    <div class="z-formrow">
        {formlabel for="code_enabled" __text="Enable code highlighting"}
        {formcheckbox id="code_enabled" checked=$modvars.BBCode.code_enabled onchange="switchdisplaystate('codeconfig');"}
    </div>
    <div id="codeconfig">
        <div class="z-formrow">
            {formlabel for="code" __text="Code"}
            {formtextinput id="code" textMode="multiline" rows="3" cols="50" maxLength="200" text=$modvars.BBCode.code}
            <p class="z-formnote z-informationmsg">{gt text='%h = Header (Code), %c=lines of code, %j=lines of code, escaped for javascript.'}</p>
        </div>
        <div class="z-formrow">
            {formlabel for="syntaxhilite" __text="Select code highlight mode"}
            {formdropdownlist id="syntaxhilite" items=$hiliteoptions selectedValue=$modvars.BBCode.syntaxhilite}
        </div>
        <div class="z-formrow">
            <label>{gt text='Preview'}</label>
        </div>
        <div class="z-formnote">{$code_preview|safehtml}</div>
    </div>
</fieldset>

<fieldset>
    <legend>{gt text='Configuration [quote][/quote]'}</legend>
    <div class="z-formrow">
        {formlabel for="quote_enabled" __text="Enable quote highlighting"}
        {formcheckbox id="quote_enabled" checked=$modvars.BBCode.quote_enabled onchange="switchdisplaystate('quoteconfig');"}
    </div>
    <div id="quoteconfig">
        <div class="z-formrow">
            {formlabel for="quote" __text="Quote"}
            {formtextinput id="quote" textMode="multiline" rows="3" cols="50" maxLength="200" text=$modvars.BBCode.quote}
            <p class="z-formnote z-informationmsg">{gt text='%u = username, %t=quoted text'}</p>
        </div>
        <div class="z-formrow">
            <label>{gt text='Preview'}</label>
        </div>
        <div class="z-formnote">{$quote_preview|safehtml}</div>
    </div>
</fieldset>

<fieldset>
    <legend>{gt text='Configuration [color][/color]'}</legend>
    <div class="z-formrow">
        {formlabel for="color_enabled" __text="Enable flexible text colors"}
        {formcheckbox id="color_enabled" checked=$modvars.BBCode.color_enabled onchange="switchdisplaystate('colorconfig');"}
    </div>
    <div class="z-formrow">
        {formlabel for="allow_usercolor" __text="Allow userdefined text color"}
        {formcheckbox id="allow_usercolor" checked=$modvars.BBCode.allow_usercolor}
    </div>
</fieldset>

<fieldset>
    <legend>{gt text='Configuration [size][/size]'}</legend>
    <div class="z-formrow">
        {formlabel for="size_enabled" __text="Enable flexible text size"}
        {formcheckbox id="size_enabled" checked=$modvars.BBCode.size_enabled onchange="switchdisplaystate('sizeconfig');"}
    </div>
    <div id="sizeconfig">
        <div class="z-formrow">
            {formlabel for="size_tiny" __text="Tiny"}
            <div>
                {formtextinput id="size_tiny" text=$modvars.BBCode.size_tiny|safehtml size="20" maxLength="30"}
                <span style="font-size: {$modvars.BBCode.size_tiny};">TestTESTtest</span>
            </div>
        </div>
        <div class="z-formrow">
            {formlabel for="size_small" __text="Small"}
            <div>
                {formtextinput id="size_small" text=$modvars.BBCode.size_small|safehtml size="20" maxLength="30"}
                <span style="font-size: {$modvars.BBCode.size_small};">TestTESTtest</span>
            </div>
        </div>
        <div class="z-formrow">
            {formlabel for="size_normal" __text="Normal"}
            <div>
                {formtextinput id="size_normal" text=$modvars.BBCode.size_normal|safehtml size="20" maxLength="30"}
                <span style="font-size: {$modvars.BBCode.size_normal};">TestTESTtest</span>
            </div>
        </div>
        <div class="z-formrow">
            {formlabel for="size_large" __text="Large"}
            <div>
                {formtextinput id="size_large" text=$modvars.BBCode.size_large|safehtml size="20" maxLength="30"}
                <span style="font-size: {$modvars.BBCode.size_large};">TestTESTtest</span>
            </div>
        </div>
        <div class="z-formrow">
            {formlabel for="size_huge" __text="Huge"}
            <div>
                {formtextinput id="size_huge" text=$modvars.BBCode.size_huge|safehtml size="20" maxLength="30"}
                <span style="font-size: {$modvars.BBCode.size_huge};">TestTESTtest</span>
            </div>
        </div>
        <div class="z-formrow">
            {formlabel for="allow_usersize" __text="Allow userdefined text size"}
            {formcheckbox id="allow_usersize" checked=$modvars.BBCode.allow_usersize}
        </div>
    </div>
</fieldset>

<fieldset>
    <legend>{gt text='Configuration of mimeTeX integration [math][/math]'}</legend>
    <div class="z-formrow">
        {formlabel for="mimetex_enabled" __text="Enable mimeTeX support"}
        {formcheckbox id="mimetex_enabled" checked=$modvars.BBCode.mimetex_enabled onchange="switchdisplaystate('mimetexconfig');"}
    </div>
    <div id="mimetexconfig">
        <div class="z-formrow">
            {formlabel for="mimetex_url" __text="Full URL to the mimeTeX cgi script"}
            {formtextinput id="mimetex_url" text=$modvars.BBCode.mimetex_url|safehtml size="20" maxLength="99"}
            <p class="z-formnote z-sub">{gt text="Please use an own mimeTeX installation for your website!"}</p>
        </div>
        <div class="z-formrow z-formnote">
            {if $mimetex_url ne ""}
            {gt text="Test image for mimeTeX"}: [math]a^2+b^2=c^2[/math]<br />
            <img src="{$mimetex_url}?a^2+b^2=c^2" alt='' />
            {else}
            {gt text="Enter URl to your mimeTeX installation and you will see a test image here"}
            {/if}
        </div>
    </div>
</fieldset>

<fieldset>
    <legend>{gt text='Miscellaneous settings'}</legend>
    <div class="z-formrow">
        {formlabel for="imagebuttons_enabled" __text="Use images for buttons in interface"}
        {formcheckbox id="imagebuttons_enabled" checked=$modvars.BBCode.imagebuttons_enabled}
    </div>
    <div class="z-formrow">
        {formlabel for="link_shrinksize" __text="Shrink links to"}
        <div>{formintinput id="link_shrinksize" minValue="0" maxValue="50" size="2" text=$modvars.BBCode.link_shrinksize}&nbsp;{gt text="chars"}</div>
        <p class="z-formnote z-informationmsg">{gt text="Shrinks the urls shown to the specified length (0=no action)."}</p>
    </div>
    <div class="z-formrow">
        {formlabel for="lightbox_enabled" __text="Use Lightbox or the Zikula Imageviewer in img-tag"}
        {formcheckbox id="lightbox_enabled" checked=$modvars.BBCode.lightbox_enabled onchange="switchdisplaystate('lightboxconfig');"}
    </div>
    <div id="lightboxconfig">
        <div class="z-formrow">
            {formlabel for="lightbox_previewwidth" __text="Width of preview image"}
            <div>{formintinput id="lightbox_previewwidth" minValue="50" maxValue="1000" size="4" text=$modvars.BBCode.lightbox_previewwidth} px&nbsp;{gt text="(50-1000px)"}</div>
            <p class="z-formnote z-informationmsg">{gt text="Height will be calculated by the browser automatically."}</p>
        </div>
    </div>
    <div class="z-formrow">
        {formlabel for="spoiler_enabled" __text="Enable spoiler tag"}
        {formcheckbox id="spoiler_enabled" checked=$modvars.BBCode.spoiler_enabled onchange="switchdisplaystate('spoilerconfig');"}
    </div>
    <div id="spoilerconfig">
        <div class="z-formrow">
            {formlabel for="spoiler" __text="HTML for spoiler tag"}
            {formtextinput id="spoiler" textMode="multiline" rows="3" cols="50" maxLength="200" text=$modvars.BBCode.spoiler}
            <p class="z-formnote z-informationmsg">{gt text='%h = Heading (Spoiler follows), %s = text'}</p>
        </div>
        <div class="z-formrow">
            <label>{gt text='Preview'}</label>
        </div>
        <div class="z-formnote">{$spoiler_preview|safehtml}</div>
    </div>
</fieldset>

<div class="z-formbuttons z-buttons">
    {formbutton class="z-bt-ok" commandName="save" __text="Save"}
    {formbutton class="z-bt-cancel" commandName="cancel" __text="Cancel"}
</div>

{/form}

{adminfooter}