<?php
//define the type of query you want to execute:
$sg->select('Series', 's', ['id', 'title'], true);
$sg->insert('Series');
$sg->update('Series');
$sg->delete('Series');
$sg->type(); // check current query type, based on SqlGenerator::TYPE_* constants

/**
 * Additional methods for any query
 */
// SqlGenerator::bindParam() encapsulates PDO::bindParam()
// usually not used directly
$sg->bindParam('id', 3, PDO::PARAM_INT);
// joints : ->innerJoin(), ->leftJoin(), ->rightJoin(), ->outerJoin(), ->join() (default join)
$sg->innerJoin('Volumes', 'v', 's.id = v.seriesId', ['id', 'title']);
$sg->where('s.title = :greatTitle', 'greatTitle', 'Thorgal', PDO::PARAM_STR);
$sg->groupBy('s.title');
$sg->orderBy('s.title', 'asc');
$sg->having(); // not implemented yet, should work like ->where()


/**
 * Additional methods for TYPE_SELECT query
 */
$sg->unionSelect((new \Yosko\SqlGenerator($dbh))->select('Volumes'));
// add additional fields afterwards
$sg->addSelectFields(['title']);
$sg->limit(25, 125);

/**
 * Additional methods for TYPE_INSERT or TYPE_UPDATE query
 */
$sg->setField('title', 'New Title', PDO::PARAM_STR);

/**
 * final actions : execute query
 */
$data = $sg->execute('fetchAll', PDO::FETCH_CLASS, 'Series');

/**
 * other
 */
// for debug purpose
$queryString = $sg->toString();
$params = $sg->getParams();
$sg->executeFile('path/to/file.sql');
$id = $sg->lastInsertId();

/**
 * transactions
 */
$sg->beginTransaction();
$sg->inTransaction(); // check if currently in transaction
$sg->commit();
$sg->rollback();