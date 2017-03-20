<h2>Приветвстую <?=Yii::$app->user->identity->name?></h2>
<h3 class="h3main">Чтобы вы хотели сделать?</h3>
<div class="wrap">
    <a href="<?=Yii::$app->urlManager->createUrl(["admin/gamecrud/index"])?>" class="block addgame">
        <p>Добавить игру</p>
    </a>
    <a href="<?=Yii::$app->urlManager->createUrl(["admin/users/index"])?>" class="block role">
        <p>Задать роли</p>
    </a>
    <a href="<?=Yii::$app->urlManager->createUrl(["admin/support/index"])?>" class="block support">
        <p>Ответить на вопросы</p>
    </a>
    <a href="<?=Yii::$app->urlManager->createUrl(["admin/urlmanager/index"])?>" class="block urlmanag">
        <p>ЧПУ ссылки</p>
    </a>
</div>