//https://stackoverflow.com/questions/16668906/onclick-on-bootstrap-button 20.10.2018

var button = document.getElementById("enter");
var input = document.getElementById("userinput");
var ul = document.querySelector("ul");

button.addEventListener("click", function() {
  var li = document.createElement("li");
  // Add Bootstrap class to the list element
  li.classList.add("list-group-item");
  li.appendChild(document.createTextNode(input.value));
  ul.appendChild(li);
  // Clear your input 
  input.value = "";
})

// https://bootsnipp.com/snippets/featured/dynamic-sortable-tables 20.10.2018
$(document).ready(function() {
  $("#add_row").on("click", function() {
      // Dynamic Rows Code
      
      // Get max row id and set new id
      var newid = 0;
      $.each($("#tab_logic tr"), function() {
          if (parseInt($(this).data("id")) > newid) {
              newid = parseInt($(this).data("id"));
          }
      });
      newid++;
      
      var tr = $("<tr></tr>", {
          id: "addr"+newid,
          "data-id": newid
      });
      
      // loop through each td and create new elements with name of newid
      $.each($("#tab_logic tbody tr:nth(0) td"), function() {
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
              .click(function() {
                  $(this).closest("tr").remove();
              })
      ).appendTo($(tr));
      
      
      // add the new row
      $(tr).appendTo($('#tab_logic'));
      
      $(tr).find("td button.row-remove").on("click", function() {
           $(this).closest("tr").remove();
      });
});




  // Sortable Code
  var fixHelperModified = function(e, tr) {
      var $originals = tr.children();
      var $helper = tr.clone();
  
      $helper.children().each(function(index) {
          $(this).width($originals.eq(index).width())
      });
      
      return $helper;
  };

  $(".table-sortable tbody").sortable({
      helper: fixHelperModified      
  }).disableSelection();

  $(".table-sortable thead").disableSelection();



  $("#add_row").trigger("click");
});