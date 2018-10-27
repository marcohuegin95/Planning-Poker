
/**
 * Objekt in welchem alle Daten zum aktuellen Vote enthalten sind
 * Wird vom backend beim laden der seite befüllt
 */
var currentVote;

// Temp-Variablen die für die Zwischenspeicherung der Storys genutzt werden
var currentUserStoryID;
var currentUserStoryCounter;
var tmpCurrentUserStoryTitle;
var tmpCurrentUserStoryDescription;


/**
  * @desc Routine, welche die User-Story aus dem currentVote-Objekt liest und weiter verarbeitet
  *       Es wird geprüft, ob schon eine User-Story ausgegeben wurde (currentUserStoryCounter === "undefined").
  *       Danach wird auf das Button Event gelauscht, ob die nächste oder vorherige User-Story angezeigt werden soll
*/
$(document).ready(function () {
    if (typeof currentUserStoryCounter === "undefined") {
        currentUserStoryCounter = 0;
        currentUserStoryID = currentVote.user_storys[currentUserStoryCounter].id;
        tmpCurrentUserStoryTitle = currentVote.user_storys[currentUserStoryCounter].title;
        tmpCurrentUserStoryDescription = currentVote.user_storys[currentUserStoryCounter].description;
        setUserStory(tmpCurrentUserStoryTitle, tmpCurrentUserStoryDescription, currentUserStoryCounter + 1);
        //console.log("ID: " + currentUserStoryID + " Titel: " + tmpCurrentUserStoryTitle + "  Beschreibung: " + tmpCurrentUserStoryDescription);
    }
    $("#storyVorwaerts").click(function () {
        if (typeof currentUserStoryCounter !== "undefined") {
            currentUserStoryCounter = currentUserStoryCounter + 1;
            checkUserStoryID(currentUserStoryCounter);
            currentUserStoryID = currentVote.user_storys[currentUserStoryCounter].id;
            tmpCurrentUserStoryTitle = currentVote.user_storys[currentUserStoryCounter].title;
            tmpCurrentUserStoryDescription = currentVote.user_storys[currentUserStoryCounter].description;
            setUserStory(tmpCurrentUserStoryTitle, tmpCurrentUserStoryDescription, currentUserStoryCounter + 1);
            //console.log("ID: " + currentUserStoryID + " Titel: " + tmpCurrentUserStoryTitle + "  Beschreibung: " + tmpCurrentUserStoryDescription);
        }
    });
    $("#storyZurueck").click(function () {
        if (typeof currentUserStoryCounter !== "undefined") {
            currentUserStoryCounter = currentUserStoryCounter - 1;
            checkUserStoryID(currentUserStoryCounter);
            currentUserStoryID = currentVote.user_storys[currentUserStoryCounter].id;
            tmpCurrentUserStoryTitle = currentVote.user_storys[currentUserStoryCounter].title;
            tmpCurrentUserStoryDescription = currentVote.user_storys[currentUserStoryCounter].description;
            setUserStory(tmpCurrentUserStoryTitle, tmpCurrentUserStoryDescription, currentUserStoryCounter + 1);
            //console.log("ID: " + currentUserStoryID + " Titel: " + tmpCurrentUserStoryTitle + "  Beschreibung: " + tmpCurrentUserStoryDescription);
        }
    });
});

/**
  * @desc Prüfung, ob nächste oder vorherige Story verfügbar ist. Wenn nicht wird der User-Story-Counter korrigiert
*/
function checkUserStoryID(aktuellerUserStoryCount) {
    var userStoryLength = currentVote.user_storys.length
    if (aktuellerUserStoryCount >= userStoryLength) {
        currentUserStoryCounter = 0;
        console.log("User-Story zu hoch, bei erster anfangen")
    } else if (aktuellerUserStoryCount < 0) {
        currentUserStoryCounter = userStoryLength - 1;
        console.log("User-Story zu niedrig, bei der letzten anfangen")
    }
}

/**
  * @desc Übergebene Werte, solange sie einen Inhalt enthalten, auf der Oberläche ausgeben
*/
function setUserStory(title, description, storyNr) {
    if ((title !== '') || (description !== '') || (storyNr !== '')) {
        $("#aktuelleUserStoryTitel").text(title);
        $("#aktuelleUserStoryBeschreibung").text(description);
        $("#aktuelleUserStoryNr").text(storyNr);
    } else {
        console.log("Keine Daten für User-Story-Anzeige übergeben!");
    }
}

// Anzahl der Gesamtstorys aulesen aus currentVote-Objekt und an der Oberfläche anzeigen
$(document).ready(function () {
    $("#anzahlStorys").text(currentVote.user_storys.length);
})


$(document).ready(function () {
    console.log(currentVote);
})

/**
  * @desc Routine, welche Button-Value an Ajax weiterreicht und dort verarbeitet (Wert an DB senden)
*/
function setValueFromVoteButtonToAjax(buttonValue, id) {
    // Ajax-Aufruf
    $.ajax({
        type: 'POST',
        url: '/savepoints',
        data: {
            points: buttonValue,
            user_story: currentUserStoryID
        }
    })


        // Wenn Vorgang erfolgreich ...
        .done(function (data) {
            console.log("POST an DB erfolgreich");
            setColorVoteButton(id);

        })
        // Wenn Vorgang nicht erfolgreich
        .fail(function () {
            // Konsolenausgabe
            console.log("POST zu DB nicht erfolgreich");
        });



    // verhindert, dass die Seite durch das Formular neu geladen wird (Standardaktion)
    return false;
}

function setColorVoteButton(id) {
    // Bei erfolgreicher Daten-Übermittlung Button umfärben
    $("#buttonAbschaetzung button").each(function () {
        $(this).removeClass("btn btn-info").addClass("btn btn-primary");
    });
    $(id).removeClass("btn btn-primary").addClass("btn btn-info");
}

function setUserStoryPoints() {

}