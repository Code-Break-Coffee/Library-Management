<?php
$u = "admin";
$p = "12345678";
$hash = password_hash($u.$p, PASSWORD_BCRYPT);
echo $hash;