<?php
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Html;
use yii\captcha\Captcha;
use app\models\ContactForm;

$this->title = "Контакты - Связь с нами Game Shop";

$this->registerMetaTag([
    'name' => 'description',
    'content' => "Контакты для связи с администраторами  Game Shop"
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Контакты, game shop, steam, origin, battlenet, uplay, game, shop, buy, play, связь'
]);

$model = new ContactForm();
?>

<div class="contact">
    <?php if($success) { ?>
        <p class="contsend">Ваш запрос успешно отправлен</p>
    <?php }?>
    <?php if($error){ ?>
        <p class="contsend">Произошла ошибка при отправке! Проверьте данные и повторите попытку.</p>
    <?php }?>
    <h2>Контакты</h2>
    <div class="mailvk">
        <img src="../../web/img/mail.png" alt="mail">
        <a href="mailto:gameshop@gmail.com">gameshop@gmail.com</a>
        <span class="pad"></span>
        <img src="../../web/img/vk.png" alt="mail">
        <a href="https://vk.com/">vk.com/gameshop</a>
    </div>
    <h2>Написать письмо</h2>
    <div class="continfo">Вы на странице поддержки магазина. Вы можете обратиться по форме ниже.
        Скорость обработки от способа обращения не
        зависит. Большая просьба - не дублируйте свои заявки по несколько раз и по разным
        контактам - ведь если каждый будет так делать, скорость ответа будет пропорционально
        расти. Оперативность ответа зависит от времени суток и типа Вашего вопроса. Мы делаем
        всё, чтобы Вам лишний раз не приходилось что-то уточнять в поддержке магазина! </div>
    <?php $form = ActiveForm::begin()?>
    <?=$form->field($model, 'name')->textInput()
        ->label('Ваше имя *');?>
    <?=$form->field($model, 'email')->input('email')->label('E-mail *');?>
    <?=$form->field($model, 'body')->textarea(['rows' => 10, 'class' => 'ta'])
        ->label('Описание проблемы или ваш вопрос: *');?>
    <?= $form->field($model, 'verifyCode')->widget(Captcha::className())
        ->label('Введите код')?>
    <?= Html::submitButton('Отправить', ['class' => 'asbtn contbtn']) ?>
    <?php ActiveForm::end()?>
</div>
