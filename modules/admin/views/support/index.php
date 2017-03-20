<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Поддержка';
?>
<div class="contact-index">

    <h1 class="hmain"><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'summary' => "Показано {begin}-{end} вопросов из {totalCount}",
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            'email:email',
            //'body:ntext',

            ['class' => 'yii\grid\ActionColumn',
             'template' => '{view}{delete}{link}',],
        ],
    ]); ?>
</div>
