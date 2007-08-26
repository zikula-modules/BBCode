/* ----------------------------------------------------- */
/* $Id: pn_bbcode.js 149 2007-08-26 19:32:55Z landseer $ */
/* Javascript for admin functions                        */
/* ----------------------------------------------------- */

Event.observe(window, 'load', function() {
                                            if(codeenabled==false) { toggleconfig('codeconfig'); }
                                            if(colorenabled==false) { toggleconfig('colorconfig'); }
                                            if(quoteenabled==false) { toggleconfig('quoteconfig'); }
                                            if(sizeenabled==false) { toggleconfig('sizeconfig'); }
                                            if(lightboxenabled==false) { toggleconfig('lightboxconfig'); }
                                         }, false);

function toggleconfig(config)
{
    if($(config)) {
        $(config).toggleClassName('hidden');
    }
}
