<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AdminAsset;

AdminAsset::register($this);

$action = Yii::$app->controller->id;
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link href="../../web/img/favicon.ico" rel="shortcut icon" type="image/x-icon"/>
</head>
<body>
<?php $this->beginBody() ?>
<div class="container-fluid">
    <div class="row row-flex">
        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3 leftpart">
            <h1>Админ панель</h1>
            <h2>Привет <span class="name"><?= Yii::$app->user->identity->name ?></span></h2>
            <div class="optbtn">
                <?= Html::a('Обзор сайта', '../../', ["class" => "ofs", "target" => "_blank"]) ?>
                <?php if ($action == "default") { ?>
                    <?= Html::a('Выход', "logout") ?>
                <?php } else { ?>
                    <?= Html::a('Выход', "../../admin/default/logout") ?>
                <?php } ?>
            </div>
            <ul>
                <li><a href="<?= Yii::$app->urlManager->createUrl(["admin/gamecrud/index"]) ?>"
                        <?php if ($action == "gamecrud") { ?> class="active" <?php } ?>>Игры
                    </a></li>
                <li><a href="<?= Yii::$app->urlManager->createUrl(["admin/users/index"]) ?>"
                        <?php if ($action == "users") { ?> class="active" <?php } ?>>Роли
                    </a></li>
                <li><a href="<?= Yii::$app->urlManager->createUrl(["admin/support/index"]) ?>"
                        <?php if ($action == "support") { ?> class="active" <?php } ?>>Поддержка
                    </a></li>
                <li><a href="<?= Yii::$app->urlManager->createUrl(["admin/urlmanager/index"]) ?>"
                        <?php if ($action == "urlmanager") { ?> class="active" <?php } ?>>URL Manager
                    </a></li>
            </ul>
        </div>
        <div class="col-lg-9 col-sm-9 col-md-9 col-xs-9 rightpart">
            <?= $content ?>
        </div>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
