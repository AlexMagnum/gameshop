<?php
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\models\AdvancedSearchForm;
use app\models\Platform;
use app\models\Genre;
use \app\models\Games;

$this->title = "Расширенный поиск";

$this->registerMetaTag([
    'name' => 'description',
    'content' => "Расширенный поиск на Gameshop"
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Gameshop поиск'
]);

$model = new AdvancedSearchForm();
?>

<div class="asform">
    <h1>Расширенный поиск</h1>
    <?php $form = ActiveForm::begin(); ?>
    <table>
        <tr>
            <td colspan="3">
                <?=$form->field($model, 'game')->textInput()
                    ->label('Название');?>
            </td>
        </tr>
        <tr>
            <td>
                <?=$form->field($model, 'publisher')->dropdownList(
                Games::find()->select(['publisher', 'id',])->indexBy('publisher')->column(),
                ['prompt'=>'Выбрать...'])->label('Издатель');?>
            </td>
            <td colspan="2">
                <?=$form->field($model, 'genre')->dropdownList(
                    Genre::find()->select(['name', 'genre_id'])->indexBy('genre_id')->column(),
                    ['prompt'=>'Выбрать...'])->label('Жанр');?>
            </td>
        </tr>
        <tr>
            <td>
                <?=$form->field($model, 'platform')->dropdownList(
                    Platform::find()->select(['name', 'platform_id'])->indexBy('platform_id')->column(),
                    ['prompt'=>'Выбрать...'])->label('Платформа');?>
            </td>
            <td>

                <?=$form->field($model, 'price_from')->textInput([
                    'type' => 'number'
                ])->label('Цена от:')?>
            </td>
            <td>
                <?=$form->field($model, 'price_to')->textInput([
                    'type' => 'number'
                ])->label('До:')?>
            </td>
        </tr>
        <tr>
            <td>
                <?=$form->field($model, 'order')
                ->dropDownList([
                'name_asc' => 'Названию ↑',
                'name_desc' => 'Названию ↓',
                'price_asc' => 'Цене ↑',
                'price_desc' => 'Цене ↓',
                'discount_asc' => 'Скидке ↑',
                'discount_desc' => 'Скидке ↓',
                'date_asc' => 'Дате выхода ↑',
                'date_desc' => 'Дате выхода ↓'
                ],
                [
                'prompt' => 'Умолчанию'
                ])->label('Упорядочить по');?>
            </td>
            <td>
            </td>
            <td>
                <?= Html::submitButton('Искать', ['class' => 'asbtn']) ?>
            </td>
        </tr>
    </table>
    <?php ActiveForm::end(); ?>
    <p class="result">Найдено игр: <span>&nbsp;<?=$count_find?></span></p>
</div>

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
