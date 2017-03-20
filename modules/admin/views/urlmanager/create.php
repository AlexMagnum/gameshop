<?php

use yii\helpers\Html;

$this->title = 'Создать ссылку';
?>
<div class="sef-create">

    <h1 class="hmain"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
