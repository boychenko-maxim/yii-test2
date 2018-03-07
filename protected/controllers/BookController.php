<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 07.03.18
 * Time: 15:44
 */

class BookController extends CController
{
    public function actionIndex()
    {
        $bookEditForm = new BookEditForm();
        $bookDeleteForm = new BookDeleteForm();
        $book = null;
        $allAuthors = Author::model()->findAll();
        $successfullEdit = false;
        $successfullDelete = false;

        if (isset($_POST['BookEditForm'])) {
            $bookEditForm->attributes = $_POST['BookEditForm'];
            $bookDeleteForm->attributes = $bookEditForm->attributes;

            if ($bookEditForm->validate()) {
                $book = Book::model()->findByPk($bookEditForm->id);
                $book->name = htmlspecialchars($bookEditForm->name);
                $book->save();
                $successfullEdit = true;
            } else {
                $book = $this->initForms($bookEditForm, $bookDeleteForm);
            }

        } /*else if (isset($_POST['BookDeleteForm'])) {
            $bookDeleteForm->attributes=$_POST['BookDeleteForm'];
            $bookEditForm->attributes = $bookDeleteForm->attributes;

            if ($bookDeleteForm->validate()) {
                $book = Book::model()->findByPk($bookDeleteForm->id);
                try {
                    $book->delete();
                    $successfullDelete = true;
                } catch (Exception $ex) {
                    $bookDeleteForm->AddDeleteError();
                }
            }

        }*/ else if (isset($_GET['id'])) {
            $book = $this->initForms($bookEditForm, $bookDeleteForm);
        }
        
        if ($successfullDelete) {
            $this->render('succesfullDelete');
        } else {
            $this->render('index', array(
                'book' => $book,
                'allAuthors' => $allAuthors,
                'bookEditForm' => $bookEditForm,
                'bookDeleteForm' => $bookDeleteForm,
                'successfullEdit' => $successfullEdit
            ));
        }
    }

    private function initForms($bookEditForm, $bookDeleteForm)
    {
        $book = Book::model()->with('authors')->findByPk($_GET['id']);
        $bookEditForm->id = $_GET['id'];
        $bookEditForm->name = $book->name;
        $bookDeleteForm->attributes = $bookEditForm->attributes;
        return $book;
    }
}