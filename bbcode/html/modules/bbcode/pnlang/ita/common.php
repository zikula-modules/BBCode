<?php
// $Id$
// ----------------------------------------------------------------------
// LICENSE
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License (GPL)
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// To read the license please visit http://www.gnu.org/copyleft/gpl.html
// ----------------------------------------------------------------------

/**
 * @link http://code.zikula.org/projects/community-italian/
 * @translated by Arthens
 */

// begin of no-change-area
// do NOT change the following lines. Although they are not language
// relevant they are important for this module
// 0 = no highlighting
define('HILITE_NONE', 0);
// 1 = geshi with linenumbers
define('HILITE_GESHI_WITH_LN', 1);
// 2 = geshi without linenumbers
define('HILITE_GESHI_WITHOUT_LN', 2);
// 3 = google code prettifier
define('HILITE_GOOGLE', 3);
// end of no-change-area

// new in 2.0
define('_BBCODE_GOTOHOMEPAGE', 'visita il sito del progetto bbcode');
define('_BBCODE_ADMIN_START', 'Pagina Iniziale');
define('_BBCODE_ISHOOKEDWITH', 'Attualmente bbcode è utilizzato per i seguenti moduli');
define('_BBCODE_NOTHOOKED', '** nessun modulo utilizza bbcode **');
define('_BBCODE_ADDHOOK', 'Attiva bbcode per altri moduli');
define('_BBCODE_ILLEGALVALUE', 'valore non permesso, formato richiesto: fino a 4 posizioni decimali + il punto + due posizioni decimali seguite dall\'unità di misura, una tra cm,em,ex,in,mm,pc,pt,px o %. Esempio: 1.05em oo 95%');
define('_BBCODE_CODE_ENABLE', 'Abilita l\'evidenziazione del codice');
define('_BBCODE_QUOTE_ENABLE', 'Abilita l\'evidenziazione delle citazioni');
define('_BBCODE_ADMINMISCCONFIG', 'Impostazioni varie');
define('_BBCODE_IMGTAGCONFIG', 'Configurazione del tag IMG');
define('_BBCODE_LIGHTBOX_ENABLE', 'Usa Lightbox nei tag img'); 
define('_BBCODE_LIGHTBOX_PREVIEWWIDTH', 'Larghezza dell\'anteprima');
define('_BBCODE_LIGHTBOX_PREVIEWWIDTHINFO', '(50-1000px)');
define('_BBCODE_LIGHTBOX_PREVIEWHEIGHTINFO', 'L\'altezza verrà calcolata automaticamente dal browser.');
define('_BBCODE_ADMINCONFIG', 'Configurazione');
define('_BBCODE_LINK_SHRINKSIZE', 'Riduci i link a');
define('_BBCODE_LINK_SHRINKSIZEINFO', 'Riduci l\'url mostrato alla lunghezza specificata, 0=nessuna riduzione');
define('_BBCODE_CHARS', 'caratteri');
define('_BBCODE_SPOILER_ENABLE', 'Abilita il tag spoiler');
define('_BBCODE_SPOILERCODE', 'HTML èer il tag spoiler');
define('_BBCODE_SPOILERHINT', '%h = intestazione (_BBCODE_SPOILERWARNING), %s = testo.');
define('_BBCODE_SPOILERWARNING', 'Attenzione spoiler:');
define('_BBCODE_SPOILER', 'spoiler');
define('_BBCODE_SPOILER_HINT', 'nascondi testo');

define('_BBCODE_HELPURL', 'http://it.wikipedia.org/wiki/BBCode');
define('_BBCODE_HELPURL_HINT', 'Cos\'è BBCode?');
define('_BBCODE_ADMINCODECONFIG', 'Configurazione [code][/code]');
define('_BBCODE_ADMINCOLORCONFIG', 'Configurazione [color][/color]');
define('_BBCODE_ADMINISTRATION', 'Amministrazione bbcode');
define('_BBCODE_ADMINQUOTECONFIG', 'Configurazione [quote][/quote]');
define('_BBCODE_ADMINSIZECONFIG', 'Configurazione [size][/size]');
define('_BBCODE_BOLD', 'b');
define('_BBCODE_BOLD_HINT', 'testo in grassetto');
define('_BBCODE_CODE', 'Codice');
define('_BBCODE_CODEHINT', '%h = Intestazione (_BBCODE_CODE), %c=linee di codice, %j=linee di codice, con escape per javascript');
define('_BBCODE_CODE_HINT', 'inserisci il codice');
define('_BBCODE_CODE_SYNTAXHIGHLIGHTING', 'Seleziona il metodo di evidenziazione del codice');
define('_BBCODE_CODE_NOSYNTAXHIGHLIGHTING', 'nessuna evidenziazione');
define('_BBCODE_CODE_GESHIWITHLINENUMBERS', 'GeSHi con i numeri di riga');
define('_BBCODE_CODE_GESHIWITHOUTLINENUMBERS', 'GeSHi senza numeri di riga');
define('_BBCODE_CODE_GOOGLEPRETTIFIER', 'Google Code Prettifier');
define('_BBCODE_COLOR_ALLOWUSERCOLOR', 'Permetti testo di colore definito dall\'utente');
define('_BBCODE_COLOR_BLACK', 'Nero');
define('_BBCODE_COLOR_BLUE', 'Blu');
define('_BBCODE_COLOR_BROWN', 'Marrone');
define('_BBCODE_COLOR_CYAN', 'Ciano');
define('_BBCODE_COLOR_DARKBLUE', 'Blu Scuro');
define('_BBCODE_COLOR_DARKRED', 'Rosso Scuro');
define('_BBCODE_COLOR_DEFAULT', 'Standard');
define('_BBCODE_COLOR_DEFINE', 'colore definito dall\'utente');
define('_BBCODE_COLOR_ENABLE', 'Abilita testo di colore flessibile');
define('_BBCODE_COLOR_GREEN', 'Verde');
define('_BBCODE_COLOR_HINT', 'selezione il colore del font');
define('_BBCODE_COLOR_INDIGO', 'Indaco');
define('_BBCODE_COLOR_OLIVE', 'Oliva');
define('_BBCODE_COLOR_ORANGE', 'Arancio');
define('_BBCODE_COLOR_RED', 'Rosso');
define('_BBCODE_COLOR_TEXTCOLORCODE', 'inserisci il codice del colore');
define('_BBCODE_COLOR_VIOLET', 'Violetto');
define('_BBCODE_COLOR_WHITE', 'Bianco');
define('_BBCODE_COLOR_YELLOW', 'Giallo');
define('_BBCODE_CONFIGCHANGED', 'La configurazione è stata cambiata');
define('_BBCODE_ENTER_EMAIL_ADDRESS','Inserisci l\'indirizzo e-mail che vuoi mettere');
define('_BBCODE_ENTER_LIST_ITEM','Inserisci il nuovo elemento della lista. Nota che ogni lista dev\'essere preceduta da List Open e seguita da List Close');
define('_BBCODE_ENTER_PAGE_TITLE','Titolo della pagina');
define('_BBCODE_ENTER_SITE_TITLE','Inserisci il titolo della pagina');
define('_BBCODE_ENTER_TEXT_BOLD','Inserisci il testo che vuoi mettere in grassetto');
define('_BBCODE_ENTER_TEXT_ITALIC','Inserisci il testo che vuoi mettere in corsivo');
define('_BBCODE_ENTER_TEXT_UNDERLINE','Inserisci il testo che vuoi sottolineare');
define('_BBCODE_ENTER_URL','Inserisci l\'URL del link che vuoi mettere');
define('_BBCODE_ENTER_WEBIMAGE_URL','Inserisci l\'URL dell\'immagine che vuoi visualizzare');
define('_BBCODE_FONTCOLOR', 'Colore del font');
define('_BBCODE_FONTSIZE', 'Dimensione del font');
define('_BBCODE_IMAGE', 'Immagine');
define('_BBCODE_IMAGE_HINT', 'inserisci un\'immagine');
define('_BBCODE_ITALIC', 'i');
define('_BBCODE_ITALIC_HINT', 'testo in corsivo');
define('_BBCODE_LIST_HINT', 'inserisci lista');
define('_BBCODE_LISTCLOSE', '/ul');
define('_BBCODE_LISTCLOSE_HINT', 'chiudi lista');
define('_BBCODE_LISTITEM', 'li');
define('_BBCODE_LISTITEM_HINT', 'inserisci un elemento della lista');
define('_BBCODE_LISTOPEN', 'ul');
define('_BBCODE_LISTOPEN_HINT', 'apri lista');
define('_BBCODE_MAIL', 'Email');
define('_BBCODE_MAIL_HINT', 'inserisci un indirizzo e-mail');
define('_BBCODE_NO', 'No');
define('_BBCODE_NOAUTH', 'Permesso negato');
define('_BBCODE_NOSCRIPTWARNING', 'Javascript è disabilitato oppure non è supportato dal tuo browser. L\'interfaccia di bbcode è stata disattivata.');
define('_BBCODE_NOSPECIALCODE', 'nessun codice speciale');
define('_BBCODE_NOTALLOWEDTOSEEEMAILS', '*Non abilitato a vedere le e-mail*');
define('_BBCODE_NOTALLOWEDTOSEEEXTERNALLINKS', '*Non abilitato a vedere i link esterni*');
define('_BBCODE_ORIGINALSENDER', 'Da');
define('_BBCODE_PNADMINISTRATION', 'Amministrazione');
define('_BBCODE_PREVIEW','Anteprima');
define('_BBCODE_QUOTE', 'Citazione');
define('_BBCODE_QUOTEHINT', '%u = username, %t=testo citato');
define('_BBCODE_QUOTE_HINT', 'inserisci citazione');
define('_BBCODE_SELECTCODE', 'seleziona il tipo di codice');
define('_BBCODE_SIZE_ALLOWUSERSIZE', 'Abilita testo di dimensione definita dall\'utente');
define('_BBCODE_SIZE_DEFINE', 'dimensione definita dall\'utente');
define('_BBCODE_SIZE_ENABLE', 'Abilita dimensione flessibile del testo');
define('_BBCODE_SIZE_HINT', 'seleziona la dimensione del font');
define('_BBCODE_SIZE_HUGE', 'Enorme');
define('_BBCODE_SIZE_LARGE', 'Largo');
define('_BBCODE_SIZE_NORMAL', 'Normale');
define('_BBCODE_SIZE_SMALL', 'Piccolo');
define('_BBCODE_SIZE_TEXTSIZE', 'inserisci la dimensione del testo');
define('_BBCODE_SIZE_TINY', 'Minuscolo');
define('_BBCODE_UNDERLINE', 'u');
define('_BBCODE_UNDERLINE_HINT', 'testo sottolineato');
define('_BBCODE_URL', 'URL');
define('_BBCODE_URL_HINT', 'inserisci un link');
define('_BBCODE_YES', 'Sì');
