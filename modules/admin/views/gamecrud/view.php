<?php

use yii\helpers\Html;

$this->title = $model->name;

?>

<div class="games-view">

    <h1 class="hmain"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <table class="table">
        <tr>
            <th>ID</th>
            <td><?= $model->id ?></td>
        </tr>
        <tr>
            <th>Название</th>
            <td><?= $model->name ?></td>
        </tr>
        <tr>
            <th>Цена</th>
            <td><?= $model->price ?> грн</td>
        </tr>
        <tr>
            <th>Скидка</th>
            <td><?= $model->discount ?>%</td>
        </tr>
        <tr>
            <th>Дата выхода</th>
            <td><?= $model->date_releaseformat ?></td>
        </tr>
        <tr>
            <th>Издатель</th>
            <td><?= $model->publisher ?></td>
        </tr>
        <tr>
            <th>Предзаказ</th>
            <?php if ($model->is_release == 1) { ?>
                <td>Да</td>
            <?php } else { ?>
                <td>Нет</td>
            <?php } ?>
        </tr>
        <tr>
            <th>Заголовок</th>
            <td><?= $model->meta_title ?></td>
        </tr>
        <tr>
            <th>Мета описание</th>
            <td><?= $model->meta_desc ?></td>
        </tr>
        <tr>
            <th>Ключевые слова</th>
            <td><?= $model->meta_key ?></td>
        </tr>
        <tr>
            <th>Полное описание</th>
            <td><?= $model->full_text ?></td>
        </tr>
        <tr>
            <th>Количество продаж</th>
            <td><?= $model->sale_count ?></td>
        </tr>
        <tr>
            <th>Последняя продажа</th>
            <td><?= $model->last_sale ?></td>
        </tr>
        <tr>
            <th>На складе</th>
            <td><?= $model->in_stock ?></td>
        </tr>
        <tr>
            <th>Операционная система</th>
            <td><?php
                $strosgame = "";
                foreach ($modelos as $m)
                    $strosgame .= $m->fkOs->name . ", ";
                echo substr($strosgame, 0, -2);
                ?></td>
        </tr>
        <tr>
            <th>Платформа</th>
            <td><?php
                $strplatgame = "";
                foreach ($modelplat as $m)
                    $strplatgame .= $m->fkPlatform->name . ", ";
                echo substr($strplatgame, 0, -2);
                ?></td>
        </tr>
        <tr>
            <th>Жанр</th>
            <td><?php
                $strgenregame = "";
                foreach ($modelgenre as $m)
                    $strgenregame .= $m->fkGenre->name . ", ";
                echo substr($strgenregame, 0, -2);
                ?></td>
        </tr>
        <tr>
            <th>Язык</th>
            <td><?php
                $strlanggame = "";
                foreach ($modellang as $m)
                    $strlanggame .= $m->fkLanguage->name . ", ";
                echo substr($strlanggame, 0, -2);
                ?></td>
        </tr>
        <tr>
            <th>Режим</th>
            <td><?php
                $strmodegame = "";
                foreach ($modelmode as $m)
                    $strmodegame .= $m->fkMode->name . ", ";
                echo substr($strmodegame, 0, -2);
                ?></td>
        </tr>
        <?php if ($syswin) { ?>
            <tr>
                <th class="os" colspan="2">Системные требования Windows</th>
            </tr>
            <tr>
                <th>ОС</th>
                <td><?= $syswin->os ?></td>
            </tr>
            <tr>
                <th>Процессор</th>
                <td><?= $syswin->cpu ?></td>
            </tr>
            <tr>
                <th>Оперативная память</th>
                <td><?= $syswin->ram ?></td>
            </tr>
            <tr>
                <th>Видеокарта</th>
                <td><?= $syswin->videocard ?></td>
            </tr>
            <tr>
                <th>DirectX</th>
                <td><?= $syswin->directx ?></td>
            </tr>
            <tr>
                <th>Место на диске</th>
                <td><?= $syswin->hdd ?></td>
            </tr>
        <?php } ?>
        <?php if ($sysmac) { ?>
            <tr>
                <th class="os" colspan="2">Системные требования Mac</th>
            </tr>
            <tr>
                <th>ОС:</th>
                <td><?= $sysmac->os ?></td>
            </tr>
            <tr>
                <th>Процессор:</th>
                <td><?= $sysmac->cpu ?></td>
            </tr>
            <tr>
                <th>Оперативная память:</th>
                <td><?= $sysmac->ram ?></td>
            </tr>
            <tr>
                <th>Видеокарта:</th>
                <td><?= $sysmac->videocard ?></td>
            </tr>
            <tr>
                <th>Место на диске:</th>
                <td><?= $sysmac->hdd ?></td>
            </tr>
        <?php } ?>
        <?php if ($syslinux) { ?>
            <tr>
                <th class="os" colspan="2">Системные требования Linux/Steam OS</th>
            </tr>
            <tr>
                <th>ОС:</th>
                <td><?= $syslinux->os ?></td>
            </tr>
            <tr>
                <th>Процессор:</th>
                <td><?= $syslinux->cpu ?></td>
            </tr>
            <tr>
                <?php if ($syslinux->ram) { ?>
                    <td>Оперативная память:</td>
                    <td><?= $syslinux->ram ?></td>
                <?php } ?>
            </tr>
            <tr>
                <th>Видеокарта:</th>
                <td><?= $syslinux->videocard ?></td>
            </tr>
            <tr>
                <th>Место на диске:</th>
                <td><?= $syslinux->hdd ?></td>
            </tr>
            <tr>
                <?php if ($syslinux->soundcard){ ?>
                <th>Звуковая карта:</th>
                <td><?= $syslinux->soundcard ?></td>
                    <?php } ?>
            </tr>
        <?php } ?>
        <tr>
            <th>Постер</th>
            <td><img src="<?= $modelvideo->img_main ?>" alt="game_poster" width="600" height="325"></td>
        </tr>
        <tr>
            <th>Скриншоты</th>
            <td><?php foreach ($sliderimg as $s){ ?>
                <img src="<?= $s->img ?>" alt="game_screanshot" width="150" height="100">
                <?php }?>
            </td>
        </tr>
        <tr>
            <th>Видеотрейлер</th>
            <td><?php $source = "https://www.youtube.com/embed/". $modelvideo->video_trailer; ?>
                <iframe width="560" height="315" src="<?=$source?>" frameborder="0" allowfullscreen></iframe></td>
        </tr>
    </table>

</div>