<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\models\Gamemedia;
use app\models\Buy;

$this->title = 'Купить ' . $game->meta_title . ' лицензионный ключ';

$this->registerMetaTag([
    'name' => 'description',
    'content' => $game->meta_desc
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $game->meta_key
]);

$game_img = Gamemedia::find()->where(['game_id' => $game->id])->one();
$model = new Buy();
?>

<div class="games gb">
    <ul>
        <?php
        include('intro_game.php');
        ?>
    </ul>
</div>
<div class="buypage">
    <h1>Выберите способ оплаты:</h1>
    <table>
        <tr>
            <td><input type="radio" value="wmr" name="payment" id="wmr"/></td>
            <td><label for="wmr" class="img wmr"></label></td>
            <td><label for="wmr"><b>Webmoney. </b>Оплата через Webmoney Transfer или
                    выписку счёта на ваш WMID. Комиссия за перевод – 0.8%</label></td>
        </tr>
        <tr>
            <td><input type="radio" value="qiwi" name="payment" id="qiwi"/></td>
            <td><label for="qiwi" class="img qiwi"></label></td>
            <td><label for="qiwi"><b>QIWI. </b>Через платёжный сервис PayMaster. Комиссия - 5%</label></td>
        </tr>
        <tr>
            <td><input type="radio" value="yandex" name="payment" id="yandex"/></td>
            <td><label for="yandex" class="img yandex"></label></td>
            <td><label for="yandex"><b>Яндекс.Деньги. </b>Через платёжный сервис PayMaster вы будете перенаправлены на
                    оплату на сайте Яндекс.деньги. Комиссия - 6%</label></td>
        </tr>
        <tr>
            <td><input type="radio" value="rcc" name="payment" id="rcc"/></td>
            <td><label for="rcc" class="img rcc"></label></td>
            <td><label for="rcc"><b>VISA / MasterCard. </b>Оплата банковскими картами осуществляется на стороне
                    платёжного сервиса PayMaster. Дополнительные инструкции предоставляются в процессе оплаты. Комиссия
                    - 2.3%</label></td>
        </tr>
        <tr>
            <td><input type="radio" value="mts" name="payment" id="mts"/></td>
            <td><label for="mts" class="img mts"></label></td>
            <td><label for="mts"><b>МТС. </b>На ваш номер будет выписан счёт, который необходимо оплатить. Платеж
                    возможен с мобильных номеров Российской Федерации. Дополнительные инструкции предоставляются в
                    процессе оплаты. Комиссия - 3.5%</label></td>
        </tr>
        <tr>
            <td><input type="radio" value="bln" name="payment" id="bln"/></td>
            <td><label for="bln" class="img bln"></label></td>
            <td><label for="bln"><b>Билайн. </b>На ваш номер будет выписан счёт, который необходимо оплатить. Платеж
                    возможен с мобильных номеров Российской Федерации. Дополнительные инструкции предоставляются в
                    процессе оплаты. Комиссия – 18.62%</label></td>
        </tr>
        <tr>
            <td><input type="radio" value="bnk" name="payment" id="bnk"/></td>
            <td><label for="bnk" class="img bnk"></label></td>
            <td><label for="bnk"><b>Сбербанк Онлайн / Альфа-Банк / Русский Стандарт / ВТБ 24 / Промсвязьбанк / BANK
                        связной / Приватбанк. </b>Инструкции предоставляются в процессе оплаты, а также взимается
                    дополнительная комиссия - 2.5%</label></td>
        </tr>
        <tr>
            <td><input type="radio" value="atm" name="payment" id="atm"/></td>
            <td><label for="atm" class="img atm"></label></td>
            <td><label for="atm"><b>Терминал. </b>Оплата через терминал доступна жителям России и Украины.
                    Дополнительные инструкции предоставляются в процессе оплаты. Комиссия - 11%</label></td>
        </tr>
        <tr>
            <td><input type="radio" value="bitcoin" name="payment" id="bitcoin"/></td>
            <td><label for="bitcoin" class="img bitcoin"></label></td>
            <td><label for="bitcoin"><b>Bitcoin. </b>Оплата через Bitcoin. Комиссия - 0.8%</label></td>
        </tr>
    </table>

    <div class="buyform">
        <form id="payment" name="payment" method="post" action="https://sci.interkassa.com/" enctype="utf-8"
              target="_blank">
            <input type="hidden" name="ik_co_id" value="58b41a8f3b1eaf6d398b4568"/>
            <input type="hidden" name="ik_pm_no" value="ID_<?= rand(1000, 9999) ?>"/>
            <input type="hidden" name="ik_am" value="<?= $game->price ?>"/>
            <input type="hidden" name="ik_cur" value="UAH"/>
            <input type="hidden" name="ik_desc" value="<?= $game->name ?>"/>
        </form>
         <?php $form = ActiveForm::begin() ?>
                <div class="buymail"><?= $form->field($model, 'email')->input('email')->label("E-mail *") ?></div><div class="checkaccept">
                <?= $form->field($model, 'accept')
                        ->checkbox([
                            'label' => 'Я ознакомлен с пользовательским соглашением и описанием товара*',
                        ]) ?></div>  
                <div class="buybtn"><?= Html::submitButton('Перейти к оплате  →', ['class' => 'asbtn subbtnbuy', 'onclick' => 'submitForm()']) ?></div>  
        <?php ActiveForm::end() ?>
    </div>

    <p>Правильно указывайте свой электронный адрес! Именно на него будет выслан оплаченный
        товар. Если вы не получили товар после оплаты, то <a href="<?= Yii::$app->urlManager->createUrl(["site/contact"]); ?>"> напишите нам.</a></p>
    <p>Уважаемые покупатели, в выдаваемом после оплаты товаре исключены ошибки.
        Если не получается активировать товар, то <a href="<?= Yii::$app->urlManager->createUrl(["site/contact"]); ?>"> обратитесь к нам.</a></p>
</div>