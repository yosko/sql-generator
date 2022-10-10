<?php
/**
 * Insert a new row
 */
$insert = new \Yosko\SqlGenerator($dbh);
$insert->insert('Series');
$insert->setField('title', 'Tintin', \PDO::PARAM_STR);

// true on success, false on error
$result = $insert->execute();
$lastInsertedId = $insert->lastInsertId();
var_dump("last inserted id", $lastInsertedId);

/**
 * check added data
 */
$select = new \Yosko\SqlGenerator($dbh);
$select->select('Series');
$data = $select->execute();