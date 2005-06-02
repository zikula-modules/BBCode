/*
 * new bbcode javascript
 */
function AddBBCode(textfieldname, action, optdata)
{
    var textfieldname, action, optdata, textfield, bbcode;

    if(action=="" || action==null) {
        alert('internal error: action not set');
        return;
    }
    textfield = document.getElementById(textfieldname);
    if(textfield==null) {
        alert('internal error: unknown textfieldname supplied');
        return;
    }
    switch(action) {
        case "code":
            bbcode = "[code" + check_optdata(optdata, "=") + "][/code]";
            break;
        case "size":
            bbcode = "[size" + check_optdata(optdata, "=") + "][/size]";
            break;
        case "color":
            bbcode = "[color" + check_optdata(optdata, "=") + "][/color]";
            break;
        case "url":
            bbcode = "[url" + check_optdata(prompt("Escriba la URL del enlace que quiere añadir", "http://"), "=") + "]"
                            + check_optdata(prompt("Escriba el nombre del sitio web", "Nombre del sitio")) + "[/url]";
            break;
        case "email":
            bbcode = "[email]" + check_optdata(prompt("Escriba la dirección de email que quiere añadir", "")) + "[/email]";
            break;
        case "italic":
            bbcode = "[i]" + check_optdata(prompt("Escriba el texto que quiere poner en cursiva", "")) + "[/i]";
            break;
        case "bold":
            bbcode = "[b]" + check_optdata(prompt("Escriba el texto que quiere poner en negrita", "")) + "[/b]";
            break;
        case "underline":
            bbcode = "[u]" + check_optdata(prompt("Escriba el texto que quiere poner subrayado", "")) + "[/u]";
            break;
        case "image":
            bbcode = "[img]" + check_optdata(prompt("Escriba la URL de la imagen que quiere mostrar", "http://")) + "[/img]";
            break;
        case "quote":
            bbcode = "[quote][/quote]";
            break;
        case "listopen":
            bbcode = "[list]"
            break;
        case "listclose":
            bbcode = "[/list]";
            break;
        case "listitem":
            bbcode = "[*]" + check_optdata(prompt("Introduzca el nuevo elemento de la lista. Cada grupo de elementos debe comenzar con un Inicio de Lista y finalizar con Fin de Lista", ""));
            break;
        default:
            bbcode = "";
    }

    textfield.value = textfield.value + bbcode;
    textfield.focus();
    return;


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

/* backwards ompatibility */
function DoSize (font_size) {
    AddBBCode('post', 'size', font_size);
    return;
}

function DoColor (font_color) {
    AddBBCode('post', 'color', font_color);
    return;
}

function DoCode (code) {
    AddBBCode('post', 'code', code);
    return;
}

function DoPrompt(action) {
    AddBBCode('post', 'action');
    return;
}
