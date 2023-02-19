function displayed()
{
    var anchors=document.getElementsByClassName("anchors");
    for(var a=0;a<anchors.length;a++)
    {
        anchors[a].style.display="block";
    }
}
function frame()
{   
    var t1=100,l1=150,t2=100,l2=150,t3=100,l3=150,t4=100,l4=150,t5=100,l5=150,flag1=100,flag2=100;
    var i=document.getElementById("insertion");
    var d=document.getElementById("deletion");
    var is=document.getElementById("issue");
    var r=document.getElementById("return");
    var m=document.getElementById("member");
    var skip1=setInterval(insertion,-5);
    var skip2=setInterval(deletion,-5);
    var skip3=setInterval(issue,-5);
    var skip4=setInterval(returned,-5);
    var skip5=setInterval(member,-5);
    function insertion()
    {
        flag1++;
        if(flag1<310)
        {
            t1++;
            l1+=2;
        }
        if(flag1>=310)
        {
            t1--;
            l1+=2;
        }
        if(t1<=100 && l1>=700)
        {
            clearInterval(skip1);
        }
        i.style.top=t1+"px";
        i.style.left=l1+"px";
    }

    function deletion()
    {
        if(t2<310)
        {
            t2++;
            l2+=2;
        }
        if(t2==310)
        {
            l2+=2;
        }
        if(l2==968)
        {
            clearInterval(skip2);
        }
        d.style.top=t2+"px";
        d.style.left=l2+"px";
    }

    function issue()
    {
        if(l3<1010 && t3<600)
        {
            l3+=2;
            t3++;
        }
        else
        {
            clearInterval(skip3);
        }
        is.style.top=t3+"px";
        is.style.left=l3+"px";
    }

    function returned()
    {
        if(l4<550)
        {
            l4+=2;
            t4++;
        }
        if(l4==550)
        {
            t4++;
        }
        if(t4==530)
        {
            clearInterval(skip4);
        }
        r.style.top=t4+"px";
        r.style.left=l4+"px";
    }

    function member()
    {
        flag2++;
        if(flag2<310)
        {
            l5+=2;
            t5++;
        }
        if(flag2>=310)
        {
            l5-=2;
            t5++;
        }
        if(l5<=150 && t5>=530)
        {
            clearInterval(skip5);
        }
        m.style.top=t5+"px";
        m.style.left=l5+"px";
    }
}
