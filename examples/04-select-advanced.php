<?php
$sg = new \Yosko\SqlGenerator($dbh);

// define a table alias and explicitly choose columns
$sg->select('Series', 's', [
    'seriesId' => 's.id'
]);

// choose additional columns afterwards
$sg->addSelectFields([ 'seriesTitle' => 's.title']);

// joins (or leftJoin, rightJoin, outerJoin, join, or even unionSelect) are possible
$sg->innerJoin('Volumes', 'v', 'v.seriesId = s.id', ['count(v.id) as volumes']);
$sg->leftJoin('VolumesAuthors', 'va', 'va.volumeId = v.id');
$sg->leftJoin('Authors', 'a', 'a.id = va.authorId', ['name' => 'firstName || " " || lastName']);

// where clause (multiple calls will result in an inclusive clause: conditions separated by AND keyword)
$sg->where('a.firstName = :firstName', 'firstName', 'Jean', PDO::PARAM_STR);
$sg->where('v.volumeNumber > 0');
// if you need to use OR, write multiple conditions in a single call to ->where()

$sg->groupBy('seriesId');
$sg->groupBy('a.id');

$sg->orderBy('a.lastName', 'asc');
$sg->orderBy('a.firstName', 'desc');

// unimplemented methods:
// $sg->having(...);

// could be used in another statement:
//$sg->limit(25, 125);

// choose fetch method based on a class
class Series
{
    public int $id;
    public string $title;
}
$data = $sg->execute('fetchAll', PDO::FETCH_CLASS, 'Series');

$sql = $sg->toString();