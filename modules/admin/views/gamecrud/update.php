<?php
use yii\helpers\Html;

    $this->title = 'Изменить игру ' . $model->name;
?>

<div class="games-update">
    <h1 class="hmain"><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
        'modelgenre' =>  $modelgenre,
        'modelos' => $modelos,
        'modellanguage' => $modellanguage,
        'modelplatform' => $modelplatform,
        'modelmode' => $modelmode,
        'modelmedia' => $modelmedia,
        'modelvideo' => $modelvideo,
        'modelmedias' => $modelmedias,
        'modelwin' => $modelwin,
        'modelmac' => $modelmac,
        'modellin' => $modellin
    ]) ?>

</div>