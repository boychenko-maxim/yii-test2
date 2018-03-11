<?php

class AuthorIdAddForm extends CFormModel
{
    public $id;

    public function rules()
    {
        return array(
            array('id', 'required'),
        );
    }
}