<?php
use yii\helpers\Html;
use yii\grid\GridView;
$this->title = 'Игры';
?>
<div class="games-index">

    <h1 class="hmain"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить игру', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'summary' => "Показано {begin}-{end} игр из {totalCount}",
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            'price',
            'discount',
            'last_sale',
            'sale_count',
            //'is_release',
            // 'meta_title',
            // 'date_release',
            // 'meta_desc',
            // 'meta_key',
            // 'publisher',
             'in_stock',
            // 'full_text:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>