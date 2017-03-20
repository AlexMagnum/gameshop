<?php
use yii\widgets\LinkPager;
use app\components\ImageSlider;

$this->title = "Каталог товаров по заниженным ценам со скидкой в магазине Game Shop";

$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Cписок уцененных товаров магазина, при покупке игр для Steam, origin, 
    Uplay, battle.net из данного раздела вы можете сэкономить до 90%, вы можете купить 
    дешево игры'
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Акции и игры со скидкой, купить игры по низким ценам, купить дешевые игры для ПК,
     магазин ключей steam игр, купить стим игры, магазин компьютерных игр, дешевые онлайн игры для
     pc'
]);
?>

<div class="slidegameshow">
    <?=ImageSlider::widget(['sortvalue' => 'discount', 'method' => SORT_DESC ])?>
</div>

<div class="games">
    <ul>
        <?php
        foreach ($games as $game)
            include('intro_game.php');
        ?>
    </ul>
</div>
<div class="pages">
    <?= LinkPager::widget([
        'pagination' => $pagination,
        'maxButtonCount' => 5,
        'prevPageLabel' => '&laquo;'
    ])?>
</div>
