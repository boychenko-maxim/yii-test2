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

    <div class="row submit">
        <?php echo CHtml::submitButton('Отредактировать'); ?>
    </div>

    <?php $this->endWidget(); ?>

    <!-- не уверен, что удаление работает, так как должно, поэтому закоментировал кнопку submit -->
    <?php $form=$this->beginWidget('CActiveForm', array(
        'method'=>'post',
    )); ?>

        <?php echo $form->errorSummary($bookDeleteForm, 'Исправьте, пожалуйста, следующие ошибки:'); ?>

        <?php echo $form->hiddenField($bookDeleteForm,'id') ?>

        <?php echo $form->hiddenField($bookDeleteForm,'name') ?>

        <div class="row submit">
            <?php //echo CHtml::submitButton('Удалить книгу'); ?>
        </div>

    <?php $this->endWidget(); ?>

    <?php if ($successfullEdit):?>
        Данные о книге успешно отредактированы!
    <?php endif;?>

</div>
</body>
</html>