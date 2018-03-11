<?php

class BookAddForm extends CFormModel
{
    public $name;

    public function rules()
    {
        return array(
            array('name', 'required', 'message' => 'Поле "название книги" не может быть пустым'),
        );
    }
}