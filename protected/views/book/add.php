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
<a href="index.php">Главная</a> &bull; <a href="#">Добавление книги</a>
<hr>
<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'method'=>'post',
    )); ?>

        <?php echo $form->errorSummary($bookAddForm, 'Исправьте, пожалуйста, следующие ошибки:'); ?>

        <div class="row">
            <?php echo $form->label($bookAddForm,'Название книги'); ?>
            <?php echo $form->textField($bookAddForm,'name') ?>
        </div>
        
        <div class="row">
            <?php echo $form->label($bookAddForm,'Автор книги'); ?>
            <?php echo $form->DropDownList($author,"id",$allAuthorsNameById); ?>
        </div>
            
    <div class="row submit">
        <?php echo CHtml::submitButton('Добавить'); ?>
    </div>
    
    <?php $this->endWidget(); ?>
</div>
</body>
</html>