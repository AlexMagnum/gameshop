<?php
use yii\widgets\LinkPager;
use app\components\ImageSlider;
use app\models\Games;
use app\models\Gamemedia;

$this->title = "Game Shop - магазин компьютерных игр";

$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Game Shop - интернет-магазин компьютерных игр"'
    ]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'game shop, steam, origin, battlenet, uplay, game, shop, buy, play'
    ]);
    ?>

    <div class="slidegameshow">
        <?=ImageSlider::widget(['sortvalue' => 'rand()', 'method' => SORT_ASC ])?>
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
