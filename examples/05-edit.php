<?php
/**
 * Insert a new row
 */
$insert = new \Yosko\SqlGenerator($dbh);
$insert->insert('Series');
$insert->setField('title', 'Tintin', \PDO::PARAM_STR);

// true on success, false on error
$result = $insert->execute();

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
 * check added and updated data
 */
$select = new \Yosko\SqlGenerator($dbh);
$select->select('Series');
$data = $select->execute();
