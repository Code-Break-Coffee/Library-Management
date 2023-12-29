<?php
$a = [8, 13, 14, 10, 6, 7, 8, 14, 15, 3, 5, 2, 6, 7, 4, 5,8];

$res = [];
$stage = [];

foreach($a as $i) {
    if(count($stage) > 0 && $i != $stage[count($stage)-1]+1) {
        if(count($stage) >= 1) {
            $res[] = $stage;
        }
        $stage = [];
    }
    $stage[] = $i;

}
print_r($res);
echo "<br>";
print_r($a);