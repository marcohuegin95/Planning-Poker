/**
  * @desc jQuery-Funktion, welche das Handling (Event) steuert, wenn der Benutzer ein Titel in das Titel-Feld eingibt
*/
var inputTitel = document.getElementById("in_titelNeuesProjekt");

inputTitel.addEventListener("input", function () {
    var minCharTitel = 5;
    var maxCharTitel = 25;
    if (($(inputTitel).val().length >= minCharTitel) && ($(inputTitel).val().length < maxCharTitel)) {
        $('#warnungTitel').html("");
    } else {
        $('#warnungTitel').html("(Bitte einen gültigen Titel wählen, 5-25 Zeichen)");
    }
})

/**
  * @desc jQuery-Funktion, welche das Handling steuert, wenn eine neue User-Story erstellt wird.
*/
var inputErsteStoryTitel = document.getElementById("in_storyTitel");
var inputErsteStoryBeschreibung = document.getElementById("in_storyBeschreibung");

$(document).ready(function () {
    $("#btn_storyHinzufuegen").on("click", function () {
        // Prüfen, ob Felder der ersten User Story bereits ausgefüllt worden sind, sonst kann keine neue Story hinzugefügt werden
        if (($(inputErsteStoryTitel).val().length > 0) && ($(inputErsteStoryBeschreibung).val().length > 0)) {
            $('#warnungUserStoryHinzufuegen').html("");
            // Hole maximale ID und setze neue
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
                var neueZeile = cur_td.children();

                // add new td and element if it has a nane
                if ($(this).data("name") != undefined) {
                    var td = $("<td></td>", {
                        "data-name": $(cur_td).data("name")
                    });

                    var c = $(cur_td).find($(neueZeile[0]).prop('tagName')).clone().val("");
                    c.attr("name", $(cur_td).data("name") + "[]");
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

        } else {
            $('#warnungUserStoryHinzufuegen').html("(Bitte Felder der ersten User-Story ausfüllen, bevor mehr User-Story erstellt werden können)");
        }
    });
});

