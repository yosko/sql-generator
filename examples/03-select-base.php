<?php
// you should instantiate a new SqlGenerator object for each query
$sg = new \Yosko\SqlGenerator($dbh);

// prepare statement
$sg->select('Series');

// execute it and fetch results
$data = $sg->execute();