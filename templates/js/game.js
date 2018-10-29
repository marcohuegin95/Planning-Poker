/**
 * Objekt in welchem alle Daten zum aktuellen Vote enthalten sind
 * Wird vom backend beim laden der seite befüllt
 */
var currentVote;

/**
 * Temp-Variablen die für die Zwischenspeicherung der Storys genutzt werden
 */
var currentUserStoryID;
var currentUserStoryCounter;
var tmpCurrentUserStoryTitle;
var tmpCurrentUserStoryDescription;

var tmpCurrentUserStoryPoints;


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
        loadVotePointsForCurrentUser(currentUserStoryID);
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
            loadVotePointsForCurrentUser(currentUserStoryID);
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
            loadVotePointsForCurrentUser(currentUserStoryID);
            //console.log("ID: " + currentUserStoryID + " Titel: " + tmpCurrentUserStoryTitle + "  Beschreibung: " + tmpCurrentUserStoryDescription);
        }
    });
});

/**
  * @desc Routine, welche Button-Value (User-Story Punkte-Abschätzung) via Ajax weiterreicht und im Backend verarbeitet
*/
function setValueFromVoteButtonToAjax(buttonValue, buttonID) {
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
            //console.log("setValueFromVoteButtonToAjax:: currentUserStoryID-> " + currentUserStoryID+" buttonValue: "+buttonValue);
            setColorVoteButton(buttonID);
            setLabelStoryPoints(buttonValue);

        })
        // Wenn Vorgang nicht erfolgreich
        .fail(function () {
            //console.log("setValueFromVoteButtonToAjax: POST nicht erfolgreich");
        });

    // verhindert, dass die Seite durch das Formular neu geladen wird (Standardaktion)
    return false;
}


/**
  * @desc Routine, welche die Punkte (Abschätzung) des aktuell angemeldeten User via Ajax aus dem Backend läd
*/
function loadVotePointsForCurrentUser(currentStoryID) {
    // Ajax-Aufruf
    $.ajax({
        type: 'GET',
        url: '/loadpointsforcurrentuser',
        data: {
            storyid: currentStoryID
        },
        success: function (data) {
            return data;
        }
    })

        // Wenn Vorgang erfolgreich dann färbe Vote-Buttons und gebe Information in Info-Box aus
        .done(function (data) {
            console.log("loadVotePointsForCurrentUser: Punkte-> " + data + " currentStoryID: " + currentStoryID);
            setColorVoteButton(setButtonColorFromPoints(data));
            setLabelStoryPoints(data);
        })
        // Wenn Vorgang nicht erfolgreich
        .fail(function () {
            console.log("loadVotePointsForCurrentUser: GET zu DB nicht erfolgreich");
        });

    // verhindert, dass die Seite durch das Formular neu geladen wird (Standardaktion)
    return false;
}

/**
  * @desc Routine, welche die Punkte (Abschätzung) des jeweils übergeben Users via Ajax aus dem Backend läd (Vote muss dabei schon abgelaufen sein)
  * 
*/
function loadVotePoints(userID) {
    // Ajax-Aufruf
    $.ajax({
        type: 'GET',
        url: '/loadpoints',
        data: {
            userid: userID,
            storyid: currentUserStoryID
        },
        success: function (data) {
            setTmpCurrentUserStoryPoints(data);
            tmpCurrentUserStoryPoints = data;
            console.log('tmpCurrentUserStoryPoints in Ajax:' + tmpCurrentUserStoryPoints);
            return data;
        }
    })

        // Wenn Vorgang erfolgreich ...
        .done(function (data) {
            console.log("loadVotePoints: Punkte-> " + data);
        })
        // Wenn Vorgang nicht erfolgreich
        .fail(function () {
            console.log("loadVotePoints: GET zu DB nicht erfolgreich");
        });

    // verhindert, dass die Seite durch das Formular neu geladen wird (Standardaktion)
    return false;
}

//////////////////////////////////////////////////////////////////////////////////////////////
// 1. Alle Teilnehmer (aus Vote-Objekt) laden
// 2. Für jeden Teilnehmer prüfen ob dieser schon abgestimmt hat (foreach->Ajax)
// 3. Anzahl Teilnehmer mit Punkten zählen und an Oberfläche ausgeben
// 4. Entsprechenden Teilnehmer in der linken Box anzeigen

function setTmpCurrentUserStoryPoints(tmpData) {
    tmpCurrentUserStoryPoints = tmpData;
    console.log('tmpData:' + tmpData);
}

$(document).ready(function () {
    console.log(currentVote);
    prepareAllCurrentMembers();

})


function prepareAllCurrentMembers() {
    var userLength = currentVote.users.length;
    var tmpNumberofMembersCurrentUserStory = 0;
    var tmpUserBoxDiv = '';
    for (var i = 0; i < userLength; ++i) {
        loadVotePoints(currentVote.users[i].id);  // Punkte laden und wenn vorhanden in tmpCurrentUserStoryPoints laden 
        console.log('tmpCurrentUserStoryPoints:' + tmpCurrentUserStoryPoints);
        if (tmpCurrentUserStoryPoints !== undefined || tmpCurrentUserStoryPoints === '') {
            tmpNumberofMembersCurrentUserStory++;
        }
        if (currentVote.users[i].username !== undefined || currentVote.users[i].username === '') {
            tmpUserBoxDiv = tmpUserBoxDiv + "<h3><div class='card'><div class='list-group-item d-flex justify-content-between align-items-center'><i class='fa fa-github-square' style='font-size:36px'></i>" +
                currentVote.users[i].username + "<span class='badge badge-primary badge-pill'>nA</span></div></div></h3>";
        }
    }
    setLabelNumberMember(tmpNumberofMembersCurrentUserStory);
    setMemberBox(tmpUserBoxDiv);
}
//////////////////////////////////////////////////////////////////////////////////////////////

function setColorVoteButton(buttonName) {
    $("#buttonAbschaetzung button").each(function () {
        $(this).removeClass("btn btn-info").addClass("btn btn-primary");
    });
    console.log('In setColorVoteButton: ' + buttonName);
    $(buttonName).removeClass("btn btn-primary").addClass("btn btn-info");
}

function deleteColorAllVoteButtons() {
    $("#buttonAbschaetzung button").each(function () {
        $(this).removeClass("btn btn-info").addClass("btn btn-primary");
    });
}

/**
  * @desc Gibt anhand eines übergebenen Wertes (Punkte Abschätzung) einen Button zurück
*/
function setButtonColorFromPoints(storyValue) {
    var values = [0, 0.5, 1, 2, 3, 5, 8, 13, 20, 40, 100, -1];
    var buttonNames = [button_Null, button_EinHalb, button_Eins, button_Zwei, button_Drei, button_Fuenf, button_Acht, button_Dreizehn, button_Zwanzig, button_Vierzig, button_Hundert, button_Fragezeichen];

    //console.log('Eingabe zuordnung: '+storyValue);
    for (var i = 0; i < values.length; ++i) {
        if (values[i] == storyValue) {
            console.log("Button gesetzt: " + buttonNames[i])
            return buttonNames[i];
        }
    }
}

/**
  * @desc Gibt die übergeben Story-Point für eine User-Story auf der Oberfläche aus 
*/
function setLabelStoryPoints(storyValue) {
    if (storyValue == '-1') {
        $("#eigeneSchaetzung").text('nicht geschätzt, da du nicht sicher bist!');
    } else if (storyValue == '1') {
        $("#eigeneSchaetzung").text('auf ' + storyValue + ' Story Point geschätzt!');
    } else {
        $("#eigeneSchaetzung").text('auf ' + storyValue + ' Story Points geschätzt!');
    }
}

/**
  * @desc Gibt die übergeben Anzahl der Teilnehmer auf der Oberfläche aus 
*/
function setLabelNumberMember(numberOfMember) {
    $("#anzahlTeilnehmerMitAbschaetzung").append(numberOfMember);
}

/**
  * @desc Gibt die übergeben Anzahl der Teilnehmer auf der Oberfläche aus 
*/
function setMemberBox(htmlCurrentUserBox) {
    //$("#currentUserBox").text(htmlCurrentUserBox);
    $("#currentUserBox").append(htmlCurrentUserBox);
}


/**
  * @desc Prüfung, ob nächste oder vorherige Story verfügbar ist. Wenn nicht wird der User-Story-Counter korrigiert
*/
function checkUserStoryID(aktuellerUserStoryCount) {
    var userStoryLength = currentVote.user_storys.length
    if (aktuellerUserStoryCount >= userStoryLength) {
        currentUserStoryCounter = 0;
        //console.log("User-Story zu hoch, bei erster anfangen")
    } else if (aktuellerUserStoryCount < 0) {
        currentUserStoryCounter = userStoryLength - 1;
        //console.log("User-Story zu niedrig, bei der letzten anfangen")
    }
}

/**
  * @desc Übergebene Werte, solange sie einen Inhalt enthalten, auf der Oberfläche ausgeben
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

