<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Genre;
use app\models\Os;
use app\models\Language;
use app\models\Platform;
use app\models\Mode;

?>

<div class="games-form">

    <?php $form = ActiveForm::begin(['options' => [
        'enctype' => 'multipart/form-data'
    ]]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'discount')->textInput()->label("Скидка (если скидка отсутствует введите 0)") ?>

   <!-- --><?/*= $form->field($model, 'is_release')->textInput() */?>

    <?=$form->field($model, 'is_release')
    ->dropDownList([
    '1' => 'Да',
    '0' => 'Нет',
    ],
    [
    'class' => 'ddl',
    'prompt' => 'Выберите один вариант'
    ]);?>

    <?= $form->field($model, 'meta_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_release')->textInput()->label("Дата выхода в формате (yyyy-mm-dd)") ?>

    <?= $form->field($model, 'meta_desc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'publisher')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'in_stock')->textInput() ?>

    <?= $form->field($model, 'full_text')->textarea(['rows' => 10]) ?>

    <?=$form->field($modelgenre, 'fk_genre_id')
        ->listBox(Genre::find()->select(['name', 'genre_id'])->indexBy('genre_id')->column(),
            [ 'multiple' => true ])->label("Жанр (выберите один или несколько вариантов)");?>

    <?=$form->field($modelos, 'fk_os_id')
        ->listBox(Os::find()->select(['name', 'id'])->indexBy('id')->column(),
            [ 'multiple' => true ])->label("Операционная система     (выберите один или несколько вариантов)");?>

    <?=$form->field($modellanguage, 'fk_language_id')
        ->listBox(Language::find()->select(['name', 'id'])->indexBy('id')->column(),
            [ 'multiple' => true ])->label("Язык (выберите один или несколько вариантов)");?>

    <?=$form->field($modelplatform, 'fk_platform_id')
        ->listBox(Platform::find()->select(['name', 'platform_id'])->indexBy('platform_id')->column(),
            [ 'multiple' => true ])->label("Платформа (выберите один или несколько вариантов)");?>

    <?=$form->field($modelmode, 'fk_mode_id')
        ->listBox(Mode::find()->select(['name', 'id'])->indexBy('id')->column(),
            [ 'multiple' => true ])->label("Режим (выберите один или несколько вариантов)");?>

    <?= $form->field($modelmedia, 'imageFile')->fileInput()->label("Постер") ?>

    <?= $form->field($modelmedias, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*'])->label("Скриншоты") ?>

    <?= $form->field($modelvideo, 'video_trailer')->textInput()->label("Видео трейлер") ?>

    <div class="war">
        Windows характеристики если таковы имеются
    </div>

    <?= $form->field($modelwin, 'os')->textInput() ?>

    <?= $form->field($modelwin, 'cpu')->textInput() ?>

    <?= $form->field($modelwin, 'ram')->textInput() ?>

    <?= $form->field($modelwin, 'videocard')->textInput() ?>

    <?= $form->field($modelwin, 'hdd')->textInput() ?>

    <?= $form->field($modelwin, 'directx')->textInput() ?>

    <div class="war">
        Mac характеристики если таковы имеются
    </div>

    <?= $form->field($modelmac, 'os')->textInput() ?>

    <?= $form->field($modelmac, 'cpu')->textInput() ?>

    <?= $form->field($modelmac, 'ram')->textInput() ?>

    <?= $form->field($modelmac, 'videocard')->textInput() ?>

    <?= $form->field($modelmac, 'hdd')->textInput() ?>

    <div class="war">
        Linux характеристики если таковы имеются
    </div>

    <?= $form->field($modellin, 'os')->textInput() ?>

    <?= $form->field($modellin, 'cpu')->textInput() ?>

    <?= $form->field($modellin, 'ram')->textInput() ?>

    <?= $form->field($modellin, 'videocard')->textInput() ?>

    <?= $form->field($modellin, 'soundcard')->textInput() ?>

    <?= $form->field($modellin, 'hdd')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>

</div>
