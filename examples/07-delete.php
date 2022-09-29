<?php
/**
 * delete a row
 */
$delete = new \Yosko\SqlGenerator($dbh);
$delete->delete('Series');
$delete->where('id = 4');
$result = $delete->execute();
var_dump($result);

/**
 * check that it is gone
 */
$sg = new \Yosko\SqlGenerator($dbh);
$sg->select('Series');
$data = $sg->execute();