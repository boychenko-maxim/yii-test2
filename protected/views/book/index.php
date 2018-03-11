<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        .row {
            margin-bottom: 10px;
        }
        form {
            width: 500px;
        }
    </style>
</head>
<body>
<a href="index.php">Главная</a> &bull; <a href="#">Редактирование / удаление книги</a>
<hr>
<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'method'=>'post',
    )); ?>

        <?php echo $form->errorSummary($bookEditForm, 'Исправьте, пожалуйста, следующие ошибки:'); ?>

        <?php echo $form->hiddenField($bookEditForm,'id') ?>

        <div class="row">
            <?php echo $form->label($bookEditForm,'Название книги'); ?>
            <?php echo $form->textField($bookEditForm,'name') ?>
        </div>
        
        <div class="row">
            <?php foreach($book->authors as $i => $author):?>
                <?php echo $form->DropDownList($author,"[$i]id",$allAuthorsNameById); ?>
            <?php endforeach; ?>
        </div>
            
    <div class="row submit">
        <?php echo CHtml::submitButton('Отредактировать'); ?>
    </div>
    
    <?php $this->endWidget(); ?>
    
    <?php if (isset($allAddAuthorsNameById)): ?>
    
        <?php $form=$this->beginWidget('CActiveForm', array(
            'method'=>'post',
        )); ?>

            <?php echo $form->errorSummary($newAuthor, 'Исправьте, пожалуйста, следующие ошибки:'); ?>

            <div class="row">
                <?php echo $form->DropDownList($newAuthor,"id",$allAddAuthorsNameById); ?>
            </div>
                
        <div class="row submit">
            <?php echo CHtml::submitButton('Добавить автора'); ?>
        </div>

        <?php $this->endWidget(); ?>
    
    <?php else: ?>
        <div class="row">
            Нового автора книги не добавить. Добавьте нового автора в список всех возможных авторов с главной страницы.
        </div>
    <?php endif; ?>
    
    <?php if (count($allBookAuthorsNameById) > 1): ?>
    
        <?php $form=$this->beginWidget('CActiveForm', array(
            'method'=>'post',
        )); ?>

            <?php echo $form->errorSummary($deleteAuthor, 'Исправьте, пожалуйста, следующие ошибки:'); ?>

            <div class="row">
                <?php echo $form->DropDownList($deleteAuthor,"id",$allBookAuthorsNameById); ?>
            </div>
                
        <div class="row submit">
            <?php echo CHtml::submitButton('Удалить автора'); ?>
        </div>

        <?php $this->endWidget(); ?>
    
    <?php else: ?>
    
        <div class="row">
            У данной книги единственный автор
        </div>
    
    <?php endif; ?>

    <?php $form=$this->beginWidget('CActiveForm', array(
        'method'=>'post',
    )); ?>

        <?php echo $form->errorSummary($bookDeleteForm, 'Исправьте, пожалуйста, следующие ошибки:'); ?>

        <?php echo $form->hiddenField($bookDeleteForm,'id') ?>

        <?php echo $form->hiddenField($bookDeleteForm,'name') ?>

        <div class="row submit">
            <?php echo CHtml::submitButton('Удалить книгу'); ?>
        </div>

    <?php $this->endWidget(); ?>

    <?php if ($successfullEdit):?>
        Данные о книге успешно отредактированы!
    <?php endif;?>
    
    <?php if ($successfullAuthorAdd):?>
        Новый автор книги успешно добавлен!
    <?php endif;?>

    <?php if ($successfullAuthorDelete):?>
        Автор книги успешно удален!
    <?php endif;?>
    
</div>
</body>
</html>