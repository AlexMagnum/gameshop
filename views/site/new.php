<?php
use yii\widgets\LinkPager;
use app\components\ImageSlider;

$this->title = "Самые свежие новинки игровой PC индустрии на сайте Game Shop";

$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Каталог самых свежих новинок компьютерных игр, представленных в магазине 
    Game Shop и во всем мире'
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'купить новинки игр, самые новые игры по низким ценам, магазин ключей steam игр, 
    купить новые стим игры, магазин компьютерных игр и новинок, купить ключ активации к новой 
    игре, дешевые онлайн игры для pc'
]);
?>

<div class="slidegameshow">
    <?=ImageSlider::widget(['sortvalue' => 'date_release', 'method' => SORT_DESC ])?>
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
