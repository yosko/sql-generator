<?php
$sg = new \Yosko\SqlGenerator($dbh);
$sg->beginTransaction();

try {
    // here, do SqlGenerator stuff likely to throw an exception

    if ($sg->inTransaction()) {
        // do other stuff here
    }

    $sg->commit();
} catch (Exception $e) {
    $sg->rollback();
    echo $e->getMessage();
}