<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\assets\AdminAsset;

AdminAsset::register($this);
?>

<div class="avtorization">
    <?php $form = ActiveForm::begin() ?>

    <div class="imgcontainer">
        <img src="../../../../web/img/admin/img_avatar.png" alt="Avatar" class="avatar">
    </div>

    <div class="containerin">
        <?= $form->field($model, 'username')->textInput(['placeholder' => 'Введите имя',
            'class' => 'loginput'])
            ->label('Имя пользователя'); ?>

        <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Введите пароль',
            'class' => 'loginput'])
            ->label('Пароль'); ?>

        <?= Html::submitButton('Войти', ['class' => 'logbtn']) ?>
    </div>

    <?php ActiveForm::end() ?>
</div>
