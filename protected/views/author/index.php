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
<a href="index.php">Главная</a> &bull; <a href="#">Редактирование / удаление автора</a>
<hr>
<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'method'=>'post',
    )); ?>

        <?php echo $form->errorSummary($authorEditForm, 'Исправьте, пожалуйста, следующие ошибки:'); ?>

        <?php echo $form->hiddenField($authorEditForm,'id') ?>

        <div class="row">
            <?php echo $form->label($authorEditForm,'Имя автора'); ?>
            <?php echo $form->textField($authorEditForm,'name') ?>
        </div>

        <div class="row submit">
            <?php echo CHtml::submitButton('Отредактировать'); ?>
        </div>

    <?php $this->endWidget(); ?>

    <?php $form=$this->beginWidget('CActiveForm', array(
        'method'=>'post',
    )); ?>

        <?php echo $form->errorSummary($authorDeleteForm, 'Исправьте, пожалуйста, следующие ошибки:'); ?>

        <?php echo $form->hiddenField($authorDeleteForm,'id') ?>

        <?php echo $form->hiddenField($authorDeleteForm,'name') ?>

        <div class="row submit">
            <?php echo CHtml::submitButton('Удалить автора'); ?>
        </div>

    <?php $this->endWidget(); ?>

    <?php if ($successfullEdit):?>
        Данные об авторе успешно отредактированы!
    <?php endif;?>

</div>
</body>
</html>