<?php

use PhpOffice\PhpSpreadsheet\Calculation\Logical\Boolean;
use Phppot\DataSource;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
include "dbconnect.php";
require_once ('vendor/autoload.php');

$BookIndex =0;
$BookSlots =[]; // Available slots in between
$error = "";

function Book_check($b,$count){
    include "dbconnect.php";
    for($i = 0; $i <= $count; $i++)
    {
        $b += 1;
        $sql = "SELECT Book_No from books WHERE Book_No = '$b';";
        $res = $conn->query($sql);
        if(mysqli_num_rows($res) != 0)return false;
    }
    return true;
}

function set_BookIndex($count){
    include "dbconnect.php";
    global $BookSlots;
    global $BookIndex;
    $flag = true;
    if($count == 1 && count($BookSlots)>=1){
        $BookIndex = $BookSlots[0];
        unset($BookSlots[0]);
        return;
    }
    if(count($BookSlots)>= $count){
        $a = $BookSlots;
        array_push($a, 0);
        $res = [];
        $stage = [];

        foreach($a as $i) {
            if(count($stage) > 0 && $i != $stage[count($stage)-1]+1) {
                if(count($stage) > 1) {
                    $res[] = $stage;
                }
                $stage = [];
            }
            $stage[] = $i;
        }
        foreach($res as $slot){
            if(count($slot)>= $count){
                $BookIndex = $slot[0];
                return;
            }
        }

        $sql_max_book = "SELECT Book_No from books;";
        $res=$conn->query($sql_max_book);
        $bookno = 0;
        while($row =$res->fetch_assoc())
        {
            if((int)preg_replace("/[^0-9]/","",$row["Book_No"]) > $bookno) $bookno = (int)preg_replace("/[^0-9]/","",$row["Book_No"]);
        }
        $BookIndex = $bookno +1;
        return;
    }
    else{
        $sql_max_book = "SELECT Book_No from books;";
        $res=$conn->query($sql_max_book);
        $bookno = 0;
        while($row =$res->fetch_assoc())
        {
            if((int)preg_replace("/[^0-9]/","",$row["Book_No"]) > $bookno) $bookno = (int)preg_replace("/[^0-9]/","",$row["Book_No"]);
        }
        $BookIndex = $bookno +1;
        return;
    }
}

function Book_num($book_seq){
    include "dbconnect.php";
    global $BookIndex; 
    global $BookSlots;
    $sql = "Select Book_No from books Order By Book_No ASC;";
    $res = $conn->query($sql);
    echo $conn->error;
    while($row =$res->fetch_assoc()){
        array_push( $book_seq, $row["Book_No"]);
    }
    $max = max($book_seq);
    for($i = 1; $i < $max; $i++){
        if(!in_array($i,$book_seq)) array_push($BookSlots,$i);
    }
    sort($BookSlots);
}
function check($b, $count)
{
    include "dbconnect.php";
    for($i = 0; $i <= $count; $i++)
    {
        $b += 1;
        $sql = "SELECT Book_No from books WHERE Book_No = '$b';";
        $res = $conn->query($sql);
        if(mysqli_num_rows($res) != 0)return false;
    }
    return true;
}

function ErrorCheck($a1,$a2,$a3,$title,$ed,$pub,$cl,$tpag){
    global $error;
    if($a1 == null && $a2 == null && $a3 == null){
        $error = $error."Author not found";
    }
    if($title == null){
        $error = $error."Title not found";
    }
    if($ed == null){
        $error = $error."edition not found";
    }
    if($pub == null){
        $error = $error."publisher not found";
    }
    if($cl == null){
        $error = $error."Cl No of book not found";
    }
    if($tpag == null){
        $error = $error."Total No of Book pages missing";
    }
    return $error;
}

$targetPath = "Book_insert.xlsx";
$Reader = new Xlsx();

$spreadSheet = $Reader->load($targetPath);
$excelSheet = $spreadSheet->getActiveSheet();
$spreadSheetAry = $excelSheet->toArray();
$sheetCount = count($spreadSheetAry);
$bno =0;
$Book_Record =[];
$error;
$author1;
$author2;
$author3;
$edition;
$publisher;
$cl_no;
$total_pages;
$cost;
$supplier;
$remark;
$billno;
$bookcount;

$bookserial =[];
for($i = 1;$i<$sheetCount; $i++){
    $b = 0;
    $count = 0;
    if(!empty($spreadSheetAry[$i][0])){
        if(!empty($spreadSheetAry[$i][13])) $count=$spreadSheetAry[$i][13];
        else $count=1;
        $b = $spreadSheetAry[$i][0];
        for($j= 0;$j<$count;$j++){
            array_push($bookserial,$b+$j);
        }
    }
}

Book_num($bookserial);
// print_r($BookSlots);

for($i = 1;$i<$sheetCount; $i++){
    
    $bno = 0;
    if(!empty($spreadSheetAry[$i][13])) $bookcount=$spreadSheetAry[$i][13];
    else $bookcount=1; 

    if(!empty($spreadSheetAry[$i][0])){
        $bno=$spreadSheetAry[$i][0];// cases missing for book no
        if(!Book_check($bno,$bookcount)){
            $error = $error."unable to insert book's at $bno already present!!!";
            break;
        } 
    }
    else
    {
        set_BookIndex($bookcount);
        $bno =$BookIndex;
    }
    if(!empty($spreadSheetAry[$i][1])) $title=$spreadSheetAry[$i][1];
    
    if(!empty($spreadSheetAry[$i][2])) $author1=$spreadSheetAry[$i][2];
    else
    {
        $author1=null;
    }
    if(!empty($spreadSheetAry[$i][3])) $author2=$spreadSheetAry[$i][3];
    else
    {
        $author2=null;
    }
    if(!empty($spreadSheetAry[$i][4])) $author3=$spreadSheetAry[$i][4];
    else
    {
        $author3=null;
    }
    if(!empty($spreadSheetAry[$i][4]) && empty($spreadSheetAry[$i][3]))
    {
        $author2=$spreadSheetAry[$i][4];
        $author3=null;
    }
    if(!empty($spreadSheetAry[$i][3]) && empty($spreadSheetAry[$i][2]))
    {
        $author1=$spreadSheetAry[$i][3];
        $author2=$spreadSheetAry[$i][4];
        $author3=null;
    }
    if(!empty($spreadSheetAry[$i][5]))$edition=$spreadSheetAry[$i][5];
    else $edition=null;
    if(!empty($spreadSheetAry[$i][6]))$publisher=$spreadSheetAry[$i][6];
    else $publisher=null;
    if(!empty($spreadSheetAry[$i][7]))$cl_no=$spreadSheetAry[$i][7];
    else $cl_no=null;
    if(!empty($spreadSheetAry[$i][8]))$total_pages=$spreadSheetAry[$i][8];
    else $total_pages=null;
    if(!empty($spreadSheetAry[$i][9])) $cost=$spreadSheetAry[$i][9];
    else $cost=null;
    if(!empty($spreadSheetAry[$i][10])) $supplier=$spreadSheetAry[$i][10];
    else $supplier=null;
    if(!empty($spreadSheetAry[$i][11]))$remark=$spreadSheetAry[$i][11];
    else $remark=null;
    if(!empty($spreadSheetAry[$i][12])) $billno=$spreadSheetAry[$i][12];
    else $billno=null;
    
    $error = ErrorCheck($author1,$author2,$author3,$title,$edition,$publisher,$cl_no,$total_pages);
    if(strlen($error) > 0){
        echo $error."At Index: ".$i+1;
        break;
    }
    if(!array_key_exists($bno,$Book_Record))$Book_Record[$bno]= array($author1,$author2,$author3,$edition,$publisher,$cl_no,$total_pages,$cost,$supplier,$remark,$billno,$bookcount);
    
}
print_r($Book_Record);


?>