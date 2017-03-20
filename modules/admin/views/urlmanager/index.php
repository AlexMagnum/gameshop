<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'URL Manager';
?>
<div class="sef-index">

    <h1 class="hmain"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать ссылку', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'summary' => "Показано {begin}-{end} ссылок из {totalCount}",
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'link',
            'link_sef',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
