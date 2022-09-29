<?php
$dbh = new PDO('sqlite:db.db');
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sg = new \Yosko\SqlGenerator($dbh);