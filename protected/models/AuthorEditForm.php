<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 07.03.18
 * Time: 9:20
 */

class AuthorEditForm extends CFormModel
{
    public $id;
    public $name;

    public function rules()
    {
        return array(
            array('id', 'required'),
            array('name', 'required', 'message' => 'Поле "имя автора" не может быть пустым'),
        );
    }
}