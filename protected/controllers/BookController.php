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
        $book = $this->initForms($bookEditForm, $bookDeleteForm);
        foreach ($book->authors as $author) {      
            $relations[] = $author['id'];
        }
        $deleteAuthor = new AuthorIdDeleteForm;
        $successfullEdit = false;
        $successfullAuthorAdd = false;
        $successfullAuthorDelete = false;
        $successfullDelete = false;

        if (isset($_POST['BookEditForm'])) {
            $bookEditForm->attributes = $_POST['BookEditForm'];
            $bookDeleteForm->attributes = $bookEditForm->attributes;

            if ($bookEditForm->validate()) {
                $book->name = htmlspecialchars($bookEditForm->name);
                $relations = array();
                foreach ($book->authors as $i => $author) {
                     if(isset($_POST['Author'][$i]) && !in_array($_POST['Author'][$i]['id'], $relations)) {       
                        $relations[] = $_POST['Author'][$i]['id'];
                     }
                }            
                $book->setRelationRecords('authors',$relations);
                $book->save();
                $successfullEdit = true;
            }
        } else if (isset($_POST['AuthorIdAddForm'])) { 
            $relations[] = $_POST['AuthorIdAddForm']['id'];
            $book->setRelationRecords('authors',$relations);
            $book->save();
            $successfullAuthorAdd = true;
        } else if (isset($_POST['AuthorIdDeleteForm'])) { 
            if (count($relations) > 1) {
                $relations = array_diff($relations, [$_POST['AuthorIdDeleteForm']['id']]);
                $book->setRelationRecords('authors',$relations);
                $book->save();
                $successfullAuthorDelete = true;
            } else {
                $deleteAuthor->AddDeleteError();
            }
        } else if (isset($_POST['BookDeleteForm'])) {
            $bookDeleteForm->attributes=$_POST['BookDeleteForm'];
            $bookEditForm->attributes = $bookDeleteForm->attributes;

            if ($bookDeleteForm->validate()) {
                $book->setRelationRecords('authors',array());
                $book->save();
                try {
                    $book->delete();
                    $successfullDelete = true;
                } catch (Exception $ex) {
                    //todo убрать
                    dd($ex);
                    $bookDeleteForm->AddDeleteError();
                }
            }

        } 
        
        if ($successfullDelete) {
            $this->render('succesfullDelete');
        } else {
            $allBookAuthorsNameById = array();
            foreach ($book->authors as $author) {
                $allBookAuthorsNameById[$author->id] = $author->name;
            }
            $allAuthors = Author::model()->findAll();
            $allAddAuthorsNameById = null;
            foreach ($allAuthors as $author) {
                $allAuthorsNameById[$author->id] = $author->name;
                if (!array_key_exists($author->id, $allBookAuthorsNameById)) {
                    $allAddAuthorsNameById[$author->id] = $author->name;
                }
            }
                    
            $this->render('index', array(
                'book' => $book,
                'allAuthorsNameById' => $allAuthorsNameById,
                'allBookAuthorsNameById' => $allBookAuthorsNameById,
                'allAddAuthorsNameById' => $allAddAuthorsNameById,
                'bookEditForm' => $bookEditForm,
                'bookDeleteForm' => $bookDeleteForm,
                'successfullEdit' => $successfullEdit,
                'successfullAuthorAdd' => $successfullAuthorAdd,
                'successfullAuthorDelete' => $successfullAuthorDelete,
                'newAuthor' => new AuthorIdAddForm,
                'deleteAuthor' => $deleteAuthor
            ));
        }
    }

	public function actionAdd() {
        $bookAddForm = new BookAddForm;
        $successfullAdd = false;
        
         if (isset($_POST['BookAddForm'])) {
            $bookAddForm->attributes = $_POST['BookAddForm'];
            
            if ($bookAddForm->validate()) {
                $book = new Book;
                $book->name = htmlspecialchars($bookAddForm->name);
                $book->setRelationRecords('authors',[$_POST['AuthorIdAddForm']['id']]);
                $book->save();
                $successfullAdd = true;
            }
        }
        
		if ($successfullAdd) {
            $this->render('succesfullAdd');
        } else {
            $allAuthors = Author::model()->findAll();
            $allAddAuthorsNameById = null;
            foreach ($allAuthors as $author) {
                $allAuthorsNameById[$author->id] = $author->name;
            }
                    
            $this->render('add', array(
                'bookAddForm' => $bookAddForm,
                'allAuthorsNameById' => $allAuthorsNameById,
                'author' => new AuthorIdAddForm,
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
    
    
    public function actionError()
    {
        if($error=Yii::app()->errorHandler->error)
            $this->render('error', $error);
    }
}