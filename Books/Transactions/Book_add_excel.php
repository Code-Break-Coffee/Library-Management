<?php
@session_start();
include "../../Auth/auth.php";
//include $_SERVER['DOCUMENT_ROOT'] . "/LibraryManagement/Auth/auth.php";
include "../../connection/dbconnect.php";
require_once("../../vendor/autoload.php");

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

$BookIndex = 0;
$BookSlots = []; // Available slots in between
$MaxBookIndex = 0;
$error = "";
$Data_Status = false;

// Clear the insert buffer
$sql_delete = "DELETE FROM `insert buffer`;";
$conn->query($sql_delete);

// Check access and verification
if (!verification() || $_POST["Access"] != "Main-Book_add_excel") {
    header("Location: /LibraryManagement/");
    exit();
}

function Book_check($b, $count) {
    global $conn, $error;
    for ($i = 0; $i < $count; $i++) {
        $sql = "SELECT Book_No FROM books WHERE Book_No = '$b';";
        $res = $conn->query($sql);
        if ($res->num_rows != 0) {
            $error .= "Unable to insert book at $b, already present!!!";
            return false;
        }
        $b++;
    }
    return true;
}

function set_BookIndex($count) {
    global $conn, $BookSlots, $BookIndex, $MaxBookIndex;
    if ($count == 1 && count($BookSlots) >= 1) {
        $BookIndex = $BookSlots[0];
        return;
    }
    if (count($BookSlots) >= $count) {
        $a = $BookSlots;
        array_push($a, 0);
        $res = [];
        $stage = [];
        foreach ($a as $i) {
            if (count($stage) > 0 && $i != $stage[count($stage) - 1] + 1) {
                if (count($stage) > 1) {
                    $res[] = $stage;
                }
                $stage = [];
            }
            $stage[] = $i;
        }
        foreach ($res as $slot) {
            if (count($slot) >= $count) {
                $BookIndex = $slot[0];
                return;
            }
        }
        $BookIndex = $MaxBookIndex + 1;
        $MaxBookIndex += $count;
        return;
    } else {
        $BookIndex = $MaxBookIndex + 1;
        $MaxBookIndex += $count;
        return;
    }
}

function Book_num($book_seq, $update) {
    global $conn, $BookSlots, $MaxBookIndex;
    if ($update == 0) {
        $sql = "SELECT Book_No FROM books ORDER BY Book_No ASC;";
        $res = $conn->query($sql);
        while ($row = $res->fetch_assoc()) {
            $book_seq[] = $row["Book_No"];
        }
        if(count($book_seq) > 0) {
            $MaxBookIndex = max($book_seq);
        }
        else{
            $MaxBookIndex = 0;
        }
        for ($i = 1; $i < $MaxBookIndex; $i++) {
            if (!in_array($i, $book_seq)) $BookSlots[] = $i;
        }
        sort($BookSlots);
    } else {
        foreach ($book_seq as $i) {
            if (!in_array($i, $book_seq)) $BookSlots[] = $i;
        }
        sort($BookSlots);
        if (count($book_seq) > 0) {
            $MaxBookIndex = max($book_seq);
        } else {
            $MaxBookIndex = 0; 
        }
        
    }
}

function ErrorCheck($a1, $a2, $a3, $title, $ed, $pub, $cl, $tpag) {
    global $error;
    if ($a1 == null && $a2 == null && $a3 == null) {
        $error .= "Author not found ";
    }
    if ($title == null) {
        $error .= "Title not found ";
    }
    if ($ed == null) {
        $error .= "Edition not found ";
    }
    if ($pub == null) {
        $error .= "Publisher not found ";
    }
    if ($cl == null) {
        $error .= "Cl No of book not found ";
    }
    if ($tpag == null) {
        $error .= "Total No of Book pages missing ";
    }
    return $error;
}

$targetPath = "../../Doc/book.xlsx";
$Reader = new Xlsx();
$spreadSheet = $Reader->load($targetPath);
$excelSheet = $spreadSheet->getActiveSheet();
$spreadSheetAry = $excelSheet->toArray();
$sheetCount = count($spreadSheetAry);
$bno = 0;
$error = "";
$Book_Record = [];

$bookserial = [];
for ($i = 1; $i < $sheetCount; $i++) {
    if (!empty($spreadSheetAry[$i][0])) {
        $count = !empty($spreadSheetAry[$i][13]) ? $spreadSheetAry[$i][13] : 1;
        $b = $spreadSheetAry[$i][0];
        for ($j = 0; $j < $count; $j++) {
            $bookserial[] = $b + $j;
        }
    }
}

$temp_array = array_unique($bookserial);
if (sizeof($temp_array) == sizeof($bookserial)) {
    Book_num($bookserial, 0);
    $conn->begin_transaction();
    try {
        for ($i = 1; $i < $sheetCount; $i++) {
            $bookcount = !empty($spreadSheetAry[$i][13]) ? $spreadSheetAry[$i][13] : 1;
            $bno = !empty($spreadSheetAry[$i][0]) ? $spreadSheetAry[$i][0] : 0;

            if ($bno == 0) {
                set_BookIndex($bookcount);
                $bno = $BookIndex;
                $bookTempSlot = [];
                for ($k = 0; $k < $bookcount; $k++) {
                    $bookTempSlot[] = $bno + $k;
                }
                Book_num($bookTempSlot, 1);
            } else if (!Book_check($bno, $bookcount)) {
                throw new Exception($error);
            }

            $title = $spreadSheetAry[$i][1] ?? null;
            $author1 = $spreadSheetAry[$i][2] ?? null;
            $author2 = $spreadSheetAry[$i][3] ?? null;
            $author3 = $spreadSheetAry[$i][4] ?? null;
            $edition = $spreadSheetAry[$i][5] ?? null;
            $publisher = $spreadSheetAry[$i][6] ?? null;
            $cl_no = $spreadSheetAry[$i][7] ?? null;
            $total_pages = $spreadSheetAry[$i][8] ?? null;
            $cost = $spreadSheetAry[$i][9] ?? null;
            $supplier = $spreadSheetAry[$i][10] ?? null;
            $remark = $spreadSheetAry[$i][11] ?? null;
            $billno = $spreadSheetAry[$i][12] ?? null;

            $error = ErrorCheck($author1, $author2, $author3, $title, $edition, $publisher, $cl_no, $total_pages);
            if (!empty($error)) {
                throw new Exception($error . " At Index: " . ($i + 1));
            }

            if (!isset($Book_Record[$bno])) {
                $Book_Record[$bno] = [
                    $author1, $author2, $author3, $title, $edition, $publisher,
                    $cl_no, $total_pages, $cost, $supplier, $remark, $billno, $bookcount
                ];
            }
        }

        if (count($Book_Record) > 0) {
            $Data_Status = true;
            echo "<div style='width:50%; height:600px; position:relative; transform:translate(450px,90px); background-color: #783E12; border-radius: 10px; padding: 20px; overflow:hidden; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);'>
            <center>
            <h1 style='font-weight:bold; color:white;'>Book Confirmation Page</h1><br/>
            <div style='overflow-y:auto; height:450px; scrollbar-width:none; -ms-overflow-style:none;'>
            <table style='width:100%; color:white; border-collapse:collapse;'>
            <tr>
                <th colspan='6' style='padding:10px; font-size:18px;'><center>Are You Sure You Want to Submit?</center></th>
            </tr>
            <tr>
                <th style='padding:10px; border-bottom:1px solid #ddd;'>Book No.</th>
                <th style='padding:10px; border-bottom:1px solid #ddd;'>Authors</th>
                <th style='padding:10px; border-bottom:1px solid #ddd;'>Title</th>
                <th style='padding:10px; border-bottom:1px solid #ddd;'>Edition</th>
                <th style='padding:10px; border-bottom:1px solid #ddd;'>Publisher</th>
                <th style='padding:10px; border-bottom:1px solid #ddd;'>No of Copies</th>
            </tr>
            <tbody>";

            ksort($Book_Record);
            $i = 1;
            foreach ($Book_Record as $bn => $b) {
                echo "<tr>
                <td style='padding:10px; border-bottom:1px solid #ddd;'>{$bn}</td>
                <td style='padding:10px; border-bottom:1px solid #ddd;'>{$b[0]}, {$b[1]}, {$b[2]}</td>
                <td style='padding:10px; border-bottom:1px solid #ddd;'>{$b[3]}</td>
                <td style='padding:10px; border-bottom:1px solid #ddd;'>{$b[4]}</td>
                <td style='padding:10px; border-bottom:1px solid #ddd;'>{$b[5]}</td>
                <td style='padding:10px; border-bottom:1px solid #ddd;'>{$b[12]}</td>
              </tr>";
                // Escape single quotes in each field using regex
                foreach ($b as $key => $value) {
                    if (is_string($value)) {
                        $b[$key] = preg_replace("/'/", "\\'", $value);
                    }
                }
            
                $sql = "INSERT INTO `insert buffer` (id, val1, val2, val3, val4, val5, val6, val7, val8, val9, val10, val11, val12, val13, val14)
                        VALUES ($i, '{$b[0]}', '{$b[1]}', '{$b[2]}', '{$b[3]}', '{$b[4]}', '{$b[5]}', {$b[6]}, {$b[7]}, {$b[8]}, '{$b[9]}', '{$b[10]}', '{$b[11]}', {$b[12]}, $bn)";
            
                if (!$conn->query($sql)) {
                    throw new Exception($conn->error);
                }
            
                $i++;
            }

            echo "</tbody></table>
            </div>
            <div style='position:sticky; bottom:0; background-color:#783E12; padding:10px; width:100%; text-align:center;'>
                <button class='btn' type='submit' id='excelConfirm' style='font-weight: bold; color:black; background-color:#ffffff; padding:10px 20px; border:none; border-radius:5px; cursor:pointer;'>Confirm</button>
                <button type='reset' id='backissue' class='btn' style='font-weight: bold; background-color:#ffffff; color:black; padding:10px 20px; border:none; border-radius:5px; cursor:pointer;'>Back</button>
            </div>
            </center>
            <style>
            div::-webkit-scrollbar {
                display: none; /* Hide scrollbar in WebKit browsers */
            }
            </style>
            <script>
            $(document).ready(function() {
                $('#backissue').on('click', function() {
                    document.getElementById('response_exl_records').style.display = 'none';
                    document.getElementById('exl_srch').style.alignItems = 'center';
                    document.getElementById('exl_srch').style.justifyContent = 'center';
                    document.getElementById('exl_srch').style.display = 'flex';
                });
                $('#excelConfirm').click(function(e) {
                    $.ajax({
                        method: 'post',
                        url: './Books/Transactions/Book_insert_buffer.php',
                        data: 'Access=Book_add_excel-insert_buffer',
                        datatype: 'text',
                        error: function() {
                            alert('Some Error Occurred!!!');
                        },
                        success: function(Result) {
                            $('#dialog_exl_disp').dialog('destroy');
                            $('#response_exl_records').html(Result);
                            $('#dialog_exl_disp').dialog();
                        }
                    });
                });
            });
            </script>
          </div>";
        } else {
            throw new Exception("Excel File is Empty!!!");
        }
        $conn->commit();
    } catch (Exception $e) {
        $conn->rollback();
        echo "<div id='dialog_exl_disp' style='color:red;' title='❌Not Allowed'><p><center>{$e->getMessage()}</center></p></div>";
    }
} else {
    echo "<div id='dialog_exl_disp' style='color:red;' title='❌Not Allowed'><p><center>Duplicate Records</center></p></div>";
}
?>
