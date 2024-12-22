function setupBookIssueForm() {
    return `
    <div class='dabbe'>
        <div class='dabbe_ka_dabba' id="issuefield">
            <div class="dabbe_k_dabbe_ka_dabba">
                <form id="issuebook" method="post" action="" autocomplete="off">
                    <center>
                        <h1>Book Issue Form</h1>
                        <br>
                        <label>Member Type:</label><br><label class="form-check-label">Student:</label>&nbsp;
                        <input type="radio" name="membertype" checked class="form-check-input new_css_input" value="Student" style="color:#ffffff;"/>
                        <label class="form-check-label">Faculty:</label>&nbsp;&nbsp;
                        <input type="radio" name="membertype" class="form-check-input new_css_input" value="Faculty" style="color:#ffffff;"/><br><br>
                        
                        <div class="row">
                            <div class="col-8 col-lg-8 col-md-8 col-sm-8 col-xl-8">
                                <label>Member ID:</label>
                                <input id="memberid" required type="text" name="memberid" class="form-control new_css_input" style="width:100%;color:#ffffff;" placeholder="Scan the Barcode or Enter Member ID"/>
                            </div>
                            <div class="col-4 col-lg-4 col-md-4 col-sm-4 col-xl-4">
                                <input type="button" id="issuecheck" class="btn new_css_btn" value="Check"  style="position:relative;top:23px;font-weight: bold;"/>
                            </div>
                        </div>
                            <br>
                        <label>Book Number:</label>
                        <input required type="text" name="bookno" class="form-control new_css_input" style="width:100%;color:#ffffff;" placeholder="Scan the Barcode or Enter Book No."/><br>

                        <input type="submit" class="btn new_css_btn" style="font-weight: bold;" value="Issue"/>
                        <button type="reset" id="resetissue" class="btn new_css_btn" style="font-weight: bold;">Clear</button><br><br>
                    </center>
                </form>
            </div>
        </div>
    </div>`;
}

function displayBookIssueForm() {
    displayNone();
    let container = document.getElementById("container");
    container.innerHTML = setupBookIssueForm();
}

document.getElementById("i").addEventListener("click", displayBookIssueForm);