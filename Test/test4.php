<?php
$u = "admin";
$p = "12345678";
$hash = password_hash($u.$p, PASSWORD_BCRYPT);
echo $hash;


$a = new DateTime('08:00');
$b = new DateTime('16:00');
$interval = $a->diff($b);
echo"<br>";
echo $interval->format("%H");
$log = date(DATE_RFC2822);
$log2= 'Sat, 13 Jul 2024 15:51:05 +0530';
$inte= (new DateTime($log))->diff(new DateTime($log2));
echo"<br>";
echo $inte->format("%Y%M%D%H%i%s");