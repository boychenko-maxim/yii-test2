<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 07.03.18
 * Time: 7:15
 */

class Author extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'authors';
    }

    public function relations()
    {
        return array(
            'books' => array(self::MANY_MANY, 'Book', 'booksauthors(authorsid, booksid)'),
        );
    }
}