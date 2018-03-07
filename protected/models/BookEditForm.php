<?php

class BookEditForm extends CFormModel
{
    public $id;
    public $name;

    public function rules()
    {
        return array(
            array('id', 'required'),
            array('name', 'required', 'message' => 'Поле "название книги" не может быть пустым'),
        );
    }
}