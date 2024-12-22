import { setupAjax } from './ajaxHandler.js';
import { displayBookIssueForm } from './bookIssueForm.js';

$(document).ready(function() {
    setupAjax();
});

document.getElementById("i").addEventListener("click", displayBookIssueForm);