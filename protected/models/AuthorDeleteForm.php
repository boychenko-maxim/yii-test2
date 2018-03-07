<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 07.03.18
 * Time: 9:26
 */

class AuthorDeleteForm extends CFormModel
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

    public function AddDeleteError()
    {
        $this->addError(
            'id',
            'Удаление невозможно: у этого автора есть книги, ' .
            'в написании которых он принимал участие. ' .
            'Сначала удалите эти книги, потом можно будет удалить автора.'
        );
    }
}