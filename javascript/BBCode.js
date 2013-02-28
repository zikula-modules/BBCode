/* ----------------------------------------------------- */
/* Javascript for inserting text at the cursor position  */
/* based on a script found on http://de.selfhtml.org     */
/* original author: Torsten Anacker, torsten@anaboe.net  */
/* adapted by frank.schummertz@landseer-stuttgart.de     */
/* ----------------------------------------------------- */

// var tracks element with last focus
var bbcodeLastFocus = '';

// add onload event handler
Event.observe(window, 'load', function() {
    $$('.bbcode').each(function(el) {
        el.removeClassName('hidden');
    });
    var textareaCount = $$('textarea').size();
    if (textareaCount > 1) {
        bbcodeLastFocus = $$('textarea').first();
        // setup onBlur() listener to track which element was last in focus
        $$('textarea', 'input', 'select').invoke('observe', 'blur', function(event) {
            bbcodeLastFocus = event.target;
        });
    } else {
        bbcodeLastFocus = $$('textarea').first();
    }
}, false);
                                        
function AddBBCode(action, optdata)
{
    var aTag, eTag, textasparam;

    if(action=="" || action==null) {
        alert('internal error: action not set');
        return;
    }
    
    // set textfield element to last focused element
    var textfield = bbcodeLastFocus;
    
    // if element is not a textarea then do nothing
    if (textfield.tagName != 'TEXTAREA') {
        alert('select a textarea first!') // needs translation
        return;
    }

    // set to true of the the selected text shall be used as parameter for the opening tag,
    // like in [url=http://..]http://...[/url]
    // default is false
    textasparam = false;

    switch(action) {
        case "code":
            aTag = "[code" + check_optdata(optdata, "=") + "]";
            eTag = "[/code]";
            break;
        case "size":
            aTag = "[size" + check_optdata(optdata, "=") + "]";
            eTag = "[/size]";
            break;
        case "color":
            aTag = "[color" + check_optdata(optdata, "=") + "]";
            eTag = "[/color]";
            break;
        case "url":
            aTag = "[url]";
            eTag = "[/url]";
            textasparam = true;
            break;
        case "email":
            aTag = "[email]";
            eTag = "[/email]";
            break;
        case "italic":
            aTag = "[i]";
            eTag = "[/i]";
            break;
        case "bold":
            aTag = "[b]";
            eTag = "[/b]";
            break;
        case "underline":
            aTag = "[u]";
            eTag = "[/u]";
            break;
        case "image":
            aTag = "[img]";
            eTag = "[/img]";
            break;
        case "quote":
            aTag = "[quote]";
            eTag = "[/quote]";
            break;
        case "spoiler":
            aTag = "[spoiler]";
            eTag = "[/spoiler]";
            break;
        case "listopen":
            aTag = "[list]";
            eTag = "";
            break;
        case "listclose":
            aTag = "";
            eTag = "[/list]";
            break;
        case "listitem":
            aTag = "[*]";
            eTag = "";
            break;
        default:
            // unknown action just enter nothing
            // maybe alerting the user is a better idea??
            aTag = "";
            eTag = "";
    }

    var insText = '';
    //
    // for Internet Explorer
    //
    if(typeof document.selection != 'undefined') {
        textfield.focus();
        var range = document.selection.createRange();
        insText = range.text;

        // special treatment for tags like url that use the selected txt as parameter for the
        // opening tag too
        if( (textasparam == true) && (insText.length != 0) ) {
            // expand [tag] to [tag=insText]
            aTag = aTag.substr(0, aTag.length - 1) + "=" + insText + "]";
        }
        range.text = aTag + insText + eTag;

        // adjust cursorposition
        range = document.selection.createRange();
        // if no text was selected...
        if (insText.length == 0) {
            // ... set cursor behind opening tag
            range.move('character', -eTag.length);
        } else {
            // ... else set cursor behind the closing tag
            range.moveStart('character', aTag.length + insText.length + eTag.length);
        }
        range.select();
    }
    //
    // for Gecko based browsers
    //
    else if(typeof textfield.selectionStart != 'undefined')
    {
        var start = textfield.selectionStart;
        var end = textfield.selectionEnd;
        insText = textfield.value.substring(start, end);

        // special treatment for tags like url that use the selected txt as parameter for the
        // opening tag too
        if( (textasparam == true) && (insText.length != 0) ) {
            // expand [tag] to [tag=insText]
            aTag = aTag.substr(0, aTag.length - 1) + "=" + insText + "]"
        }
        textfield.value = textfield.value.substr(0, start) + aTag + insText + eTag + textfield.value.substr(end);

        // adjust cursorposition
        var pos;
        // if no text was selected...
        if (insText.length == 0) {
            // ... set cursor behind opening tag
            pos = start + aTag.length;
        } else {
            // ... else set cursor behind the closing tag
            pos = start + aTag.length + insText.length + eTag.length;
        }

        textfield.selectionStart = pos;
        textfield.selectionEnd = pos;
    }
    //
    // for all other browsers
    //
    else
    {
        // insert at end
        textfield.value = textfield.value + aTag + eTag;
    }
    textfield.focus();
}

/*
 * checks if optional data is set and prepends and/or appends strings
 */
function check_optdata(optdata, prepend, append)
{
    if(prepend==null) {
        prepend = "";
    }
    if(append==null) {
        append = "";
    }
    if(optdata==null) {
        optdata = "";
    }
    if(optdata != "") {
        optdata = prepend + optdata + append;
    }
    return optdata;
}
