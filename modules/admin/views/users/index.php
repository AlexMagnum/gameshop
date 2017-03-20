<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Роли';
?>
<div class="users-index">

    <h1 class="hmain"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить пользователя', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'summary' => "Показано {begin}-{end} пользователей из {totalCount}",
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            'email:email',
            'password',
            'role',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
