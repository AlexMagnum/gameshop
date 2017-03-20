<?php
use yii\widgets\LinkPager;

$this->title = "Каталог игр жанра гонки, инди, казуальная игра, ММО, приключенческая игра, ролевая игра, симулятор, спортивная игра, стратегия, экшн для pc в магазине Gameshop";

$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Купить лицензионные ключи к играм для ПК из жанра гонки, инди, казуальная игра, ММО, приключенческая игра, ролевая игра, симулятор, спортивная игра, стратегия, экшн с моментальной доставкой на email'
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'гонки, инди, казуальная игра, ММО, приключенческая игра, ролевая игра, симулятор, спортивная игра, стратегия, экшн, магазин компьютерных игр'
]);
?>

<div class="marg"></div>
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
    ]) ?>
</div>