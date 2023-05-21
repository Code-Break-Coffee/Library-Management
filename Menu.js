document.getElementById("h").addEventListener('click',()=>
{
    var container=document.getElementById("contain");
    container.innerHTML="";
});
document.getElementById("i").addEventListener('click',()=>
{
    var container=document.getElementById("contain");
    container.innerHTML="";
    $("#contain").load("./Issue.html");
});

document.getElementById("r").addEventListener('click',()=>
{
    var container=document.getElementById("contain");
    container.innerHTML="";
    $("#contain").load("./Return.html");
});

document.getElementById("ins").addEventListener('click',()=>
{
    var container=document.getElementById("contain");
    container.innerHTML="";
    $("#contain").load("./Insert.html");
});