// $(document).ready(function()
// {
//     $("#studentSearch").submit(function(e)
//     {
//         e.preventDefault();
//         $.ajax(
//         {
//             method: "post",
//             url: "http://127.0.0.1:5000/get-recommendation",
//             data: $(this).serialize(),
//             datatype: "text",
//             error: function()
//             {
//                 alert('Some Error Occurred!!!');
//             },
//             success: function(Response)
//             {
//                 document.getElementById("iframeblock").style.display="block";
//                 $("#iframeblock").html(Response);
//             }
//         });
//     });
// });

$(document).ready(function() {
  $("#studentSearch").submit(function(e) {
      e.preventDefault();
      $("#spinner").show();
      $('#formblock').hide();
      $.ajax({
          method: "post",
          url: "http://127.0.0.1:5000/get-recommendation",   
          data: $(this).serialize(),
          datatype: "json",   
          error: function() {
              $("#spinner").hide();
              $("#formblock").show();
              alert('Some Error Occurred!!!');
          },
          success: function(response) {
              $("#spinner").hide();
              $("#formblock").show();
              if (response.status === "success") {

                  let iframe = document.getElementById("iframeblock");
                  let iframeDoc = iframe.contentWindow.document;

                  iframeDoc.open();
                  iframeDoc.close();


                  iframeDoc.head.innerHTML = `
                  <style>
                    table {
                      background-color: #783E12; /* Table background color */
                      width: 100%;
                      border-collapse: collapse;
                      margin: 20px 0;
                      font-family: Arial, sans-serif;
                    }
                    th, td {
                      border: 1px solid #ddd;
                      padding: 8px;
                      text-align: center;
                    }
                    th {
                      background-color: #f2f2f2;
                      font-weight: bold;
                    }
                    tr {
                      background-color: #401b00; /* Row background color */
                    }
                    tr:hover {
                      background-color: #f1f1f1;
                    }
                    .thead {
                      background-color: #343a40;
                      color: white;
                    }
                    .tbody {
                      background-color: #f8f9fa;
                    }
                  </style>
                  <head>
                    <link rel="stylesheet" href="../Assets/css/bootstrap.css">
                  </head>
                `;

                  let content = `
                    <table id='example' class='table table-responsive table-bordered bg-dark' style='width:100%;'>
                      <tr class='thead'>
                        <th colspan='1'>
                            <center>
                                <input type='button' class='btn col-6'  id='clear2' value='x'>
                            </center>
                        </th>
                        <th colspan='4'>
                            <h1 style='text-align:center;'>Books</h1>
                        </th>
                      </tr>
                      <tr class='thead'>
                        <th>Title</th>
                        <th>Edition</th>
                        <th>Authors</th>
                        <th>Publisher</th>
                        <th>Book Count</th>
                      </tr>
                      <tbody>
                  `;

                  response.data.forEach(function(book) {
                      content += `
                        <tr class='tbody'>
                          <td>${book.title}</td>
                          <td>${book.Edition}</td>
                          <td>${book.author1}, ${book.author2}, ${book.author3}</td>
                          <td>${book.Publisher}</td>
                          <td>${book.book_count}</td>
                        </tr>
                      `;
                  });

                  content += `
                    </tbody>
                  </table>
                    
                  `;


                  iframeDoc.body.innerHTML = content;
                  let closeButton = iframeDoc.getElementById("clear2");
                  closeButton.addEventListener("click", function() {
                      iframe.style.display = "none";
                  });

                  iframe.style.display = "block";
              } else {
                  alert('No data received or error occurred in response.');
              }
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