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

define('_BBCODE_HELPURL', 'http://fr.wikipedia.org/wiki/BBCode');
define('_BBCODE_HELPURL_HINT', 'what is BBCode?');
define('_BBCODE_ADMINCODECONFIG', 'Configuration de [code][/code]');
define('_BBCODE_ADMINCOLORCONFIG', 'Configuration de [color][/color]');
define('_BBCODE_ADMINISTRATION', 'Administration de bbcode');
define('_BBCODE_ADMINQUOTECONFIG', 'Configuration de [quote][/quote]');
define('_BBCODE_ADMINSIZECONFIG', 'Configuration de [size][/size]');
define('_BBCODE_BOLD', 'b');
define('_BBCODE_BOLD_HINT', 'texte gras');
define('_BBCODE_CODE', 'Code');
define('_BBCODE_CODE_HINT', 'insérer du code');
define('_BBCODE_COLOR_BLACK', 'Noir');
define('_BBCODE_COLOR_BLUE', 'Bleu');
define('_BBCODE_COLOR_BROWN', 'Marron');
define('_BBCODE_COLOR_CYAN', 'Cyan');
define('_BBCODE_COLOR_DARKBLUE', 'Bleu foncé');
define('_BBCODE_COLOR_DARKRED', 'Rouge foncé');
define('_BBCODE_COLOR_DEFAULT', 'Standard');
define('_BBCODE_COLOR_DEFINE', 'couleur personnalisée');
define('_BBCODE_COLOR_GREEN', 'Vert');
define('_BBCODE_COLOR_HINT', 'sélectionner la couleur du texte');
define('_BBCODE_COLOR_INDIGO', 'Indigo');
define('_BBCODE_COLOR_OLIVE', 'Olive');
define('_BBCODE_COLOR_ORANGE', 'Orange');
define('_BBCODE_COLOR_RED', 'Rouge');
define('_BBCODE_COLOR_TEXTCOLORCODE', 'entrez le code de la couleur');
define('_BBCODE_COLOR_VIOLET', 'Violet');
define('_BBCODE_COLOR_WHITE', 'Blanc');
define('_BBCODE_COLOR_YELLOW', 'Jaune');
define('_BBCODE_ENTER_EMAIL_ADDRESS','Entrez l\'adresse email que vous désirez ajouter :');
define('_BBCODE_ENTER_LIST_ITEM','Entrez la nouvelle liste des items. Notez que chaque liste doit commencer par une ouverture de liste et se terminer par une fermeture de liste :');
define('_BBCODE_ENTER_PAGE_TITLE','Titre de la page :');
define('_BBCODE_ENTER_SITE_TITLE','Entrez le titre du site web :');
define('_BBCODE_ENTER_TEXT_BOLD','Entrer le texte que vous voulez mettre en gras :');
define('_BBCODE_ENTER_TEXT_ITALIC','Entrer le texte que vous voulez mettre en italique :');
define('_BBCODE_ENTER_TEXT_UNDERLINE','entrez le texte à souligner');
define('_BBCODE_ENTER_URL','Entrez l\'URL du lien à ajouter :');
define('_BBCODE_ENTER_WEBIMAGE_URL','Entrez l\'URL de l\'image que vous voulre afficher :');
define('_BBCODE_FONTCOLOR', 'Couleur de la police');
define('_BBCODE_FONTSIZE', 'Taille de la police');
define('_BBCODE_IMAGE', 'Image');
define('_BBCODE_IMAGE_HINT', 'insérer une image');
define('_BBCODE_ITALIC', 'i');
define('_BBCODE_ITALIC_HINT', 'texte italique');
define('_BBCODE_LIST_HINT', 'insert list');
define('_BBCODE_LISTCLOSE', '/ul');
define('_BBCODE_LISTCLOSE_HINT', 'fin de liste');
define('_BBCODE_LISTITEM', 'li');
define('_BBCODE_LISTITEM_HINT', 'élément de liste');
define('_BBCODE_LISTOPEN', 'ul');
define('_BBCODE_LISTOPEN_HINT', 'debut de liste');
define('_BBCODE_MAIL', 'Adresse email');
define('_BBCODE_MAIL_HINT', 'insérer une adresse email');
define('_BBCODE_QUOTE', 'Quote');
define('_BBCODE_QUOTE_HINT', 'insérer une citation');
define('_BBCODE_SIZE_DEFINE', 'taille personnalisée');
define('_BBCODE_SIZE_HINT', 'Sélectionner la taille de la police');
define('_BBCODE_SIZE_HUGE', 'Géant');
define('_BBCODE_SIZE_LARGE', 'Grand');
define('_BBCODE_SIZE_NORMAL', 'Normal');
define('_BBCODE_SIZE_SMALL', 'Petit');
define('_BBCODE_SIZE_TEXTSIZE', 'entrer la taille du texte');
define('_BBCODE_SIZE_TINY', 'Minuscule');
define('_BBCODE_UNDERLINE', 'u');
define('_BBCODE_UNDERLINE_HINT', 'texte souligné');
define('_BBCODE_URL', 'URL');
define('_BBCODE_URL_HINT', 'insérer un lien');
define('_BBCODE_CODE', 'Code');
define('_BBCODE_CODEBODYEND', 'Fin du corps du code');
define('_BBCODE_CODEBODYSTART', 'Début du corps du code');
define('_BBCODE_CODEHEADEREND', 'Fin de l\'en-tête du code');
define('_BBCODE_CODEHEADERSTART', 'Début de l\'en-tête du code');
define('_BBCODE_COLOR_ALLOWUSERCOLOR', 'Permettre à l\'utilisateur de définir des couleurs');
define('_BBCODE_COLOR_ENABLE', 'Permettre d\'autres couleurs de texte');
define('_BBCODE_CONFIGCHANGED', 'La configuration a été modifiée');
define('_BBCODE_ENTER_WEBIMAGE_URL','Entrez l\'URL de l\'image que vous voulez afficher :');
define('_BBCODE_NO', 'Non');
define('_BBCODE_NOAUTH', 'Pas de permission');
define('_BBCODE_PNADMINISTRATION', 'Administration');
define('_BBCODE_PREVIEW','Aperçu');
define('_BBCODE_QUOTE', 'Citation');
define('_BBCODE_QUOTEBODYEND', 'Fin du corps de citation');
define('_BBCODE_QUOTEBODYSTART', 'Début du corps de citation');
define('_BBCODE_QUOTEHEADEREND', 'Fin de l\'en-tête de citation');
define('_BBCODE_QUOTEHEADERSTART', 'Début de l\'en-tête de citation');
define('_BBCODE_SIZE_ALLOWUSERSIZE', 'Permettre à l\'utilisateur de définir des tailles de texte');
define('_BBCODE_SIZE_ENABLE', 'Permettre d\'autres tailles de texte');
define('_BBCODE_SIZE_HUGE', 'Géant');
define('_BBCODE_SIZE_LARGE', 'Grand');
define('_BBCODE_SIZE_NORMAL', 'Normal');
define('_BBCODE_SIZE_SMALL', 'Petit');
define('_BBCODE_SIZE_TINY', 'Minuscule');
define('_BBCODE_YES', 'Oui');
