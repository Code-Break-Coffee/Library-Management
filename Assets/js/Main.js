//--------------------------------------------------------------------------displayNone
const displayNone=()=>
{
    let arr=document.querySelectorAll(".dropdown-menu");
    arr.forEach(elem=>elem.style.display="none");
}

//----------------------------------------------------------------------------mouseover
const navbar=document.querySelector(".navbar-nav");
navbar.addEventListener('mouseover',(e)=>
{
    if(e.target.classList.contains("hovered"))
    {
        displayNone();
        document.getElementById(e.target.id+"div").style.display="block";
    }
});
//---------------------------------------------------------------------------mouseleave
navbar.addEventListener('mouseleave',(e)=>
{   
    if(!e.target.classList.contains("dropdown"))
    {
        displayNone();
    }
});
//----------------------------------------------------------------------------delete book
document.getElementById("d").addEventListener("click",()=>
{
    displayNone();
    let container=document.getElementById("container");
        container.innerHTML=`
        <div id="deletefield" style="font-weight:bold;width:600px;height:600px;position:relative;top:50%;left:50%;transform: translate(-50%,-50%);background-color: rgba(0, 0, 0, 0.2);border-radius:50%;backdrop-filter: blur(5px);color:aliceblue;">
            <div style="position: absolute;top:50%;left:50%;translate: -50% -50%;">
                <form id="deleteform" method="post" action="" autocomplete="off">
                    <center>
                        <h1>Book Delete Form</h1>
                        <label>Book Number:</label>
                        <input required type="text" name="bookno" class="form-control bg-dark" style="width:100%;color:aliceblue;" placeholder="Scan the Barcode or Enter Book No."/><br>
                        <input type="submit" class="btn" style="color:aliceblue;background-color: black;font-weight: bold;" value="Delete"/>
                        <button type="reset" class="btn " style="font-weight: bold; background-color: #520702;color: aliceblue;">Clear</button><br><br>
                    </center>
                </form>
            </div>
        </div>
        <div style="font-weight: bold;position: relative;top: 50px; right:50px;" id="response4"></div>`;
    $(document).ready(function()
    {
        $("#deleteform").submit(function(e)
        {
            e.preventDefault();
            $.ajax(
            {
                method: "post",
                url: "Books\\Transactions\\Book_delete_check.php",
                data: $(this).serialize() + "&Access=" +"Main-Delete",
                datatype: "text",
                error: function()
                {
                    alert('Some Error Occurred!!!');
                },
                success: function(Result)
                {
                    $( "#dialog4" ).dialog( "destroy" ); 
                    $("#response4").html(Result);
                    $("#dialog4").dialog();
                }
            });
        });
    });
});

//----------------------------------------------------------------------------Book Issue

document.getElementById("i").addEventListener("click",()=>
{
    displayNone();
    let container=document.getElementById("container");
    container.innerHTML=`
    <div id="issuefield" style="font-weight:bold;width:600px;height:600px;position:relative;top:50%;left:50%;transform: translate(-50%,-50%);background-color: rgba(0, 0, 0, 0.2);border-radius:50%;backdrop-filter: blur(5px);color:aliceblue;">
        <div style="position: absolute;top:50%;left:50%;translate: -50% -50%;">
            <form id="issuebook" method="post" action="" autocomplete="off">
                <center>
                    <h1>Book Issue Form</h1>
                    <br>
                    <label>Member Type:</label><br><label class="form-check-label">Student:</label>&nbsp;
                    <input type="radio" name="membertype" checked class="form-check-input bg-dark" value="Student" style="color:aliceblue;"/>
                    <label class="form-check-label">Faculty:</label>&nbsp;&nbsp;
                    <input type="radio" name="membertype" class="form-check-input bg-dark" value="Faculty" style="color:aliceblue;"/><br><br>
                    
                    <div class="row">
                        <div class="col-8 col-lg-8 col-md-8 col-sm-8 col-xl-8">
                            <label>Member ID:</label>
                            <input id="memberid" required type="text" name="memberid" class="form-control bg-dark" style="width:100%;color:aliceblue;" placeholder="Scan the Barcode or Enter Member ID"/>
                        </div>
                        <div class="col-4 col-lg-4 col-md-4 col-sm-4 col-xl-4">
                            <input type="button" id="issuecheck" class="btn" value="Check" style="position:relative;top:23px;color:aliceblue;background-color: black;font-weight: bold;"/>
                        </div>
                    </div>
                        <br>
                    <label>Book Number:</label>
                    <input required type="text" name="bookno" class="form-control bg-dark" style="width:100%;color:aliceblue;" placeholder="Scan the Barcode or Enter Book No."/><br>

                    <input type="submit" class="btn" style="color:aliceblue;background-color: black;font-weight: bold;" value="Issue"/>
                    <button type="reset" id="resetissue" class="btn" style="font-weight: bold;background-color: #520702;color: aliceblue;">Clear</button><br><br>
                </center>
            </form>
        </div>
    </div>
    <div style="font-weight: bold;display:none;" id="response"></div>
    <div style="font-weight: bold;width:1200px;position:absolute;top:25%;left:45%;" id="response_check"></div>
    `;
    $(document).ready(function()
    {
        
        $("#issuecheck").on('click',()=>
        {
            const mi=document.getElementById("memberid").value;
            if(mi.length === 0){
                alert("Please Enter Member Id!");
                return;
            }
             
            $.ajax(
                {
                    method: "post",
                    url: "Books\\Transactions\\Book_issue_check.php",
                    data: "&Access=Main-Issue-Check&memberid="+mi,
                    datatype: "text",
                    error: function()
                    {
                        alert('Some Error Occurred!!!');
                    },
                    success: function(Result)
                    {  
                    document.getElementById("response_check").style.display="block";
                    $("#response_check").html(Result);
                }
            });    
        });
        $("#issuebook").submit(function(e)
        {
            e.preventDefault();
            document.getElementById("response_check").style.display="none";
            document.getElementById("issuefield").style.transform="translate(-50%,-50%)";
            $.ajax(
            {
                method: "post",
                url: "Books\\Transactions\\Book_issue.php",
                data: $(this).serialize() + "&Access=" +"Main-Issue",
                datatype: "text",
                error: function()
                {
                    alert('Some Error Occurred!!!');
                },
                success: function(Result)
                {
                    document.getElementById("response").style.display="block";
                    $( "#dialog1" ).dialog( "destroy" );
                    $("#response").html(Result);
                    $("#dialog1").dialog();
                }
            });
        });
        $("#resetissue").on('click',()=>
        {
            document.getElementById("response").style.display="none";
            document.getElementById("response_check").style.display="none";
            document.getElementById("issuefield").style.transform="translate(-50%,-50%)";
        });
    });
});

//------------------------------------------------------------------------------Return of Book

document.getElementById("r").addEventListener("click",()=>
{
    displayNone();
    let container=document.getElementById("container");
    container.innerHTML=`
    <div id="returnfield" style="font-weight:bold;width:600px;height:600px;position:relative;top:50%;left:50%;transform: translate(-50%,-50%);border-radius: 5px;background-color: rgba(0, 0, 0, 0.2);border-radius:50%;backdrop-filter: blur(5px);color:aliceblue;">
        <div style="position: absolute;top:50%;left:50%;translate: -50% -50%;">
            <form id="returnform" method="post" action="" autocomplete="off">
                <center>
                    <h1>Book Return Form</h1>
                    <label>Member Type:</label><br>
                    <label class="form-check-label">Student:</label>&nbsp;&nbsp;<input type="radio" name="membertype" checked class="form-check-input bg-dark" value="Student"/>
                    <label class="form-check-label">Faculty:</label>&nbsp;&nbsp;<input type="radio" name="membertype" class="form-check-input bg-dark" value="Faculty"/><br><br>
                    <label>Member ID:</label>
                    <input required type="text" name="memberid" class="form-control bg-dark" style="width:100%;color:aliceblue;" placeholder="Scan the Barcode or Enter Member ID"/><br>

                    <label>Book Number:</label>
                    <input required type="text" name="bookno" class="form-control bg-dark" style="width:100%;color:aliceblue;" placeholder="Scan the Barcode or Enter Book No."/><br>

                    <input type="submit" class="btn" style="color:aliceblue;background-color: black;font-weight: bold;" value="Return"/>
                    <button type="reset" class="btn " style="font-weight: bold;background-color: #520702;color: aliceblue;">Clear</button><br><br>
                </center>
            </form>
        </div>
    </div>
    <div style="font-weight: bold;position: relative;top: 50px; right:50px;" id="response2"></div>`;
    $(document).ready(function()
    {
        $("#returnform").submit(function(e)
        {
            e.preventDefault();
            $.ajax(
            {
                method: "post",
                url: "Books\\Transactions\\Book_return.php",
                data: $(this).serialize() + "&Access=" +"Main-return",
                datatype: "text",
                error: function()
                {
                    alert('Some Error Occurred!!!');
                },
                success: function(Result)
                {
                    $( "#dialog2" ).dialog( "destroy" );
                    $("#response2").html(Result);
                    $("#dialog2").dialog();
                }
            });
        });
    });
});

//-------------------------------------------------------------------------------audit

document.getElementById("au").addEventListener("click",()=>
{
    displayNone();
    let container=document.getElementById("container");
    container.innerHTML=`
    <div id="aufield" style="font-weight:bold;width:600px;height:600px;position:relative;top:50%;left:50%;transform: translate(-50%,-50%);border-radius: 5px;background-color: rgba(0, 0, 0, 0.2);border-radius:50%;backdrop-filter: blur(5px);color:aliceblue;">
        <div style="position: absolute;top:50%;left:50%;translate: -50% -50%;">
            <form id="auform" method="post" action="" autocomplete="off">
                <center>
                    <h1>Audit Form</h1>
                    <label>Member Type:</label><br>
                    <label class="form-check-label">Student:</label>&nbsp;&nbsp;<input type="radio" name="membertype" checked class="form-check-input bg-dark" value="Student"/>
                    &nbsp;
                    <label class="form-check-label">Faculty:</label>&nbsp;&nbsp;<input type="radio" name="membertype" class="form-check-input bg-dark" value="Faculty"/>
                    &nbsp;
                    <label class="form-check-label">All:</label>&nbsp;&nbsp;<input type="radio" name="membertype" checked class="form-check-input bg-dark" value="All"/>
                    <br><br>                                   
                    <label>From:</label>
                    <input required type="date" name="from" class="form-control bg-dark" style="width:100%;color:aliceblue;" /><br>
                    <label>To:</label>
                    <input required type="date" name="to" class="form-control bg-dark" style="width:100%;color:aliceblue;" /><br>
                    <input type="submit" class="btn" style="color:aliceblue;background-color: black;font-weight: bold;" value="Search"/>
                    <button type="reset" class="btn " style="font-weight: bold;background-color: #520702;color: aliceblue;" id="resetsearch">Clear</button><br><br>
                </center>
            </form>
        </div>
    </div>
    <div style="font-weight: bold;" id="response7"></div>`;
    $(document).ready(function()
    {
        $("#auform").submit(function(e)
        {
            e.preventDefault();
            document.getElementById("response7").style.display="block";
            $.ajax(
            {
                method: "post",
                url: "Report\\Books\\Audit.php",
                data: $(this).serialize() + "&Access=" +"Main-Audit",
                datatype: "text",
                error: function()
                {
                    alert('Some Error Occurred!!!');
                },
                success: function(Result)
                {
                    $( "#dialog7" ).dialog( "destroy" );
                    $("#response7").html(Result);
                    $("#dialog7").dialog();
                }
            });
        });
    });
    $("#resetsearch").click(function()
    {
        document.getElementById("response7").style.display="none";
        document.getElementById("aufield").style.transform="translate(-50%,-50%)";
    });
});

//-------------------------------------------------------------------------add Student member

document.getElementById("me").addEventListener("click",()=>
{
    displayNone();
    let container=document.getElementById("container");
    container.innerHTML=`
    <div id="mefield" style="font-weight:bold;width:600px;height:600px;position:relative;top:50%;left:50%;transform: translate(-50%,-50%);border-radius: 5px;background-color: rgba(0, 0, 0, 0.2);border-radius:50%;backdrop-filter: blur(5px);color:aliceblue;">
        <div style="position: absolute;top:50%;left:50%;translate: -50% -50%;">
            <form id="meform" method="post" action="" autocomplete="off">
                <center>
                <h1>Add Student Member Form</h1>
                    <label>Roll No:</label>
                    <input required type="text" name="roll_no" class="form-control bg-dark" style="width:100%;color:aliceblue;" /><br>

                    <input type="submit" class="btn" style="color:aliceblue;background-color: black;font-weight: bold;" value="Add"/>
                    <button type="reset" class="btn " style="font-weight: bold;background-color: #520702;color: aliceblue;">Clear</button><br><br>
                    <div style="color:red;font-weight: bold;" id="response_me"></div>
                </center>
            </form>
        </div>
    </div>
    <div style="font-weight: bold;" id="response8"></div>`;
    $(document).ready(function()
    {
        $("#meform").submit(function(e)
        {
            e.preventDefault();
            $.ajax(
            {
                method: "post",
                url: "Members\\Student\\Student_member_add.php",
                data: $(this).serialize() + "&Access=" +"Main-Membership",
                datatype: "text",
                error: function()
                {
                    alert('Some Error Occurred!!!');
                },
                success: function(Result)
                {
                    $( "#dialog8" ).dialog( "destroy" );
                    $("#response8").html(Result);
                    $("#dialog8").dialog();
                }
            });
        });
    });
})

//---------------------------------------------------------------------------------- Add Books

document.getElementById("ins").addEventListener("click",()=>
{
    displayNone();
    let container=document.getElementById("container");
    container.innerHTML=`
    <div id="InsertField" style="font-weight:bold;width:600px;height:600px;position:relative;top:50%;left:50%;transform: translate(-50%,-50%);background-color: rgba(0, 0, 0, 0.2);border-radius:50%;backdrop-filter: blur(5px);color:aliceblue;">
        <div style="position: absolute;top:50%;left:50%;translate: -50% -50%;">
            <form id="insertform" method="post" action="" autocomplete="off">
                <center>
                    <h1>Book Insert Form</h1>
                    <div class="row">
                        <div class="col-6 col-sm-6 col-md-6 col-xl-6 col-lg-6">
                            <label>Book Number:</label>
                            <input type="number" name="bookno" class="form-control bg-dark" style="width:100%;color:aliceblue;" placeholder="Scan the Barcode or Enter Book No."/>
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 col-xl-6 col-lg-6">
                            <label>Title:</label>
                            <input required id="book_title"  type="text" name="title" class="form-control bg-dark" style="width:100%;color:aliceblue;"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 col-sm-6 col-md-6 col-xl-6 col-lg-6">
                            <label>Edition:</label>
                            <input required type="text" name="edition" class="form-control bg-dark" style="width:100%;color:aliceblue;"/>
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 col-xl-6 col-lg-6">
                            <label>Author 1:</label>
                            <input required type="text" name="author1" id="author1"  class="form-control bg-dark" style="width:100%;color:aliceblue;"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 col-sm-6 col-md-6 col-xl-6 col-lg-6">
                            <label>Author 2:</label>
                            <input type="text" name="author2"  id="author2" class="form-control bg-dark" style="width:100%;color:aliceblue;"/>
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 col-xl-6 col-lg-6">
                            <label>Author 3:</label>
                            <input type="text" name="author3" id="author3" class="form-control bg-dark" style="width:100%;color:aliceblue;"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 col-sm-6 col-md-6 col-xl-6 col-lg-6">
                            <label>Publisher:</label>
                            <input required type="text" name="publisher" id="publisher" class="form-control bg-dark" style="width:100%;color:aliceblue;"/>
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 col-xl-6 col-lg-6">
                            <label>Supplier:</label>
                            <input type="text" name="supplier" class="form-control bg-dark" style="width:100%;color:aliceblue;"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 col-sm-6 col-md-6 col-xl-6 col-lg-6">
                            <label>Cost:</label>
                            <input type="number" name="cost" class="form-control bg-dark" style="width:100%;color:aliceblue;"/>
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 col-xl-6 col-lg-6">
                            <label>Total Pages:</label>
                            <input required type="number" name="totalpages" class="form-control bg-dark" style="width:100%;color:aliceblue;"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 col-sm-6 col-md-6 col-xl-6 col-lg-6">
                            <label>No. of Copy:</label>
                            <input type="number" name="bookcount" class="form-control bg-dark" style="width:100%;color:aliceblue;"/>
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 col-xl-6 col-lg-6">
                            <label>CL No.</label>
                            <input required type="number" name="CL" class="form-control bg-dark" step="0.0000001" style="width:100%;color:aliceblue;"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 col-sm-6 col-md-6 col-xl-6 col-lg-6">
                            <label>Bill Number:</label>
                            <input  type="text" name="billno" class="form-control bg-dark" style="width:100%;color:aliceblue;"/>
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 col-xl-6 col-lg-6">
                            <label>Remark:</label>
                            <select class="form-control bg-dark" style="width:100%;color:aliceblue;" name="remark" id="remark_change">
                                <option value="null">Select Remark</option>
                                <option value="main library">Main Library</option>
                                <option value="reference library">Reference Library</option>
                                <option value="donation">Donation</option>
                                <option value="others">Others</option>
                            </select>
                        </div>
                    </div>
                    <div class="row" id="remark" style="display:none;">
                        <div class="col-12 col-sm-12 col-md-12 col-xl-12 col-lg-12">
                            <label>Other Remark:</label>
                            <input type="text" name="other" class="form-control bg-dark" style="width:100%;color:aliceblue;"/>
                        </div>
                    </div>
                    <br>
                            <input type="submit" class="btn" style="color:aliceblue;background-color: black;font-weight: bold;" value="Insert"/>
                            <button type="reset" class="btn" style="font-weight: bold;background-color: #520702;color: aliceblue;">Clear</button><br><br>
                </center>
            </form>
        </div>
    </div>
    <div style="font-weight: bold;" id="response3"></div>`;
    $(document).ready(function()
    {
        $("#remark_change").on("change",()=>
        {
            if(document.querySelector("#remark_change").value==="others")
            {
                document.querySelector("#remark").style.display="block";
            }
            else
            {
                document.querySelector("#remark").style.display="none";
            }
        });
        $( "#book_title" ).autocomplete({
            source: "Assets\\php\\Suggestions_book_title.php",
            autoFocus:true,
            minLength:3,
            select: function( event, ui ) {
                event.preventDefault();
                $("#book_title").val(ui.item.id);
            }
        });
        $( "#author1" ).autocomplete({
          source: "Assets\\php\\Suggestions_book_author.php",
          autoFocus:true,
          minLength:3,
          select: function( event, ui ) {
              event.preventDefault();
              $("#author1").val(ui.item.id);
            }
        });
          $( "#author2" ).autocomplete({
            source: "Assets\\php\\Suggestions_book_author.php",
            autoFocus:true,
            minLength:3,
            select: function( event, ui ) {
                event.preventDefault();
                $("#author2").val(ui.item.id);
            }
        });
          $( "#author3" ).autocomplete({
            source: "Assets\\php\\Suggestions_book_author.php",
            autoFocus:true,
            minLength:3,
            select: function( event, ui ) {
                event.preventDefault();
                $("#author3").val(ui.item.id);
            }
        });
          $( "#publisher" ).autocomplete({
            source: "Assets\\php\\Suggestions_book_publish.php",
            autoFocus:true,
            minLength:3,
            select: function( event, ui ) {
                event.preventDefault();
                $("#publisher").val(ui.item.id);
            }
        });
        $("#insertform").submit(function(e)
        {
            e.preventDefault();
            $.ajax(
            {
                method: "post",
                url: "Books\\Transactions\\Book_add.php",
                data: $(this).serialize() + "&Access=" +"Main-Insert",
                datatype: "text",
                error: function()
                {
                    alert('Some Error Occurred!!!');
                },
                success: function(Result)
                {
                    $( "#dialog3" ).dialog( "destroy" );
                    $("#response3").html(Result);
                    $("#dialog3").dialog();
                }
            });
        });
    });
});

//--------------------------------------------------------------------------search

document.getElementById("s").addEventListener("click",()=>
{
    displayNone();
    let container=document.getElementById("container");
    container.innerHTML=`
    <div id="SearchField" style="font-weight:bold;width:600px;height:600px;position:relative;top:50%;left:50%;transform:translate(-50%,-50%);background-color: rgba(0, 0, 0, 0.2);border-radius:50%;backdrop-filter: blur(5px);color:aliceblue;">
        <div style="position: absolute;top:50%;left:50%;translate: -50% -50%;">
            <form id="searchform" method="post" action="" autocomplete="off">
                <center>
                    <h1>Book Search Form</h1>
                    <label>Category:</label>
                    <select id="sb" name="soption" class="form-control bg-dark" style="width:100%;color:aliceblue;">
                        <option value="search">Search..</option>
                        <option value="Book No.">Book No.</option>
                        <option value="Author">Author</option>
                        <option value="Title">Title</option>
                    </select><br>
                    
                    <div id="searchcontain"></div>
                    <input required type="text" class="form-control bg-dark" style="width:100%;color:aliceblue;" id="B_Search" name="book"/><br>
                    <button type="submit" value="Search" class="btn" style="width:80px;background-color: #092435;"><img src="Assets\\img\\baseline_search_white_24dp.png" height="25px" width="30px" alt=""></button>
                    <button id="resetsearch" type="reset" class="btn " style="font-weight: bold;background-color: #520702;color: aliceblue;">Clear</button><br><br>
                </center>  
            </form>
        </div>
    </div>
    <div style="font-weight: bold;position: absolute; width:1200px;" id="response5"></div>`;
    $(document).ready(function()
    {
        let sb=document.getElementById("sb");
        let sval=sb.options[sb.selectedIndex].value;
    let sc=document.getElementById("searchcontain");
    if(sval=="search")
    {
        sc.innerHTML=`<label>Book Search:</label>`;
    }
    function setPath(path = "Assets\\php\\Suggestions.php"){
        sugg_path = path;
        console.log(sugg_path);
        return path;
    }
    function getPath(){
        return sugg_path ="Assets\\php\\Suggestions.php";
    }
    $("#sb").click(function()
    {
        let sb=document.getElementById("sb");
        let sval=sb.options[sb.selectedIndex].value;
        let sc=document.getElementById("searchcontain");
        let si=document.getElementById("B_Search");
        if(sval=="Book No.")
            {
                si.setAttribute('placeholder','Enter or scan Book No.');
                si.setAttribute('name','bookno');
                sc.innerHTML=`<label>Book Number:</label>`;
            }
            if(sval=="Author")
            {
                si.setAttribute('name','author');
                si.setAttribute('placeholder','Enter Book Author.');
                 sugg_path =setPath("Assets\\php\\Suggestions_book_author.php");
                sc.innerHTML=`<label>Author:</label>`;
            }
            if(sval=="Title")
            {
                si.setAttribute('name','title');
                si.setAttribute('placeholder','Enter Book Title.');
                sc.innerHTML=`<label>Title:</label>`;
                sugg_path = setPath("Assets\\php\\Suggestions_book_title.php");
            }
            if(sval=="search")
            {
                si.setAttribute('name','book');
                sc.innerHTML=`<label>Book Search:</label>`;
                sugg_path = setPath("Assets\\php\\Suggestions.php");
            }
        });
        
        $(document).ready(function() {
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
        $( "#B_Search" ).catcomplete({
            delay: 500,
            // autoFocus: true,
            minLength: 3,
            source: getPath()
        });
    } );
        $("#resetsearch").click(function()
        {
            let s=document.getElementById("B_Search");
            document.getElementById("searchcontain").innerHTML="<label>Book Search:</label>";
            document.getElementById("response5").style.display="none";
            document.getElementById("SearchField").style.transform="translate(-50%,-50%)";
            s.setAttribute('name','book');
            sugg_path = "Assets\\php\\Suggestions.php";
        });
        $("#searchform").submit(function(e)
        {
            let sval=sb.options[sb.selectedIndex].value;
            e.preventDefault();
            document.getElementById("response5").style.display="none";
            document.getElementById("SearchField").style.transform="translate(-50%,-50%)";
            $.ajax(
            {
                method: "post",
                url: "Report\\Books\\Search.php",
                data: $(this).serialize() + "&Access=" +"Main-Search",
                datatype: "text",
                error: function()
                {
                    alert('Some Error Occurred!!!');
                },
                success: function(Result)
                {
                    $( "#dialog" ).dialog( "destroy" );
                    document.getElementById("response5").style.display="block";
                    $("#response5").html(Result);
                    $("#dialog").dialog();  
                }
            });
        });
    });
});
//---------------------------------------------------------------------------- Show Student Dues And No dues

document.getElementById("m").addEventListener("click",()=>
{
    displayNone();
    let container=document.getElementById("container");
    container.innerHTML=`
    <div id="memberfield" style="font-weight:bold;width:600px;height:600px;position:relative;top:50%;left:50%;transform: translate(-50%,-50%);background-color: rgba(0, 0, 0, 0.2);border-radius:50%;backdrop-filter: blur(5px);color:aliceblue;">
        <div style="position: absolute;top:50%;left:50%;translate: -50% -50%;">
            <form id="memberform" method="post" action="" autocomplete="off">
                <center>
                    <h1>Dues Member Check</h1>
                    <label>Check Dues:</label>
                    <select name="moption" id="mb" class="form-control bg-dark" style="width:100%;color:aliceblue;">
                        <option value="Single Member">Single Member</option>
                        <option value="Class">Class</option>
                    </select><br>
                    <div id="membercontain"></div>
                    <input id="membersubmit" type="submit"  class="btn" style="color:aliceblue;background-color: black;font-weight: bold;" value="Check"/>
                    <button type="reset" id="resetmember" class="btn" style="font-weight: bold;background-color: #520702;color: aliceblue;">Clear</button>                                        
                </center>
            </form>
        </div>
    </div>
    <div style="font-weight: bold;" id="response6"></div>`;
    $(document).ready(function()
    {

        let mb=document.getElementById("mb");
        let mval=mb.options[mb.selectedIndex].value;
        let mc=document.getElementById("membercontain");
        if(mval=="Single Member")
        {
            mc.innerHTML=`<label>Member ID:</label><input required type="text" name="memberid" class="form-control bg-dark" style="width:100%;color:aliceblue;"/>
            <br>`;
            document.getElementById("membersubmit").setAttribute("value","Check");
        }
        $("#mb").click(function()
        {
            let mb=document.getElementById("mb");
            let mval=mb.options[mb.selectedIndex].value;
            let mc=document.getElementById("membercontain");
            if(mval=="Single Member")
            {
                mc.innerHTML=`<label>Member ID:</label><input required type="text" name="memberid" class="form-control bg-dark" style="width:100%;color:aliceblue;"/>
                <br>`;
                document.getElementById("membersubmit").setAttribute("value","Check");
            }
            if(mval=="Class")
            {
                 mc.innerHTML=`
                <label>Batch:</label><input required type="text" name="year" class="form-control bg-dark" style="width:100%;color:aliceblue;"/>
                <br>`;
                document.getElementById("membersubmit").setAttribute("value","Download");
            }
        });

        $("#resetmember").click(function()
        {
            document.getElementById("membercontain").innerHTML='<label>Member ID:</label><input required type="text" name="memberid" class="form-control bg-dark" style="width:100%;color:aliceblue;"/><br>';
            document.getElementById("membersubmit").setAttribute("value","Check");
        });

        $("#memberform").submit(function(e)
        {
            e.preventDefault();
            $.ajax(
            {
                method: "post",
                url: "Report\\Members\\Student_dues.php",
                data: $(this).serialize() + "&Access=" +"Main-member",
                datatype: "text",
                error: function()
                {
                    alert('Some Error Occurred!!!');
                },
                success: function(Result)
                {
                    $("#dialog6").dialog( "destroy" );
                    $("#response6").html(Result);
                    $("#dialog6").dialog();
                    download( __DIR__ + '/Doc/' +'Registratinconfirmed.pdf');
                }
            });
        });
    });
});

//--------------------------------------------------Create new Assistant

document.getElementById("admin_add").addEventListener("click",()=>
{
    displayNone();
    let container=document.getElementById("container");
    container.innerHTML=`
    <div style="font-weight:bold;width:600px;height:600px;position:relative;top:50%;left:50%;transform: translate(-50%,-50%);background-color: rgba(0, 0, 0, 0.2);border-radius:50%;backdrop-filter: blur(5px);color:aliceblue;">
        <div style="position: absolute;top:50%;left:50%;translate: -50% -50%;">
            <form id="adminstrator" method="post" action="" autocomplete="off">
                <center>
                    <h1>Add Assistant User</h1>
                    <label>User ID:</label>
                    <input required type="text" name="admin_user" class="form-control bg-dark" style="width:100%;color:aliceblue;" placeholder="Enter User ID"/><br>
                    <label for="validationServer01">Password:</label>
                    <input required id="validationServer01" type="password" name="admin_pass" class="is-invalid form-control bg-dark" style="width:100%;color:aliceblue;" placeholder="Enter the Password"/><br>
                    <label for="validationServer02" >Confirm Password:</label>
                    <input required id="validationServer02" type="password" name="admin_pass_conf" class="is-invalid form-control bg-dark" style="width:100%;color:aliceblue;" placeholder="Enter the Password"/><br>
                    <input type="submit" id="insert" class="btn" style="color:aliceblue;background-color: black;font-weight: bold;" value="Insert"/>
                    <button id="resetsearch" type="reset" class="btn " style="font-weight: bold;background-color: #520702;color: aliceblue;">Clear</button><br><br>
                </center>
            </form>
        </div>
    </div>
    <div style="font-weight: bold;" id="response_adminstrator"></div>`;
    $(document).ready(function()
    {
        document.getElementById("insert").disabled = true;
        let pass1 = document.getElementById("validationServer01");
        let pass2 = document.getElementById("validationServer02");
        $('#validationServer01').keyup('input',()=>{
            if(pass1.value.length >= 8)
            {
                pass1.classList.remove('is-invalid');
                pass1.classList.add('is-valid'); 
                if( pass2.value.length>=8 && pass1.value == pass2.value)
                {
                    pass2.classList.remove('is-invalid');
                    pass2.classList.add('is-valid');
                    document.getElementById("insert").disabled = false;
                }
                else
                {
                    pass2.classList.remove('is-valid');
                    pass2.classList.add('is-invalid');
                    document.getElementById("insert").disabled = true;
                }
            }
            else{
                pass1.classList.remove('is-valid');
                pass1.classList.add('is-invalid');
                pass2.classList.remove('is-valid');
                pass2.classList.add('is-invalid');
                document.getElementById("insert").disabled = true;
            }
        })
        $('#validationServer02').keyup('input',()=>{
            if(pass1.value.length >= 8)
            {
                pass1.classList.remove('is-invalid');
                pass1.classList.add('is-valid'); 
                if( pass2.value.length>=8 && pass1.value == pass2.value)
                {
                    pass2.classList.remove('is-invalid');
                    pass2.classList.add('is-valid');
                    document.getElementById("insert").disabled = false;
                }
                else
                {
                    pass2.classList.remove('is-valid');
                    pass2.classList.add('is-invalid');
                    document.getElementById("insert").disabled = true;
                }
            }
            else{
                pass1.classList.remove('is-valid');
                pass1.classList.add('is-invalid');
                pass2.classList.remove('is-valid');
                pass2.classList.add('is-invalid');
                document.getElementById("insert").disabled = true;
            }
        })

        $("#adminstrator").submit(function(e)
        {
            e.preventDefault();
            $.ajax(
            {
                method: "post",
                url: "Admin\\Admin_create.php",
                data: $(this).serialize() + "&Access=" +"Main-administrator",
                datatype: "text",
                error: function()
                {
                    alert('Some Error Occurred!!!');
                },
                success: function(Result)
                {
                    $( "#dialog_adminstrator" ).dialog( "destroy" );
                    $("#response_adminstrator").html(Result);
                    $("#dialog_adminstrator").dialog();
                }
            });
        });
    });
});

//------------------------------------------------------------Delete Admin

document.getElementById("admin_delete").addEventListener("click",()=>
{
    displayNone();
    let container=document.getElementById("container");
    container.innerHTML=`
    <div style="font-weight:bold;width:600px;height:600px;position:relative;top:50%;left:50%;transform: translate(-50%,-50%);background-color: rgba(0, 0, 0, 0.2);border-radius:50%;backdrop-filter: blur(5px);color:aliceblue;">
        <div style="position: absolute;top:50%;left:50%;translate: -50% -50%;">
            <form id="administrator_delete" method="post" action="" autocomplete="off">
                <center>
                    <h1>Delete Assistant User</h1>
                    <label>User ID:</label>
                    <input required type="text" name="admin_user" class="form-control bg-dark" style="width:100%;color:aliceblue;" placeholder="Enter User ID"/><br>
                    <label>Password:</label>
                    <input type="password" name="admin_pass" class="form-control bg-dark" style="width:100%;color:aliceblue;" placeholder="Enter the Password"/><br>
                    <input type="submit" class="btn" style="color:aliceblue;background-color: black;font-weight: bold;" value="Delete"/>
                    <button id="resetsearch" type="reset" class="btn " style="font-weight: bold;background-color: #520702;color: aliceblue;">Clear</button><br><br>
                </center>
            </form>
        </div>
    </div>
    <div style="font-weight: bold;" id="response_admin_delete"></div>`;
    $(document).ready(function()
    {
        $("#administrator_delete").submit(function(e)
        {
            e.preventDefault();
            $.ajax(
            {
                method: "post",
                url: "Admin\\Admin_delete_check.php",
                data: $(this).serialize() + "&Access=" +"Main-admin-delete",
                datatype: "text",
                error: function()
                {
                    alert('Some Error Occurred!!!');
                },
                success: function(Result)
                {
                    $( "#dialog_admin_delete" ).dialog( "destroy" );
                    $("#response_admin_delete").html(Result);
                    $("#dialog_admin_delete").dialog();
                }
            });
        });
    });
});

//------------------------------------  Delete Member Student


document.getElementById("de").addEventListener("click",()=>
{
    displayNone();
    let container=document.getElementById("container");
    container.innerHTML=`
    <div style="font-weight:bold;width:600px;height:600px;position:relative;top:50%;left:50%;transform: translate(-50%,-50%);background-color: rgba(0, 0, 0, 0.2);border-radius:50%;backdrop-filter: blur(5px);color:aliceblue;">
        <div style="position: absolute;top:50%;left:50%;translate: -50% -50%;">
            <form id="del1" method="post" action="" autocomplete="off">
                <center>
                    <h1>Delete Member ID</h1>
                    <label>Member ID:</label>
                    <input required type="text" name="del_mem" class="form-control bg-dark" style="width:100%;color:aliceblue;" placeholder="Enter Member ID"/><br>
                    <input type="submit" class="btn" style="color:aliceblue;background-color: black;font-weight: bold;" value="Delete"/>
                    <button id="resetsearch" type="reset" class="btn " style="font-weight: bold;background-color: #520702;color: aliceblue;">Clear</button><br><br>
                </center>
            </form>
        </div>
    </div>
    <div style="font-weight: bold;" id="response_del"></div>`;
    $(document).ready(function()
    {
        $("#del1").submit(function(e)
        {  
            e.preventDefault();
            
            $.ajax(
            {
                method: "post",
                url: "Members\\Student\\Student_member_delete.php",
                data: $(this).serialize() + "&Access=" +"Main-delete_member",
                datatype: "text",
                error: function()
                {
                    alert('Some Error Occurred!!!');
                },
                success: function(Result)
                {
                    
                    $( "#dialog_del" ).dialog( "destroy" );
                    $("#response_del").html(Result);
                    $("#dialog_del").dialog();
                }
            });
        });
    });
});

//-------------------------------------------- Insert New Faculty Member

document.getElementById("me_fac").addEventListener("click",()=>
{
    displayNone();
    let container=document.getElementById("container");
    container.innerHTML=`
    <div id="FacultyField" style="font-weight:bold;width:600px;height:600px;position:relative;top:50%;left:50%;transform: translate(-50%,-50%);background-color: rgba(0, 0, 0, 0.2);border-radius:50%;backdrop-filter: blur(5px);color:aliceblue;">
        <div style="position: absolute;top:50%;left:50%;translate: -50% -50%;">
            <form id="faculty" method="post" action="" autocomplete="off">
                <center>
                    <h1>Add Faculty Member</h1>
                    <label>Faculty Name:</label>
                    <input required type="text" name="fac_name" class="form-control bg-dark" style="width:100%;color:aliceblue;" placeholder="Enter Faculty Name"/><br>
                    <label>Faculty ID:</label>
                    <input required type="text" name="fac_id" class="form-control bg-dark" style="width:100%;color:aliceblue;" placeholder="Enter Faculty ID"/><br>
                    <label>Type:</label>
                    <select name="fac_type" class="form-control bg-dark" style="width:100%;color:aliceblue;">
                        <option value="Regular">Regular</option>
                        <option value="Visiting">Visiting</option>
                    </select><br>
                    <input type="submit" class="btn" style="color:aliceblue;background-color: black;font-weight: bold;" value="Add"/>
                    <button id="resetfaculty" type="reset" class="btn " style="font-weight: bold;background-color: #520702;color: aliceblue;">Clear</button><br><br>
                </center>
            </form>
        </div>
    </div>
    <div style="font-weight: bold;" id="response_fac"></div>`;
    $(document).ready(function()
    {
        $("#faculty").submit(function(e)
        {
            e.preventDefault();
            $.ajax(
            {
                method: "post",
                url: "Members\\Faculty\\Faculty_member_add.php",
                data: $(this).serialize()+ "&Access=" +"Main-Faculty_member_add",
                datatype: "text",
                error: function()
                {
                    alert('Some Error Occurred!!!');
                },
                success: function(Result)
                {
                    $( "#dialog_fac" ).dialog( "destroy" );
                    $("#response_fac").html(Result);
                    $("#dialog_fac").dialog();
                }
            });
        });
    });
});

//-----------------------Delete Faculty Member

document.getElementById("de_fac").addEventListener("click",()=>
{
    displayNone();
    let container=document.getElementById("container");
    container.innerHTML=`
    <div style="font-weight:bold;width:600px;height:600px;position:relative;top:50%;left:50%;transform: translate(-50%,-50%);background-color: rgba(0, 0, 0, 0.2);border-radius:50%;backdrop-filter: blur(5px);color:aliceblue;">
        <div style="position: absolute;top:50%;left:50%;translate: -50% -50%;">
            <form id="faculty_del" method="post" action="" autocomplete="off">
                <center>
                    <h1>Delete Faculty Member</h1>
                    <label>Faculty ID:</label>
                    <input required type="text" name="fac_id" class="form-control bg-dark" style="width:100%;color:aliceblue;" placeholder="Enter Faculty ID"/><br>

                    <input type="submit" class="btn" style="color:aliceblue;background-color: black;font-weight: bold;" value="Delete"/>
                    <button id="resetsearch" type="reset" class="btn " style="font-weight: bold;background-color: #520702;color: aliceblue;">Clear</button><br><br>
                </center>
            </form>
        </div>
    </div>
    <div style="font-weight: bold;" id="response_fac_del"></div>`;
    $(document).ready(function()
    {
        $("#faculty_del").submit(function(e)
        {
            e.preventDefault();
            $.ajax(
            {
                method: "post",
                url: "Members\\Faculty\\Faculty_member_delete.php",
                data: $(this).serialize()+"&Access=Main-Delete-Faculty-Member",
                datatype: "text",
                error: function()
                {
                    alert('Some Error Occurred!!!');
                },
                success: function(Result)
                {
                    $( "#dialog_fac_del" ).dialog( "destroy" );
                    $("#response_fac_del").html(Result);
                    $("#dialog_fac_del").dialog();
                }
            });
        });
    });
});

//-------------------------Display all admins
document.getElementById("admin_disp").addEventListener("click",()=>
{
    displayNone();
    let container=document.getElementById("container");
    container.innerHTML=`
    <div id="display" style="font-weight:bold;width:600px;height:600px;position:relative;top:50%;left:50%;transform: translate(-50%,-50%);background-color: rgba(0, 0, 0, 0.2);border-radius:50%;backdrop-filter: blur(5px);color:aliceblue;">
        <div style="position: absolute;top:50%;left:50%;translate: -50% -50%;">
        <form id="display_adm" method="post" action="" autocomplete="off">
        <center>
            <h1>Admin/Assistant Display</h1>
            <label>Type:</label>
            <select name="level" class="form-control bg-dark" style="width:100%;color:aliceblue;">
                <option value="Admin">Admin</option>
                <option value="Assistant">Assistant</option>
            </select><br>
            <input type="submit" class="btn" style="color:aliceblue;background-color: black;font-weight: bold;" value="Display"/>
            <button id="resetadmin" type="reset" class="btn " style="font-weight: bold;background-color: #520702;color: aliceblue;">Clear</button><br><br>
        </center>
        </form>
        </div>
    </div>
    <div style="font-weight: bold; position: absolute; width:1200px;top:25%;left:50%;" id="response_admin_disp"></div>`;
    $("#resetadmin").on('click',()=>
    {
        document.getElementById("display").style.transform="translate(-50%,-50%)";
        document.getElementById("response_admin_disp").style.display="none";
    });
    $("#display_adm").submit(function(e)
    {
        e.preventDefault();
        $.ajax(
        {
            method: "post",
            url: "Admin\\Admin_display.php",
            data: $(this).serialize() + "&Access=" +"Main-Admin_display",
            datatype: "text",
            error: function()
            {
                alert('Some Error Occurred!!!');
            },
            success: function(Result)
            {
                document.getElementById("response_admin_disp").style.display="block";
                $( "#dialog_admin_disp" ).dialog( "destroy" );
                $("#response_admin_disp").html(Result);
                $("#dialog_admin_disp").dialog();  
            }
        });
    });
});

//--------------------------------------------------- Student Member Details
document.getElementById("std").addEventListener("click",()=>
{
    displayNone();
    let container=document.getElementById("container");
    container.innerHTML=`
        <div id="std_searchField" style="font-weight:bold;width:600px;height:600px;position:relative;top:50%;left:50%;transform:translate(-50%,-50%);background-color: rgba(0, 0, 0, 0.2);border-radius:50%;backdrop-filter: blur(5px);color:aliceblue;">
        <div style="position: absolute;top:50%;left:50%;translate: -50% -50%;">
            <form id="std_searchform" method="post" action="" autocomplete="off">
                <center>
                    <h1>Student Member/Not Student Member Check Page</h1>
                    
                    <div id="std_searchcontain"></div>
                    <label>Batch ID</label>
                    <input required type="text" class="form-control bg-dark" style="width:100%;color:aliceblue;" id="std_Search" name="batch_id"/><br>
                    <button type="submit" id="show_std" value="Search" class="btn" style="width:80px;background-color: #092435;"><img src="Assets\\img\\baseline_search_white_24dp.png" height="25px" width="30px" alt=""></button>
                    <button id="std_resetsearch" type="reset" class="btn " style="font-weight: bold;background-color: #520702;color: aliceblue;">Clear</button><br><br>
                </center>  
            </form>
        </div>
    </div>
    <div style="font-weight: bold;position: absolute; width:1200px;" id="response_student_records"></div>
    `;
    $(document).ready(function()
    {
        $("#std_searchform").submit(function(e)
        {
            e.preventDefault();
            
            $.ajax(
            {
                
                method: "post",
                url: "Report\\Members\\Student_members_details.php",
                data: $(this).serialize() + "&Access=" +"Main-Student_members_details",
                datatype: "text",
                error: function()
                {
                    alert('Some Error Occurred!!!');
                },
                success: function(Result)
                {

                    document.getElementById("response_student_records").style.display="block";
                    $( "#dialog_std_disp" ).dialog( "destroy" );
                    $("#response_student_records").html(Result);
                    $("#dialog_std_disp").dialog();  
                }
            });
        }
        );
        $("#std_resetsearch").click(function(){
            
            document.getElementById("std_searchField").style.transform="translate(-50%,-50%)";
            document.getElementById("response_student_records").style.display="none";
        });
    });
})


//-------------------------------------------Book Filter
document.querySelector("#b").addEventListener('click',()=>
{
    displayNone();
    let container=document.getElementById("container");
    container.innerHTML=`
    <div style='background-color: rgba(0, 0, 0, 0.2);backdrop-filter:blur(5px);'>
        <form id='bookfilter_form' method='post' action='' style='color:aliceblue;font-weight:bold;' autocomplete='off'>
            <center>
                <h1 style='text-shadow:2px 2px black;'>Book Filter</h1>
                <div class='row'>
                    <div class='col-3 col-lg-3 col-sm-3 col-xl-3 col-md-3'>
                        <label style='text-shadow:1px 1px black;'>Title:</label><br>
                        <input type='text' name='title' class='bg-dark bookfilter' style='color:aliceblue;' placeholder='Enter Title or leave Empty'/>
                    </div>
                    <div class='col-3 col-lg-3 col-sm-3 col-xl-3 col-md-3'>
                        <label style='text-shadow:1px 1px black;'>Author:</label><br>
                        <input type='text' name='author' class='bg-dark bookfilter' style='color:aliceblue;' placeholder='Enter Author or leave Empty'/>
                    </div>
                    <div class='col-3 col-lg-3 col-sm-3 col-xl-3 col-md-3'>
                        <label style='text-shadow:1px 1px black;'>Publisher:</label><br>
                        <input type='text' name='publisher' class='bg-dark bookfilter' style='color:aliceblue;' placeholder='Enter Publisher or leave Empty'/>
                    </div>
                    <div class='col-3 col-lg-3 col-sm-3 col-xl-3 col-md-3'>
                        <label style='text-shadow:1px 1px black;'>Supplier:</label><br>
                        <input type='text' name='supplier' class='bg-dark bookfilter' style='color:aliceblue;' placeholder='Enter Supplier or leave Empty'/>
                    </div>
                </div><br>
                <div style='display:flex;justify-content:center;gap:7px;'>
                    <div>
                        <input type='submit' style='color:aliceblue;background-color:black;' class='btn'/>
                    </div>
                    <div>
                        <input id='filterreset' type='reset' style='color:aliceblue;background-color:#520702;' class='btn' value='Clear'/>
                    </div>
                </div>
            </center>
        </form>
    </div>  
    <div id='response_book_filter' style='font-weight:bold;width:100%;'></div>
    `;
    $(document).ready(function()
    {
        $("#bookfilter_form").submit(function(e)
        {
            e.preventDefault();
            $.ajax(
            {
                method: "post",
                url: "Report\\Books\\Book_filter.php",
                data: $(this).serialize()+"&Access=Main-Book-Filter",
                datatype: "text",
                error: function()
                {
                    alert('Some Error Occurred!!!');
                },
                success: function(Result)
                {
                    document.getElementById("response_book_filter").style.display="block";
                    $( "#dialog_filter_disp" ).dialog( "destroy" );
                    $("#response_book_filter").html(Result);
                    $("#dialog_filter_disp").dialog();  
                }
            });
        });
        $("#filterreset").on('click',()=>
        {
            document.getElementById("response_book_filter").style.display="none";
        });
    });
});


//------------------------------------------------ Support Tool Books

document.getElementById("support_book").addEventListener("click",()=>
{
    displayNone();
    let container=document.getElementById("container");
    container.innerHTML=`
    <div id="exl_srch" style="font-weight:bold;width:600px;height:600px;position:relative;top:50%;left:50%;transform:translate(-50%,-50%);background-color: rgba(0, 0, 0, 0.2);border-radius:50%;backdrop-filter: blur(5px);color:aliceblue;">
    <div style="position: absolute;top:50%;left:50%;translate: -50% -50%;">

    <center>   
        <h1>Insert Books' Data Through Excel</h1>  </br> 
        <form id='frmExcelImport' method='post' action=''>
        <input class="form-control" style="background-color: black;color: aliceblue;" id="fileupload1" type="file" name="fileupload1" accept=".xls,.xlsx"/>
        <h6>Note: Excel Format should be same as specified !!!</h6>
        <button class="btn" type="submit" id="upload-button" style='color:aliceblue;background-color:black;'> Upload </button>
        <button type="reset" id="resetissue" class="btn" style="font-weight: bold;background-color: #520702;color: aliceblue;">Clear</button><br><br>

        </form>     

    </center>        
    </div>
    </div>

    <div id="spinner_load" style="height:70vh;align-items:center;justify-content:center;display:none;">
        <div class="spinner-border text-warning" role="status"></div>
    </div>

    <div style="font-weight: bold;" id="response_exl_records";position: absolute;></div>
    `;
    async function uploadFile()
    {
        let formData = new FormData(); 
        formData.append("file", fileupload1.files[0]);
        await fetch('Books\\Transactions\\upload_book.php',
        {
            method: "POST", 
            body: formData 
        }); 
        
    }
    $(document).ready(function()
    {

        $("#resetissue").on('click',()=>
        {
            document.getElementById("response_exl_records").style.display="none";
            // document.getElementById("exl_srch").style.transform="translate(-50%,-50%)";
        });

        $("#frmExcelImport").submit(function(e)
        {
            document.getElementById("spinner_load").style.display = "flex";
            e.preventDefault();
            document.getElementById("response_exl_records").style.display="block";
            document.getElementById("exl_srch").style.display="none";
            // document.getElementById("response_exl_records").style.transform="translate(28%,70%)";
            // document.getElementById("exl_srch").style.transform="translate(-130%,-50%)";
            uploadFile();
            $.ajax(
            {
                method: "post",
                url: "Books\\Transactions\\Book_add_excel.php",
                data: $(this).serialize()+"&Access=Main-Book_add_excel",
                datatype: "text",
                error: function()
                {
                    document.getElementById("spinner_load").style.display = "none";
                    alert('Some Error Occurred!!!');
                },
                success: function(Result)
                {
                    document.getElementById("spinner_load").style.display = "none";
                    $( "#dialog_exl_disp" ).dialog( "destroy" );
                    $("#response_exl_records").html(Result);
                    $("#dialog_exl_disp").dialog();  
                }
            });
        }); 
    });
});



//----------------------------------------------- Support Faculty Tool


document.getElementById("support_faculty").addEventListener("click",()=>
{
    displayNone();
    let container=document.getElementById("container");
    container.innerHTML=`
    <div id="fac_exl" style="font-weight:bold;width:600px;height:600px;position:relative;top:50%;left:50%;transform:translate(-50%,-50%);background-color: rgba(0, 0, 0, 0.2);border-radius:50%;backdrop-filter: blur(5px);color:aliceblue;">
    <div style="position: absolute;top:50%;left:50%;translate: -50% -50%;">
    <center>
        <h1>Faculty tools</h1>  </br> 
        <form id='facExcelImport' method='post' action=''>
        <input class="form-control" style="background-color: black;color: aliceblue;" id="fac_fileupload1" type="file" name="fac_fileupload1" accept=".xls,.xlsx"/> </br>
        <h6>Note: Excel Format should be same as specified !!!</h6>
        <button class="btn" type="submit" id="fac-upload-button" style='color:aliceblue;background-color:black;'>Upload</button>
        <button type="reset" id="resetissue" class="btn" style="font-weight: bold;background-color: #520702;color: aliceblue;">Clear</button><br><br>

        </form>     
    </center>        
    </div>
    </div>
    
    <div id="spinner_load" style="height:70vh;align-items:center;justify-content:center;display:none;">
        <div class="spinner-border text-warning" role="status"></div>
    </div>

    <div style="font-weight: bold;" id="response_exl_faculty"></div>
    `;
    async function uploadFile_Fac()
    {
        let formData = new FormData(); 
        formData.append("file", fac_fileupload1.files[0]);
        await fetch('Members\\Faculty\\upload_faculty.php',
        {
            method: "POST", 
            body: formData 
        }); 
    }
    // document.getElementById("upload-button").addEventListener("click",uploadFile);
    $(document).ready(function()
    {
        $("#facExcelImport").submit(function(e)
        {
            document.getElementById("spinner_load").style.display = "flex";
            e.preventDefault();
            document.getElementById("fac_exl").style.display="none";
            uploadFile_Fac();
            $.ajax(
            {
                method: "post",
                url: "Members\\Faculty\\Faculty_add_excel.php",
                data: $(this).serialize(),//-------@Kartikey
                datatype: "text",
                error: function()
                {
                    document.getElementById("spinner_load").style.display = "none";
                    alert('Some Error Occurred!!!');
                },
                success: function(Result)
                {
                    document.getElementById("spinner_load").style.display = "none";
                    $( "#dialog_exl_faculty" ).dialog( "destroy" );
                    $("#response_exl_faculty").html(Result);
                    $("#dialog_exl_faculty").dialog();  
                }
            });
        });
    });
});

//--------------------------------------------------------------------Support Tool Student

document.getElementById("support_student").addEventListener("click",()=>
{
    displayNone();
    let container=document.getElementById("container");
    container.innerHTML=`
    <div id="exl_srch_student" style="font-weight:bold;width:600px;height:600px;position:relative;top:50%;left:50%;transform:translate(-50%,-50%);background-color: rgba(0, 0, 0, 0.2);border-radius:50%;backdrop-filter: blur(5px);color:aliceblue;">
    <div style="position: absolute;top:50%;left:50%;translate: -50% -50%;">

    <center>   
        <h1>Insert Students' Data Through Excel</h1>  </br> 
        <form id='frmExcelImportStudent' method='post' action=''>
        <input class="form-control" style="background-color: black;color: aliceblue;" id="fileupload1" type="file" name="fileupload1" accept=".xls,.xlsx"/>
        <h6>Note: Excel Format should be same as specified !!!</h6>
        <button class="btn" type="submit" id="upload-button" style='color:aliceblue;background-color:black;'> Upload </button>
        <button type="reset" id="resetissue" class="btn" style="font-weight: bold;background-color: #520702;color: aliceblue;">Clear</button><br><br>

        </form>     
    </center>        
    </div>
    </div>

    <div id="spinner_load" style="height:80vh;align-items:center;justify-content:center;display:none;">
        <div class="spinner-border text-warning" role="status"></div>
    </div>

        <div style="font-weight: bold;" id="response_exl_records_student"></div>
    `;
    async function uploadFile()
    {
        let formData = new FormData(); 
        formData.append("file", fileupload1.files[0]);
        await fetch('Members\\Student\\upload_student.php',
        {
            method: "POST", 
            body: formData 
        }); 
        
        }
    $(document).ready(function()
    {
        $("#upload-button").click(function(e)
        {
            document.getElementById('exl_srch_student').style.display='none';
        })
        $("#frmExcelImportStudent").submit(function(e)
        {
            document.getElementById("spinner_load").style.display = "flex";
            e.preventDefault();
            document.getElementById('exl_srch_student').style.display='none';
            uploadFile();
            $.ajax(
            {
                method: "post",
                url: "Members\\Student\\Student_add_excel.php",
                data: $(this).serialize()+"&Access=Main-Student_add_excel",
                datatype: "text",
                error: function()
                {
                    alert('Some Error Occurred!!!');
                    document.getElementById("spinner_load").style.display="none";
                },
                success: function(Result)
                {
                    document.getElementById("spinner_load").style.display="none";
                    $( "#dialog_exl_disp_student" ).dialog( "destroy" );
                    $("#response_exl_records_student").html(Result);
                    $("#dialog_exl_disp_student").dialog();  
                }
            });
        });
    });
});

//--------------------------------------------------------------------Book Dues

document.querySelector("#dueBook").addEventListener("click",()=>
{
    displayNone();
    let container=document.getElementById("container");
    container.innerHTML=`
    <div style="font-weight: bold;width:100%;" id="response_book_dues"></div>
    `;
    $.ajax(
    {
        method: "post",
        url: "Report\\Books\\Book_dues.php",
        data: "&Access=Main-Book-Dues",
        error: function()
        {
            alert('Some Error Occurred!!!');
        },
        success: function(Result)
        {
            $( "#dialog_book_dues" ).dialog( "destroy" );
            $("#response_book_dues").html(Result);
            $("#dialog_book_dues").dialog();
        }
    });
});

//----------------------------------------------------------Issue_Limit

document.querySelector("#issue_limit").addEventListener('click',()=>
{
    displayNone();
    let container=document.getElementById("container");
    container.innerHTML=`
    <div id="issue_limit_block" style="font-weight:bold;width:600px;height:600px;position:relative;top:50%;left:50%;transform:translate(-50%,-50%);background-color: rgba(0, 0, 0, 0.2);border-radius:50%;backdrop-filter: blur(5px);color:aliceblue;">
    <div style="position: absolute;top:50%;left:50%;translate: -50% -50%;">
    <center>   
        <h1>Change Book Issue Limit</h1>
        <form id='issue_limit_form' method='post' action='' autocomplete='off'>
            <label>Limit:</label>
            <input type='number' name='limit' class='bg-dark form-control' style='color:aliceblue;' required/><br>
            <button class="btn" type="submit" style='color:aliceblue;background-color:black;'> Change </button>
        </form>     
    </center>        
    </div>
    </div>
    <div style="font-weight: bold;" id="response_issue_limit"></div>`;

    $(document).ready(function()
    {
        $("#issue_limit_form").submit(function(e)
        {
            e.preventDefault();
            $.ajax(
            {
                method: "post",
                url: "Books\\Operations\\Book_limit.php",
                data: $(this).serialize()+"&Access=Main-Issue-Limit",
                datatype: "text",
                error: function()
                {
                    alert('Some Error Occurred!!!');
                },
                success: function(Result)
                {
                    $("#dialog_issue_limit").dialog("destroy");
                    $("#response_issue_limit").html(Result);
                    $("#dialog_issue_limit").dialog();
                }
            });
        });
    });
});

//----------------------------------------------------------------Student Issue Check

document.querySelector("#sbc").addEventListener("click",()=>
{
    displayNone();
    let container=document.getElementById("container");
    container.innerHTML=`
    <div id="member_books_check" style="font-weight:bold;width:600px;height:600px;position:relative;top:50%;left:50%;transform:translate(-50%,-50%);background-color: rgba(0, 0, 0, 0.2);border-radius:50%;backdrop-filter: blur(5px);color:aliceblue;">
        <div style="position: absolute;top:50%;left:50%;translate: -50% -50%;">
            <center>   
                <h1>Member Books Check Page</h1>
                <form id='sbc_form' method='post' action='' autocomplete='off'>
                    <label>Member ID:</label>
                    <input type='text' name='mem_id' class='bg-dark form-control' style='color:aliceblue;' required/><br>
                    <button class="btn" type="submit" style='color:aliceblue;background-color:black;'>Check</button>
                    <button type="reset" id="reset_sbc" class="btn" style="font-weight: bold;background-color: #520702;color: aliceblue;">Clear</button>
                </form>     
            </center>        
        </div>
    </div>
    <div style="font-weight: bold;position: absolute; width:1200px;" id="response_member_books_check"></div>`;

    $(document).ready(function()
    {
        $("#reset_sbc").on("click",function()
        {
            document.querySelector("#response_member_books_check").style.display="none";
            document.querySelector("#member_books_check").style.transform="translate(-50%,-50%)";
        });
        $("#sbc_form").submit(function(e)
        {
            e.preventDefault();
            $.ajax(
                {
                    method: "post",
                    url: ".//Report/Members/Member_books_check.php",
                    data: $(this).serialize()+"&Access=Main-Member-Books-Check",
                    datatype: "text",
                    error: function()
                    {
                        alert('Some Error Occurred!!!');
                    },
                    success: function(Result)
                    {
                        document.querySelector("#response_member_books_check").style.display="block";
                        $("#dialog_member_books_check").dialog("destroy");
                        $("#response_member_books_check").html(Result);
                        $("#dialog_member_books_check").dialog();
                    }  
                }
            );
        });
    });
});

//----------------------------------------------------Logout
let sec=0;
const x=setInterval(()=>
{
    document.addEventListener("keydown",()=>
    {
        sec=0;
    });
    document.addEventListener("mousemove",()=>
    {
        sec=0;
    });
    if(sec===300)
    {
        window.addEventListener('beforeunload', function(event) {
            navigator.sendBeacon('Auth\\Logout.php');
        });
        window.open("Auth\\Logout.php","_self");
    }
    sec++;
},1000);