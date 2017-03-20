<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\components\TopSales;
use app\components\LastBuy;
use app\models\SearchForm;
use yii\widgets\ActiveForm;
use app\models\Genre;
use app\models\Platform;
use app\models\Games;

AppAsset::register($this);

$action = Yii::$app->controller->action->id;

$model = new SearchForm();

$maxprice = Games::find()->max('price');

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta name="interkassa-verification" content="0e6ef77611b63af0517356a4f24539c7" />
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link href="../../web/img/favicon.ico" rel="shortcut icon" type="image/x-icon" />
</head>
<body>
<?php $this->beginBody() ?>
<input type="hidden" id="maxvalue" name="maxvalue" value="<?=$maxprice?>"/>
<div class="container-fluid ">
    <div class="row topstrip">
        <div class="col-lg-1 pos"><a class="topref home" href="<?=Yii::$app->urlManager->createUrl(["site/index"])?>"></a></div>
        <div class="col-lg-1"><a class="topref" href="<?=Yii::$app->urlManager->createUrl(["site/contact"])?>">Контакты</a></div>
        <div class="col-lg-1"><a class="topref" href="<?=Yii::$app->urlManager->createUrl(["site/warranty"])?>">Гарантии</a></div>
        <div class="col-lg-1"><a class="topref" href="<?=Yii::$app->urlManager->createUrl(["site/review"])?>">Отзывы</a></div>
        <div class="col-lg-2"><a class="topref" href="<?=Yii::$app->urlManager->createUrl(["site/howbuy"])?>">Как купить товар?</a></div>
        <div class="col-lg-2 col-lg-offset-4"><a class="cart" target="_blank" href="https://www.interkassa.com/consumer/operations/payment">Мои покупки</a></div>
    </div>
    <div class="row header">
        <div class="col-lg-3 col-lg-offset-9 col-md-4 col-md-offset-4 col-sm-5 col-sm-offset-4 col-xs-12">
            <div class="search">
                <?php $form = ActiveForm::begin()?>
                    <?= $form->field($model, 'q')->textInput(['class' => 'input'])->label('')?>
                <?php ActiveForm::end()?>
                <a class="advancedsearch" href="<?=Yii::$app->urlManager->createUrl(["site/advancedsearch"])?>"></a>
            </div>
        </div>
    </div>
    <div class="row myNav">
        <ul class="topnav" id="myTopnav">
            <li><a href="<?=Yii::$app->urlManager->createUrl(["site/index"])?>"
                    <?php if($action =="index") {?> class="active" <?php } ?>>Главная
                </a>
            </li>
            <li><a href="<?=Yii::$app->urlManager->createUrl(["site/top"])?>"
                    <?php if($action =="top"){ ?> class="active" <?php } ?>>Топ продаж
                </a>
            </li>
            <li><a href="<?=Yii::$app->urlManager->createUrl(["site/new"])?>"
                    <?php if($action =="new") {?> class="active" <?php } ?>>Новинки
                </a>
            </li>
            <li><a href="<?=Yii::$app->urlManager->createUrl(["site/sale"])?>"
                    <?php if($action =="sale") {?> class="active" <?php } ?>>Скидки
                </a>
            </li>
            <li><a href="<?=Yii::$app->urlManager->createUrl(["site/preorder"])?>"
                    <?php if($action =="preorder") {?> class="active" <?php } ?>>Предзаказ
                </a>
            </li>
            <li class="icon">
                <a class="alw" href="javascript:void(0);" style="font-size:30px;" onclick="myFunction()">☰</a>
            </li>
        </ul>
    </div>
    <div class="row main">
        <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3 leftbar">
            <ul>
                <li>По платформе</li>
                <?php
                    $queryplatform = Platform::find();
                    $platforms = $queryplatform->orderBy(['name' => SORT_ASC])->all();
                ?>
                <?php foreach ($platforms as $platform) { ?>
                <li><a href="<?=Yii::$app->urlManager->createUrl($platform->link)?>"><?=$platform
                            ->name?></a></li>
                <?php }?>
            </ul>
            <ul>
                <li>По жанру</li>
                <?php
                $querygenre = Genre::find();
                $genres = $querygenre->orderBy(['name' => SORT_ASC])->all();
                ?>
                <?php foreach ($genres as $genre) { ?>
                    <li><a href="<?=Yii::$app->urlManager->createUrl($genre->link)?>"><?=$genre
                                ->name?></a></li>
                <?php }?>
            </ul>
            <ul class="nolast">
                <li>По цене</li>
            </ul>
            <div class="slider"></div>
            <a class="pricesearch" href="#">ДО
                <span id="slider-result">1</span>
                <img src="../web/img/currencygrn.png" alt="currency">
            </a>
            <ul>
                <li></li>
            </ul>
            <a class="searchbutton" href="<?=Yii::$app->urlManager->createUrl(["site/advancedsearch"])?>"><span class="texthide">Расширенный поиск</span></a>
        </div>

        <div class="col-lg-6 col-md-9 col-sm-9 col-xs-12 content">
            <?=$content?>
        </div>

       
        <div class="col-lg-3 rightbar">
            <div class="hot">

                <h1>Лидеры продаж</h1>

                <?=TopSales::widget()?>

                <h1 class="last">Последние продажи</h1>

                <?=LastBuy::widget()?>
               
            </div>
        </div>
    </div>

    <div class="row footer">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center">
            <ul class="ulr">
                <li>
                    <a href="<?=Yii::$app->urlManager->createUrl(["site/index"])?>">Главная</a>
                    <a href="<?=Yii::$app->urlManager->createUrl(["site/contact"])?>">Контакты</a>
                    <a target="_blank" href="https://www.interkassa.com/consumer/operations/payment">Мои покупки</a>
                    <a href="<?=Yii::$app->urlManager->createUrl(["site/warranty"])?>">Гарантии</a>
                    <a href="<?=Yii::$app->urlManager->createUrl(["site/review"])?>">Отзывы</a>
                </li>
            </ul>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center">
            <ul class="ull">
                <li>
                    <a href="<?=Yii::$app->urlManager->createUrl(["site/about"])?>">О магазине</a>
                    <a href="<?=Yii::$app->urlManager->createUrl(["site/top"])?>">Топ продаж</a>
                    <a href="<?=Yii::$app->urlManager->createUrl(["site/howbuy"])?>">Как купить</a>
                    <a href="<?=Yii::$app->urlManager->createUrl(["site/new"])?>">Новинки</a>
                    <a href="<?=Yii::$app->urlManager->createUrl(["site/sale"])?>">Скидки</a>
                </li>
            </ul>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center">
            <ul class="social">
                <li >
                    <a target="_blank" href="https://www.youtube.com"><i class="socialyoutube"></i></a>
                    <a target="_blank" href="https://vk.com"><i class="socialfb"></i></a>
                    <a target="_blank" href="https://plus.google.com"><i class="socialtwit"></i></a>
                    <a target="_blank" href="https://twitter.com"><i class="socialgp"></i></a>
                    <a target="_blank" href="https://www.facebook.com"><i class="socialvk"></i></a>
                </li>
            </ul>
            <div class="copy">
                <span>Game shop &copy; 2016 - <?= date("Y") ?>.</span>
                Все права защищены
            </div>
        </div>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
