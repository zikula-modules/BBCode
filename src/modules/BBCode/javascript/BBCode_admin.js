/* ----------------------------------------------------------- */
/* Javascript for admin functions                              */
/* ----------------------------------------------------------- */

Event.observe(window, 'load', function() {
                                            if(codeenabled==false) { toggleconfig('codeconfig'); }
                                            if(colorenabled==false) { toggleconfig('colorconfig'); }
                                            if(quoteenabled==false) { toggleconfig('quoteconfig'); }
                                            if(sizeenabled==false) { toggleconfig('sizeconfig'); }
                                            if(lightboxenabled==false) { toggleconfig('lightboxconfig'); }
                                            if(mimetexenabled==false) { toggleconfig('mimetexconfig'); }
                                            if(spoilerenabled==false) { toggleconfig('spoilerconfig'); }
                                         }, false);

function toggleconfig(config)
{
    if($(config)) {
        $(config).toggle();
    }
}
