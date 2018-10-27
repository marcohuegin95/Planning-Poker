<?php 

/**
 * InputFilter
 *
 * Entfernt HTML Sonderzeichen aus der POST Anfrage
 * @author Timon Müller-Wessling
 */
class InputFilter implements Filter{
    
    function filter(){
        foreach($_POST as $key=>$value) {
            $_POST[$key] = htmlspecialchars($value);
        }
    }

}

?>