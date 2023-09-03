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
                document.getElementById("iframeblock").style.display="block";
                document.getElementById("formblock").style.transform="translate(-180%,-60%)";
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
    holder.value="";
    document.getElementById("clear2").style.display="none";
}