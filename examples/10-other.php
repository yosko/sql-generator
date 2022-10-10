<?php
$firstName = 'Jean';
$sg = new \Yosko\SqlGenerator($dbh);
$sg->select('Author')->where('firstName = :fn', 'fn', $firstName, PDO::PARAM_STR);

$data = [
    'query type' => $sg->type(),
    'SQL query' => $sg->toString(),
    'parameters' => $sg->getParams()
];