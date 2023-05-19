document.getElementById("home").addEventListener('click',()=>
{
    var container=document.getElementById("contain");
    container.style.background="url(Library.jpg)";
    container.style.backgroundRepeat="no-repeat";
    container.style.backgroundPosition="center";
    container.style.backgroundSize="cover";
});

document.getElementById("issue").addEventListener('click',()=>
{
    var container=document.getElementById("contain");
    container.style.background="none";
    // container.style.backgroundColor="#5cdb95";
    container.style.backgroundColor="aliceblue";
    container.style.color="#05386b";
});