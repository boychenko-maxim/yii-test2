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
            if ($simpleLibraryForm->validate())
            {
                $booksWithMinAuthors = Yii::app()->db->createCommand()
                    ->select('books.name')
                    ->from('books')
                    ->join('booksauthors', 'books.id = booksauthors.booksid')
                    ->group('books.name')
                    ->having("count(books.name) >= {$simpleLibraryForm['authorsNumber']}")
                    ->query()
                    ->readAll();
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