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
<a href="index.php">Главная</a> &bull; <a href="#">Добавление автора</a>
<hr>
<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'method'=>'post',
    )); ?>

    <?php echo $form->errorSummary($authorAddForm, 'Исправьте, пожалуйста, следующие ошибки:'); ?>

    <div class="row">
        <?php echo $form->label($authorAddForm,'Имя автора'); ?>
        <?php echo $form->textField($authorAddForm,'name') ?>
    </div>

    <div class="row submit">
        <?php echo CHtml::submitButton('Добавить'); ?>
    </div>

    <?php $this->endWidget(); ?>

    <?php if ($successfullAdd):?>
        Автор успешно добавлен!
    <?php endif;?>

</div>
</body>
</html>