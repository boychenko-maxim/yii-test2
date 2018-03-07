<?php

class BookDeleteForm extends CFormModel
{
    public $id;
    public $name;

    public function rules()
    {
        return array(
            array('id', 'required'),
            array('name', 'required'),
        );
    }
}