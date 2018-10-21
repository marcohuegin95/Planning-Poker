//https://stackoverflow.com/questions/16668906/onclick-on-bootstrap-button (20.10.2018)
/**
  * @desc jQuery-Funktion, welche das Handling steuert, wenn der Button um einen neuen Teilnehmer hinzuzufügen gedrückt wird 
*/
var hinzufuegeButton = document.getElementById("btn_teilnehmerHinzufuegen");
var input = document.getElementById("userinput");
var ul = document.querySelector("ul");

hinzufuegeButton.addEventListener("click", function () {

    if( $(input).val() ){
        $('#warnungTeilnehmerHinzufuegen').html("");
        var li = document.createElement("li");
        // Add Bootstrap class to the list element
        li.classList.add("list-group-item");
        li.appendChild(document.createTextNode(input.value));
        ul.appendChild(li);
        // Eingabe in Inputfeld löschen
        input.value = "";
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