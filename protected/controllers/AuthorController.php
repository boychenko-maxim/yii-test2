<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 07.03.18
 * Time: 8:10
 */

class AuthorController extends CController
{
    public function actionIndex()
    {
        $authorEditForm = new AuthorEditForm();
        $authorDeleteForm = new AuthorDeleteForm();
        $author = null;
        $successfullEdit = false;
        $successfullDelete = false;

        if (isset($_POST['AuthorEditForm'])) {
            $authorEditForm->attributes = $_POST['AuthorEditForm'];
            $authorDeleteForm->attributes = $authorEditForm->attributes;

            if ($authorEditForm->validate()) {
                $author = Author::model()->findByPk($authorEditForm->id);
                $author->name = htmlspecialchars($authorEditForm->name);
                $author->save();
                $successfullEdit = true;
            } else {
                $author = $this->initForms($authorEditForm, $authorDeleteForm);
            }

        } else if (isset($_POST['AuthorDeleteForm'])) {
            $authorDeleteForm->attributes=$_POST['AuthorDeleteForm'];
            $authorEditForm->attributes = $authorDeleteForm->attributes;

            if ($authorDeleteForm->validate()) {
                $author = Author::model()->findByPk($authorDeleteForm->id);
                try {
                    $author->delete();
                    $successfullDelete = true;
                } catch (Exception $ex) {
                    $authorDeleteForm->AddDeleteError();
                }
            }

        } else if (isset($_GET['id'])) {
            $author = $this->initForms($authorEditForm, $authorDeleteForm);
        }

        if ($successfullDelete) {
            $this->render('succesfullDelete');
        } else {
            $this->render('index', array(
                'author' => $author,
                'authorEditForm' => $authorEditForm,
                'authorDeleteForm' => $authorDeleteForm,
                'successfullEdit' => $successfullEdit
            ));
        }
    }

    public function actionAdd()
    {
        $authorAddForm = new AuthorAddForm();
        $successfullAdd = false;

        if (isset($_POST['AuthorAddForm'])) {
            $authorAddForm->attributes = $_POST['AuthorAddForm'];

            if ($authorAddForm->validate()) {
                $author = new Author();
                $author->name = htmlspecialchars($authorAddForm->name);
                $author->save();
                $successfullAdd = true;
            }
        }

        $this->render('add', array(
            'authorAddForm' => $authorAddForm,
            'successfullAdd' => $successfullAdd
        ));
    }
    
    private function initForms($authorEditForm, $authorDeleteForm)
    {
        $author = Author::model()->findByPk($_GET['id']);
        $authorEditForm->id = $_GET['id'];
        $authorEditForm->name = $author->name;
        $authorDeleteForm->attributes = $authorEditForm->attributes;
        return $author;
    }
}