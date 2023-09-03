<?php
include "dbconnect.php";
$books = array("CPP", "Java", "Python", "JS", "PHP", "Fortron", "Sys. Prog", "React", "Android", "Fluter");
$author = array("jhon", "nathkat soham", "smuggler overload", "joe", "homelander", "rick", "simp kratos", "NPC", "Deep", "jhon snow");
// for($i=11;$i<101;$i++)
// {
//     $b = $books[$i %10];
//     $e = $i %10;
//     $sql="INSERT into books (Book_No,Author1,Author2,Author3,Title,Edition,Publisher,CL_No,Total_Pages,Cost) values('$i','Nathkhat Kothari','Tanishq smuggler','NPC','$b', '$e', 'Smuggler.org','$e','696', '6000')";
//     $result=$conn->query($sql);
//     if($result) echo "$i record added!!!\n";
//     else echo $conn->error;
// }
for($i=0;$i<10;$i++)
{
    $sql="INSERT INTO suggestion(Book_value,category) values('$author[$i]','Author')";
    $result=$conn->query($sql);
    if($result) echo "$i record added!!!\n";
    else echo $conn->error;
}
