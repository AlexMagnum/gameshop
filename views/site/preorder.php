<?php
use yii\widgets\LinkPager;
use app\components\ImageSlider;

$this->title = "Доступные предзаказы игр на pc";

$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Каталог игр доступных для предварительного заказа, совершая предзаказ 
    вы экономите свои средсва!'
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'предзаказ, магазин ключей steam игр, купить стим игры, магазин компьютерных игр, 
    купить дешевые игры по низким ценам, купить ключ активации, steam стим игры бесплатно, 
    дешевые онлайн игры для pc'
]);
?>

<div class="slidegameshow">
    <?=ImageSlider::widget(['sortvalue' => 'is_release', 'method' => SORT_DESC])?>
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
