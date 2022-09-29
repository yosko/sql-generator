<?php
/**
 * Update an existing row
 */
$update = new \Yosko\SqlGenerator($dbh);
$update->update('Series');
$update->setField('title', 'Thorgal Aegirsson', \PDO::PARAM_STR);
$update->where('title = "Thorgal"');

// true on success, false on error
$result = $update->execute();

/**
 * check updated data
 */
$select = new \Yosko\SqlGenerator($dbh);
$select->select('Series');
$data = $select->execute();