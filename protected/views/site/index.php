<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        table {
            border-collapse: collapse;
            width: 100% ;
        }
        th, td {
            border: 1px solid black;
            padding: 5px;
        }
        .books table, .authors table {
            width: 600px;
            margin-bottom: 5px;
        }
        .books tr td:last-child, .authors tr td:last-child {
            border: none;
        }
        .booksMinAuthors .add-author, .books .add-author, .authors .add-author {
            margin-bottom: 5px;
        }
        .booksMinAuthors table {
            width: 300px;
            margin-bottom: 5px;
        }
        form {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>

<div class="authors">
    <h2>Авторы:</h2>
    <table>
    <?php foreach ($authors as $author):?>
        <tr>
            <td><?=$author->name?></td>
            <td>
                <form action="index.php">
                    <input type="hidden" name="r" value="author/index">
                    <input type="hidden" name="id" value="<?=$author->id?>">
                    <input type="submit" value="редактировать / удалить">
                </form>
            </td>
        </tr>
    <?php endforeach;?>
    </table>
    <form class="add-author" action="index.php">
        <input type="hidden" name="r" value="author/add">
        <input type="submit" value="Добавить автора">
    </form>
</div>

<div class="books">
    <h2>Книги:</h2>
    <table>
        <tr>
            <th>Название</th>
            <th>Авторы</th>
        </tr>
        <?php foreach ($books as $book):?>
            <tr>
                <td><?=$book->name?></td>
                <td>
                    <?php foreach ($book->authors as $author):?>
                        <?=$author->name . ' '?>
                    <?php endforeach;?>
                </td>
                <td>
                    <form action="index.php">
                        <input type="hidden" name="r" value="book/index">
                        <input type="hidden" name="id" value="<?=$book->id?>">
                        <input type="submit" value="редактировать / удалить">
                    </form>
                </td>
            </tr>
        <?php endforeach;?>
    </table>
    <form class="add-book" action="index.php">
        <input type="hidden" name="r" value="book/add">
        <input type="submit" value="Добавить книгу">
    </form>
</div>

<h2>Получение списка книг с минимальным количеством авторов</h2>

<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'method'=>'get',
        'action' => $this->createUrl('/')
    )); ?>

    <?php echo $form->errorSummary($simpleLibraryForm, 'Исправьте, пожалуйста, следующие ошибки:'); ?>

    <div class="row">
        <?php echo $form->label($simpleLibraryForm,'Минимальное количество авторов'); ?>
        <?php echo $form->textField($simpleLibraryForm,'authorsNumber') ?>
    </div>

    <div class="row submit">
        <?php echo CHtml::submitButton('Отобразить книги'); ?>
    </div>

    <?php $this->endWidget(); ?>
</div>

<div class="booksMinAuthors">
    <table>
    <?php foreach ($booksWithMinAuthors as $book):?>
        <tr><td><?=$book['name']?><br></td></tr>
    <?php endforeach;?>
    </table>
</div>

</body>
</html>