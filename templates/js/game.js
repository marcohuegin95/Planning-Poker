
/**
 * Objekt in welchem alle Daten zum aktuellen Vote enthalten sind
 * Wird vom backend beim laden der seite befüllt
 */ 
var currentVote;


$(document).ready(function () {
    console.log(currentVote);
})

/**
  * @desc Routine, welche Button-Value an Ajax weiterreicht und dort verarbeitet (Wert an DB senden)
*/
function setValueFromVoteButtonToAjax(buttonValue){
 // Ajax-Aufruf
    $.ajax({
        type: 'POST',
        url: '/savepoints',
        data: {
            points: buttonValue,
            user_story: 3 //TODO hier die aktuelle id der user story laden, die gerade angezeigt wird
        }
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