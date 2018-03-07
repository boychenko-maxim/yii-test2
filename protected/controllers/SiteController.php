<?php

class SiteController extends CController
{
	public function actionIndex()
	{
	    $authors = Author::model()->findAll();
        $books = Book::model()->with('authors')->findAll();
        $simpleLibraryForm = new SimpleLibraryForm;
        $booksWithMinAuthors = array();
        if(isset($_GET['SimpleLibraryForm']))
        {
            // получаем данные от пользователя
            $simpleLibraryForm->attributes=$_GET['SimpleLibraryForm'];
            // проверяем полученные данные
            if ($simpleLibraryForm->validate()) {
                $booksWithMinAuthors = Book::getbooksWithMinAuthors($simpleLibraryForm['authorsNumber']);
            }
        }
        // рендерим представление
        $this->render('index',array(
            'simpleLibraryForm'=>$simpleLibraryForm,
            'booksWithMinAuthors'=>$booksWithMinAuthors,
            'authors' =>$authors,
            'books' =>$books
        ));
	}
}