<?php
use Phppot\DataSource;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
include "dbconnect.php";
require_once ('vendor/autoload.php');


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
    $error = "";
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

for($i = 1;$i<$sheetCount; $i++){
    
    $bno = 0;
    if(!empty($spreadSheetAry[$i][0])) $bno=$spreadSheetAry[$i][0];// cases missing for book no
    else
    {
        $sql_max_book = "SELECT Book_No from books;";
        $res=$conn->query($sql_max_book);
        if(!$res)echo "
        <div id='dialog3' style='color:red;' title='⚠️Error'>
        <p><center>$conn->error</center></p>
        </div>
        "; 
        while($row =$res->fetch_assoc())
        {
            if((int)preg_replace("/[^0-9]/","",$row["Book_No"]) > $bno) $bno = (int)preg_replace("/[^0-9]/","",$row["Book_No"]);
        }
        $bno += 1;
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
    if(!empty($spreadSheetAry[$i][13])) $bookcount=$spreadSheetAry[$i][13];
    else $bookcount=1; 
    
    $error = ErrorCheck($author1,$author2,$author3,$title,$edition,$publisher,$cl_no,$total_pages);
    if(strlen($error) > 0){
        echo $error."At Index: ".$i+1;
        break;
    }
    if(!array_key_exists($bno,$Book_Record))$Book_Record[$bno]= array($author1,$author2,$author3,$edition,$publisher,$cl_no,$total_pages,$cost,$supplier,$remark,$billno,$bookcount);
    
}
    print_r($Book_Record);
    
?>