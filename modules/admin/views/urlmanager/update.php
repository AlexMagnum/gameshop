<?php

use yii\helpers\Html;

$this->title = 'Изменить ссылку: ' . $model->link_sef;
?>
<div class="sef-update">

    <h1 class="hmain"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
