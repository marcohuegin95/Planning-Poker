$(document).ready(function () {
    $(':button').click(function () {
        if (this.id == 'button_Null') {
            console.log('Button 0: '+  $(this).val());
            setValueFromButtonToAjax($(this).val());
        }
        else if (this.id == 'button_EinHalb') {
            console.log('Button 0,5: '+  $(this).val());
            setValueFromButtonToAjax($(this).val());
        }
        else if (this.id == 'button_Eins') {
            console.log('Button 1: '+  $(this).val());
            setValueFromButtonToAjax($(this).val());
        }
        else if (this.id == 'button_Zwei') {
            console.log('Button 2: '+  $(this).val());
            setValueFromButtonToAjax($(this).val());
        }
        else if (this.id == 'button_Drei') {
            console.log('Button 3: '+  $(this).val());
            setValueFromButtonToAjax($(this).val());
        }
        else if (this.id == 'button_Fuenf') {
            console.log('Button 5: '+  $(this).val());
            setValueFromButtonToAjax($(this).val());
        }
        else if (this.id == 'button_Acht') {
            console.log('Button 8: '+  $(this).val());
            setValueFromButtonToAjax($(this).val());
        }
        else if (this.id == 'button_Dreizehn') {
            console.log('Button 13: '+  $(this).val());
            setValueFromButtonToAjax($(this).val());
        }
        else if (this.id == 'button_Zwanzig') {
            console.log('Button 20: '+  $(this).val());
            setValueFromButtonToAjax($(this).val());
        }
        else if (this.id == 'button_Vierzig') {
            console.log('Button 40: '+  $(this).val());
            setValueFromButtonToAjax($(this).val());
        }
        else if (this.id == 'buttin_Hundert') {
            console.log('Button 100: '+  $(this).val());
            setValueFromButtonToAjax($(this).val());
        }
        else if (this.id == 'button_Fragezeichen') {
            console.log('Button ?: '+  $(this).val());
            setValueFromButtonToAjax($(this).val());
        }
    });
});
// Sieht sehr umständlich aus, Schleife verwenden-> Array mit allen Buttons übergeben, schwierig da nicht alle Buttons relevant sind, sonst könnte
// man  sich das ganze HTML geben lassen und einfach den Value auslesen !?

/**
  * @desc Routine, welche Button-Value an Ajax weiterreicht und weiter verarbeitet (Wert an DB senden)
*/
function setValueFromButtonToAjax(buttonValue){
 // Ajax-Aufruf
    $.ajax({
        type: 'POST',
        url: 'database/GameDAOMySQL.php',
        data: buttonValue
    })

        // Wenn Vorgang erfolgreich ...
        .done(function (data) {
            // ... lade Daten in den Content Container
            $('#content').html(data);
        })
        // Wenn Vorgang nicht erfolgreich
        .fail(function () {
            // Konsolenausgabe
            console.log("Posting failed.");
        });

    // verhindert, dass die Seite durch das Formular neu geladen wird (Standardaktion)
    return false;

}
