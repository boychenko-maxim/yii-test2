<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 07.03.18
 * Time: 14:05
 */

class Book extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'books';
    }

    public function relations()
    {
        return array(
            'authors' => array(self::MANY_MANY, 'Author', 'booksauthors(booksid, authorsid)'),
        );
    }
}