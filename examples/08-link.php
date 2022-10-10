<?php
$sg = new \Yosko\SqlGenerator($dbh);
$data = $sg->select('Series', 's', ['series' => 's.title'])
    ->innerJoin('Volumes', 'v', 'v.seriesId = s.id', ['volume' => 'v.volumeNumber', 'v.title'])
    ->where('substr(v.title, 1, 1) = "L"')
    ->execute();