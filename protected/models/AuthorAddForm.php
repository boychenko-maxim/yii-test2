<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 07.03.18
 * Time: 13:51
 */

class AuthorAddForm extends CFormModel
{
    public $name;

    public function rules()
    {
        return array(
            array('name', 'required', 'message' => 'Поле "имя автора" не может быть пустым'),
        );
    }
}