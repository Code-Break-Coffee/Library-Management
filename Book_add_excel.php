<?php
require_once ('vendor/autoload.php');
// namespace PhpOffice\PhpSpreadsheetTests\Reader\Xlsx;
include "dbconnect.php";

        
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

    
    // $allowedFileType = [
    //     'application/vnd.ms-excel',
    //     'text/xls',
    //     'text/xlsx',
    //     'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    // ];


        $flag=1;
        $targetPath = 'Doc/book.xlsx';
        // $Reader = new \PhpSpreadsheet\Reader\Xlsx();
        $Reader = new Xlsx();
        $spreadSheet = $Reader->load($targetPath);
        $excelSheet = $spreadSheet->getActiveSheet();
        $spreadSheetAry = $excelSheet->toArray();
        $sheetCount = count($spreadSheetAry);

        for ($i = 1; $i < $sheetCount; $i++) 
        {

            $num1=$spreadSheetAry[$i][0];
            $num2=$spreadSheetAry[$i][1];


            if (!empty($num1) && !empty($num2))
             {      
                $sql="INSERT INTO zakexp (num1,num2) values ($num1,$num2);";
                $result=$conn->query($sql);
                // $query = "insert into tbl_info(name,description) values(?,?)";
                // $paramType = "ss";
                // $paramArray = array(
                //     $name,
                //     $description
                // );
                // $insertId = $db->insert($query, $paramType, $paramArray);
                // $query = "insert into tbl_info(name,description) values('" . $name . "','" . $description . "')";
                // $result = mysqli_query($conn, $query);

                if (!$result) 
                {
                    $flag=0;
                } 
            }
        }
        if ($flag) 
        {
            echo "
            <div id='dialog_exl_disp' style='color:green;' title='✅Successful'>
                <p><center>Books Inserted Successfully</center></p>
            </div>
            ";
        } else 
        {
            echo "
            <div id='dialog_exl_disp' style='color:green;' title='✅Successful'>
                <p><center>$conn->error</center></p>
            </div>
            ";
        }


        // declare(strict_types=1);

        // namespace PhpOffice\PhpSpreadsheetTests\Reader\Xlsx;
        
        // use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
        // use PHPUnit\Framework\TestCase;
        
        // class AbsolutePathTest extends TestCase
        // {
        //     public static function testPr1869(): void
        //     {
        //         $xlsxFile = 'tests/data/Reader/XLSX/pr1769e.xlsx';
        //         $reader = new Xlsx();
        //         $result = $reader->listWorksheetInfo($xlsxFile);
        
        //         self::assertIsArray($result);
        //         self::assertEquals(3, $result[0]['totalRows']);
        //     }
        // }
?>