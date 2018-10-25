/**
  * @desc Routine, welche Button-Value an Ajax weiterreicht und dort verarbeitet (Wert an DB senden)
*/
function setValueFromVoteButtonToAjax(buttonValue){
 // Ajax-Aufruf
    $.ajax({
        type: 'POST',
        dataType: 'jsonp',
        url: 'http://database/Game',
        data: {action: buttonValue}
    })

        // Wenn Vorgang erfolgreich ...
        .done(function (data) {
            console.log("POST an DB erfolgreich");
        })
        // Wenn Vorgang nicht erfolgreich
        .fail(function () {
            // Konsolenausgabe
            console.log("POST zu DB nicht erfolgreich");
        });

    // verhindert, dass die Seite durch das Formular neu geladen wird (Standardaktion)
    return false;

}