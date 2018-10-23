/**
  * @desc jQuery-Funktion, welche das Handling (Event) steuert, wenn der Benutzer ein Titel in das Titel-Feld eingibt
*/
var inputTitel = document.getElementById("in_titelNeuesProjekt");
inputTitel.addEventListener("input", function () {
    var minCharTitel = 4;
    var maxCharTitel = 15;
    if (($(inputTitel).val().length >= minCharTitel) && ($(inputTitel).val().length < maxCharTitel)) {
        $('#warnungTitel').html("");
    } else {
        $('#warnungTitel').html("(Bitte einen gültigen Titel wählen, 4-15 Zeichen)");
    }
})

//https://stackoverflow.com/questions/16668906/onclick-on-bootstrap-button (20.10.2018)
/**
  * @desc jQuery-Funktion, welche das Handling steuert, wenn der Button um einen neuen Teilnehmer hinzuzufügen gedrückt wird 
*/
var hinzufuegeButton = document.getElementById("btn_teilnehmerHinzufuegen");
var inputTeilnehmer = document.getElementById("in_teilnehmerHinzufuegen");
var ul = document.querySelector("ul");

hinzufuegeButton.addEventListener("click", function () {
    if ($(inputTeilnehmer).val()) {
        $('#warnungTeilnehmerHinzufuegen').html("");
        var li = document.createElement("li");
        // Bootstrap-Klasse zum List-Item(li) hinzufügen
        li.classList.add("list-group-item");
        li.appendChild(document.createTextNode(inputTeilnehmer.value));
        ul.appendChild(li);
        // Eingabe in Inputfeld löschen
        inputTeilnehmer.value = "";
    } else {
        $('#warnungTeilnehmerHinzufuegen').html("(Bitte einen Username angeben!)");
    }
})

// https://bootsnipp.com/snippets/featured/dynamic-sortable-tables (20.10.2018)
/**
  * @desc jQuery-Funktion, welche das Handling steuert, wenn eine neue User-Story erstellt wird.
*/
$(document).ready(function () {
    $("#btn_storyHinzufuegen").on("click", function () {
        // Get max row id and set new id
        var newid = 0;
        $.each($("#tab_logic tr"), function () {
            if (parseInt($(this).data("id")) > newid) {
                newid = parseInt($(this).data("id"));
            }
        });
        newid++;

        var tr = $("<tr></tr>", {
            id: "addr" + newid,
            "data-id": newid
        });

        // loop through each td and create new elements with name of newid
        $.each($("#tab_logic tbody tr:nth(0) td"), function () {
            var cur_td = $(this);

            var children = cur_td.children();

            // add new td and element if it has a nane
            if ($(this).data("name") != undefined) {
                var td = $("<td></td>", {
                    "data-name": $(cur_td).data("name")
                });

                var c = $(cur_td).find($(children[0]).prop('tagName')).clone().val("");
                c.attr("name", $(cur_td).data("name") + newid);
                c.appendTo($(td));
                td.appendTo($(tr));
            } else {
                var td = $("<td></td>", {
                    'text': $('#tab_logic tr').length
                }).appendTo($(tr));
            }
        });

        // add delete button and td
        $("<td></td>").append(
            $("<button type='button' class='btn btn-danger'>Löschen</button>")
                .click(function () {
                    $(this).closest("tr").remove();
                })
        ).appendTo($(tr));


        // add the new row
        $(tr).appendTo($('#tab_logic'));

        $(tr).find("td button.row-remove").on("click", function () {
            $(this).closest("tr").remove();
        });
    });
});

/**
  * @desc jQuery-Funktion, welche das Handling (Event) steuert, wenn der Benutzer eine neue User-Story hinzufügt.
  *       Es müssen erst die bestehende User-Input-Felder (Story-Titel und Beschreibung) ausgefüllt werden
*/
var buttonStoryHinzufuegen = document.getElementById("btn_storyHinzufuegen");
var inputStoryTitel = document.getElementById("in_storyTitel");
var inputStoryBeschreibung = document.getElementById("in_storyBeschreibung");

inputTitel.addEventListener("input", function () {
    if (($(inputTitel).val().length >= minCharTitel) && ($(inputTitel).val().length < maxCharTitel)) {
        $('#warnungTitel').html("");
    } else {
        $('#warnungTitel').html("(Bitte einen gültigen Titel wählen, 4-15 Zeichen)");
    }
})

$(document).ready(function() {
    $('#multiselect').multiselect({
        allSelectedText: 'All', 
        numberDisplayed: 5,
        buttonWidth: '100%',
        includeSelectAllOption: true,
    });
});