{ajaxheader modname='BBCode' filename='BBCode_admin.js'}

{adminheader}
<h3>
    <span class="icon-wrench"></span>&nbsp;{gt text="Settings"}
</h3>

<p class="alert alert-danger">{gt text="Notice! Please allow the used HTML tags in the SecurityCenter."}</p>

{form cssClass="form-horizontal" role="form"}
{formvalidationsummary}

<fieldset>
    <legend>{gt text='Configuration [code][/code]'}</legend>
    <div class="form-group">
        {formlabel class="col-lg-3 control-label" for="code_enabled" __text="Enable code highlighting"}
        <div class="col-lg-9">
            <div class="checkbox">
                {formcheckbox id="code_enabled" checked=$modvars.BBCode.code_enabled onchange="switchdisplaystate('codeconfig');"}
            </div>
        </div>
    </div>
    <div id="codeconfig">
        <div class="form-group">
            {formlabel class="col-lg-3 control-label" for="code" __text="Code"}
            <div class="col-lg-9">
                {formtextinput id="code" textMode="multiline" rows="3" cols="50" maxLength="200" text=$modvars.BBCode.code cssClass='form-control'}
                <p class="alert alert-info">{gt text='%h = Header (Code), %c=lines of code, %j=lines of code, escaped for javascript.'}</p>
            </div>
        </div>
        <div class="form-group">
            {formlabel class="col-lg-3 control-label" for="syntaxhilite" __text="Select code highlight mode"}
            <div class="col-lg-9">
                {formdropdownlist id="syntaxhilite" items=$hiliteoptions selectedValue=$modvars.BBCode.syntaxhilite cssClass='form-control'}
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 control-label">{gt text='Preview'}</label>
            <div class="col-lg-9">
                {$code_preview|safehtml}
            </div>
        </div>
    </div>
</fieldset>

<fieldset>
    <legend>{gt text='Configuration [quote][/quote]'}</legend>
    <div class="form-group">
        {formlabel class="col-lg-3 control-label" for="quote_enabled" __text="Enable quote highlighting"}
        <div class="col-lg-9">
            <div class="checkbox">
                {formcheckbox id="quote_enabled" checked=$modvars.BBCode.quote_enabled onchange="switchdisplaystate('quoteconfig');"}
            </div>
        </div>
    </div>
    <div id="quoteconfig">
        <div class="form-group">
            {formlabel class="col-lg-3 control-label" for="quote" __text="Quote"}
            <div class="col-lg-9">
                {formtextinput id="quote" textMode="multiline" rows="3" cols="50" maxLength="200" text=$modvars.BBCode.quote cssClass='form-control'}
                <p class="alert alert-info">{gt text='%u = username, %t=quoted text'}</p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 control-label">{gt text='Preview'}</label>
            <div class="col-lg-9">
                {$quote_preview|safehtml}
            </div>
        </div>
    </div>
</fieldset>

<fieldset>
    <legend>{gt text='Configuration [color][/color]'}</legend>
    <div class="form-group">
        {formlabel class="col-lg-3 control-label" for="color_enabled" __text="Enable flexible text colors"}
        <div class="col-lg-9">
            <div class="checkbox">
                {formcheckbox id="color_enabled" checked=$modvars.BBCode.color_enabled onchange="switchdisplaystate('colorconfig');"}
            </div>
        </div>
    </div>
    <div class="form-group">
        {formlabel class="col-lg-3 control-label" for="allow_usercolor" __text="Allow userdefined text color"}
        <div class="col-lg-9">
            <div class="checkbox">
                {formcheckbox id="allow_usercolor" checked=$modvars.BBCode.allow_usercolor}
            </div>
        </div>
    </div>
</fieldset>

<fieldset>
    <legend>{gt text='Configuration [size][/size]'}</legend>
    <div class="form-group">
        {formlabel class="col-lg-3 control-label" for="size_enabled" __text="Enable flexible text size"}
        <div class="col-lg-9">
            <div class="checkbox">
                {formcheckbox id="size_enabled" checked=$modvars.BBCode.size_enabled onchange="switchdisplaystate('sizeconfig');"}
            </div>
        </div>
    </div>
    <div id="sizeconfig">
        <div class="form-group">
            {formlabel class="col-lg-3 control-label" for="size_tiny" __text="Tiny"}
            <div class="col-lg-9">
                <div class="col-lg-2">
                    {formtextinput id="size_tiny" text=$modvars.BBCode.size_tiny|safehtml size="20" maxLength="30" cssClass='form-control'}
                </div>
                <span style="font-size: {$modvars.BBCode.size_tiny};">TestTESTtest</span>
            </div>
        </div>
        <div class="form-group">
            {formlabel class="col-lg-3 control-label" for="size_small" __text="Small"}
            <div class="col-lg-9">
                <div class="col-lg-2">
                    {formtextinput id="size_small" text=$modvars.BBCode.size_small|safehtml size="20" maxLength="30" cssClass='form-control'}
                </div>
                <span style="font-size: {$modvars.BBCode.size_small};">TestTESTtest</span>
            </div>
        </div>
        <div class="form-group">
            {formlabel class="col-lg-3 control-label" for="size_normal" __text="Normal"}
            <div class="col-lg-9">
                <div class="col-lg-2">
                    {formtextinput id="size_normal" text=$modvars.BBCode.size_normal|safehtml size="20" maxLength="30" cssClass='form-control'}
                </div>
                <span style="font-size: {$modvars.BBCode.size_normal};">TestTESTtest</span>
            </div>
        </div>
        <div class="form-group">
            {formlabel class="col-lg-3 control-label" for="size_large" __text="Large"}
            <div class="col-lg-9">
                <div class="col-lg-2">
                    {formtextinput id="size_large" text=$modvars.BBCode.size_large|safehtml size="20" maxLength="30" cssClass='form-control'}
                </div>
                <span style="font-size: {$modvars.BBCode.size_large};">TestTESTtest</span>
            </div>
        </div>
        <div class="form-group">
            {formlabel class="col-lg-3 control-label" for="size_huge" __text="Huge"}
            <div class="col-lg-9">
                <div class="col-lg-2">
                    {formtextinput id="size_huge" text=$modvars.BBCode.size_huge|safehtml size="20" maxLength="30" cssClass='form-control'}
                </div>
                <span style="font-size: {$modvars.BBCode.size_huge};">TestTESTtest</span>
            </div>
        </div>
        <div class="form-group">
            {formlabel class="col-lg-3 control-label" for="allow_usersize" __text="Allow userdefined text size"}
            <div class="col-lg-9">
                <div class="checkbox">
                    {formcheckbox id="allow_usersize" checked=$modvars.BBCode.allow_usersize}
                </div>
            </div>
        </div>
    </div>
</fieldset>

<fieldset>
    <legend>{gt text='Configuration of mimeTeX integration [math][/math]'}</legend>
    <div class="form-group">
        {formlabel class="col-lg-3 control-label" for="mimetex_enabled" __text="Enable mimeTeX support"}
        <div class="col-lg-9">
            <div class="checkbox">
                {formcheckbox id="mimetex_enabled" checked=$modvars.BBCode.mimetex_enabled onchange="switchdisplaystate('mimetexconfig');"}
            </div>
        </div>
    </div>
    <div id="mimetexconfig">
        <div class="form-group">
            {formlabel class="col-lg-3 control-label" for="mimetex_url" __text="Full URL to the mimeTeX cgi script"}
            <div class="col-lg-9">
                {formtextinput id="mimetex_url" text=$modvars.BBCode.mimetex_url|safehtml size="20" maxLength="99" cssClass='form-control'}
                <p class="help-block">{gt text="Please use an own mimeTeX installation for your website!"}</p>
            </div>
            <div>
                {if $mimetex_url ne ""}
                {gt text="Test image for mimeTeX"}: [math]a^2+b^2=c^2[/math]<br />
                <img src="{$mimetex_url}?a^2+b^2=c^2" alt='' />
                {else}
                {gt text="Enter URl to your mimeTeX installation and you will see a test image here"}
                {/if}
            </div>
        </div>
    </div>
</fieldset>

<fieldset>
    <legend>{gt text='Miscellaneous settings'}</legend>
    <div class="form-group">
        {formlabel class="col-lg-3 control-label" for="link_shrinksize" __text="Shrink links to"}
        <div class="col-lg-9">
            <div class='clearfix'>
                <div class="col-lg-2">{formintinput id="link_shrinksize" minValue="0" maxValue="50" size="2" text=$modvars.BBCode.link_shrinksize cssClass='form-control'}</div>
                &nbsp;{gt text="chars"}
            </div>
            <p class="alert alert-info">{gt text="Shrinks the urls shown to the specified length (0=no action)."}</p>
        </div>
    </div>
    <div class="form-group">
        {formlabel class="col-lg-3 control-label" for="lightbox_enabled" __text="Use Lightbox or the Zikula Imageviewer in img-tag"}
        <div class="col-lg-9">
            <div class="checkbox">
                {formcheckbox id="lightbox_enabled" checked=$modvars.BBCode.lightbox_enabled onchange="switchdisplaystate('lightboxconfig');"}
            </div>
        </div>
    </div>
    <div id="lightboxconfig">
        <div class="form-group">
            {formlabel class="col-lg-3 control-label" for="lightbox_previewwidth" __text="Width of preview image"}
            <div class="col-lg-9">
                <div class='clearfix'>
                    <div class="col-lg-2">{formintinput id="lightbox_previewwidth" minValue="50" maxValue="1000" size="4" text=$modvars.BBCode.lightbox_previewwidth cssClass='form-control'}</div>
                    px&nbsp;{gt text="(50-1000px)"}
                </div>
                <p class="alert alert-info">{gt text="Height will be calculated by the browser automatically."}</p>
            </div>
        </div>
    </div>
    <div class="form-group">
        {formlabel class="col-lg-3 control-label" for="spoiler_enabled" __text="Enable spoiler tag"}
        <div class="col-lg-9">
            <div class="checkbox">
                {formcheckbox id="spoiler_enabled" checked=$modvars.BBCode.spoiler_enabled onchange="switchdisplaystate('spoilerconfig');"}
            </div>
        </div>
    </div>
    <div id="spoilerconfig">
        <div class="form-group">
            {formlabel class="col-lg-3 control-label" for="spoiler" __text="HTML for spoiler tag"}
            <div class="col-lg-9">
                {formtextinput id="spoiler" textMode="multiline" rows="3" cols="50" maxLength="200" text=$modvars.BBCode.spoiler cssClass='form-control'}
                <p class="alert alert-info">{gt text='%h = Heading (Spoiler follows), %s = text'}</p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 control-label">{gt text='Preview'}</label>
            <div class="col-lg-9">
                {$spoiler_preview|safehtml}
            </div>
        </div>
    </div>
</fieldset>

    <div class="col-lg-offset-3 col-lg-9">
    {formbutton class="btn btn-success" commandName="save" __text="Save"}
    {formbutton class="btn btn-danger" commandName="cancel" __text="Cancel"}
</div>

{/form}

{adminfooter}