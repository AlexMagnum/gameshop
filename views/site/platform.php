<?php
use yii\widgets\LinkPager;

$this->title = "Каталог Battle.net, Steam, Origin, Uplay товаров. Купить battle.net , Steam, Origin, Uplay ключи со скидками, купить игры battle.net для PC дешево";

$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Купить battle.net, Steam, Origin, Uplay ключи для PC дешево из каталога battle.net, Steam, Origin, Uplay с моментальной доставкой на email'
    ]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'купить ключи Battle.net, Steam, Origin, Uplay купить бателнет ключи, магазин компьютерных игр, магазин Battle.net 
    ключей, купить Battle.net, Steam, Origin, Uplay ключи дешево'
    ]);
    ?>
    <div class="marg"></div>
    <div class="gameindex">
        <div class="games">
            <ul>
                <?php
                foreach ($games as $game) {
                    include('intro_game.php');
                }
                ?>
            </ul>
        </div>
        <div class="pages">
            <?= LinkPager::widget([
                'pagination' => $pagination,
                'maxButtonCount' => 5,
                'prevPageLabel' => '&laquo;'
                ]) ?>
            </div>
        </div>