$(document).ready(function()
{
    $("#studentSearch").submit(function(e)
    {
        e.preventDefault();
        $.ajax(
        {
            method: "post",
            url: ".///php/student.php",
            data: $(this).serialize(),
            datatype: "text",
            error: function()
            {
                alert('Some Error Occurred!!!');
            },
            success: function(Response)
            {
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
      delay: 500,
      // autoFocus: true,
      minLength: 3,
      source: ".///php/Suggestions.php"
    });
  } );

function cleared()
{
    let holder=document.getElementById("book_s");
    document.getElementById("iframeblock").style.display="none";
    holder.value="";
    document.getElementById('formblock').style.display='flex';
    document.getElementById("clear2").style.display="none";
}

$(document).ready(function(){

  //Theam change
  $("#select_theam").change(function(){

    // Selected Theam id
    var theam_id = $(this).val();

    var url_= "/LibraryManagement/StudentPage/student.html";
    if(theam_id == 1){
      url_="/LibraryManagement/StudentPage/student.html";
    }
    else if(theam_id == 2){
      url_="/LibraryManagement/StudentPage/student_.html";
    }
    window.location.href = url_;
  });
});

document.querySelector("#subbtn").addEventListener("mouseover",()=>
{
    document.querySelector("#subbtnimg").setAttribute("src","Assets\\img\\baseline_search_white_24dp.png");
});
document.querySelector("#subbtn").addEventListener("mouseout",()=>
{
    document.querySelector("#subbtnimg").setAttribute("src","Assets\\img\\icon-black.png");
});