<?php
use yii\widgets\LinkPager;

$this->title = "Поиск $q";

$this->registerMetaTag([
    'name' => 'description',
    'content' => "Поиск $q."
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $q
]);
?>

<?php if($q == ""){ ?>
    <h2 class="resinfo">Вы задали пустой поисковый запрос</h2>
<?php } else { ?>
    <h2 class="resinfo">Результаты поиска: <?=$q?></h2>
<?php if(!$games) { ?>
    <h2 class="resinfo">Ничего не найдено</h2>
<?php } else { ?>
        <div class="games">
            <?=$game?>
            <ul>
                <?php foreach ($games as $game){
                    include "intro_game.php";
                } ?>
            </ul>
        </div>
        <div class="pages">
        <?= LinkPager::widget([
            'pagination' => $pagination,
            'maxButtonCount' => 5,
            'prevPageLabel' => '&laquo;'
        ])?>
        </div>
    <?php } ?>
<?php } ?>