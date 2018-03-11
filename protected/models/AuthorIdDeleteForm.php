<?php

class AuthorIdDeleteForm extends CFormModel
{
    public $id;

    public function rules()
    {
        return array(
            array('id', 'required'),
        );
    }
    
    public function AddDeleteError()
    {
        $this->addError(
            'id',
            'Вы не можете удалить автора книги, если он единственный у данной книги'
        );
    }
}