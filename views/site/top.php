<?php
use yii\widgets\LinkPager;
use app\components\ImageSlider;

$this->title = "Самые продаваемые игры магазина Game Shop";

$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Список самых продаваемых и популярных игр для Steam, Origin, Uplay, Battle.net, по версии нашего интернет-магазина'
    ]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Топ продаж игр, самые продаваемые игры для PC, топовые игры, магазин ключей steam игр, магазин компьютерных игр, купить дешевые игры по низким ценам,  дешевые онлайн игры для pc'
    ]);
    ?>

    <div class="slidegameshow">
        <?=ImageSlider::widget(['sortvalue' => 'sale_count', 'method' => SORT_DESC ])?>
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
