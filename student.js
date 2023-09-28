$(document).ready(function()
{
    $("#studentSearch").submit(function(e)
    {
        e.preventDefault();
        $.ajax(
        {
            method: "post",
            url: "student.php",
            data: $(this).serialize(),
            datatype: "text",
            success: function(Response)
            {
                document.getElementById("formblock").style.transform="translate(-185%,-60%)";
                document.getElementById("searchtext").style.textShadow="2px 2px aliceblue";
                document.getElementById("searchtext").style.color="#040D12";
                document.getElementById("iframeblock").style.display="block";
                $("#iframeblock").html(Response);
            }
        });
    });
});

$( function() {
    $.widget( "custom.catcomplete", $.ui.autocomplete, {
      _create: function() {
        this._super();
        this.widget().menu( "option", "items", "> :not(.ui-autocomplete-category)" );
      },
      _renderMenu: function( ul, items ) {
        var that = this,
          currentCategory = "";
        $.each( items, function( index, item ) {
          var li;   
          if ( item.category != currentCategory ) {
            ul.append( "<li class='ui-autocomplete-category'>" + item.category + "</li>" );
            currentCategory = item.category;
          }
          li = that._renderItemData( ul, item );
          if ( item.category ) {
            li.attr( "aria-label", item.category + " : " + item.label );
          }
        });
      }
    });
    
    $( "#book_s" ).catcomplete({
      delay: 0,
      autoFocus: true,
      source: "Suggestions.php"
    });
  } );

function cleared()
{
    let holder=document.getElementById("book_s");
    document.getElementById("iframeblock").style.display="none";
    document.getElementById("formblock").style.transform="translate(-50%,-60%)";
    document.getElementById("searchtext").style.textShadow="2px 2px #040d12";
    document.getElementById("searchtext").style.color="#93b1a6";
    holder.value="";
    document.getElementById("clear2").style.display="none";
}

$(document).ready(function(){

  //Theam change
  $("#select_theam").change(function(){

    // Selected Theam id
    var theam_id = $(this).val();

    var url_= "/LibraryManagement/student.html";
    if(theam_id == 1){
      url_="/LibraryManagement/student.html";
    }
    else if(theam_id == 2){
      url_="/LibraryManagement/student_.html";
    }
    window.location.href = url_;
  });
});