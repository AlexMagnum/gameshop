<?php
use yii\helpers\Html;

$this->title = 'Купить ' . $game->meta_title . ' лицензионный ключ';

$this->registerMetaTag([
    'name' => 'description',
    'content' => $game->meta_desc
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $game->meta_key
]);
?>

<div class="game">
    <h1 class="headgame">Купить <?= $game->name ?> ключ</h1>
    <div id="gallery" style="display:none;">
        <img alt="game trailer"
             data-type="youtube"
             data-videoid="<?= $gamemedia->video_trailer ?>">
        <?php foreach ($slideimg as $slide) { ?>
            <img alt="<?= $game->meta_title ?>" src="<?= $slide->img ?>" data-image="<?= $slide->img ?>">
        <?php } ?>
    </div>

    <div class="gameinfo">
        <table>
            <tr>
                <td class="w1">Издатель</td>
                <td class="w2"><?= $game->publisher ?></td>
            </tr>
            <tr>
                <td class="w1">ОС</td>
                <td class="w2"><?php $stros = "";
                    foreach ($os as $s) $stros .= $s->name . ", ";
                    echo substr($stros, 0, -2) ?></td>
            </tr>
            <tr>
                <td class="w1">Жанр</td>
                <td class="w2"><?php $strgenre = "";
                    foreach ($genre as $g) $strgenre .= $g->name . ", ";
                    echo substr($strgenre, 0, -2) ?></td>
            </tr>
            <tr>
                <td class="w1">Язык</td>
                <td class="w2"><?php $strlang = "";
                    foreach ($language as $l) $strlang .= $l->name . ", ";
                    echo substr($strlang, 0, -2) ?></td>
            </tr>
            <tr>
                <td class="w1">Платформа</td>
                <td class="w2"><?php $strplatform = "";
                    foreach ($platform as $p) $strplatform .= $p->name . ", ";
                    echo substr($strplatform, 0, -2) ?></td>
            </tr>
            <tr>
                <td class="w1">Дата выхода</td>
                <td class="w2"><?= $game->date_releaseformat ?></td>
            </tr>
            <tr>
                <td class="w1">Режим</td>
                <td class="w2"><?php $strmode = "";
                    foreach ($mode as $m) $strmode .= $m->name . ", ";
                    echo substr($strmode, 0, -2) ?></td>
            </tr>
        </table>
        <?php
        $str = "";
        $buystr = Html::tag('span', 'КУПИТЬ', ['class' => 'btnico']);
        $pricestr = Html::tag('span', $game->price . ' грн', ['class' => 'btnprice']);
        $str .= $buystr . $pricestr;
        if ($game->discount > 0) {
            $discstr = Html::tag('div', '-' . $game->discount . '%', ['class' => 'btndiscount']);
            $str .= $discstr;
        }
        echo Html::a($str, ['buy', 'id' => $game->id], ['class' => 'buttonbuy']) ?>
    </div>
    <div class="gamedescription">
        <div class="deschead">
            ОПИСАНИЕ
        </div>
        <div class="descmain">
            <?= $game->full_text ?>
        </div>
        <div class="parametr">Системные требования
            <?php if ($syswin) { ?>
                <table>
                    <tr>
                        <th>WINDOWS</th>
                        <th></th>
                    </tr>
                    <tr>
                        <td>ОС:</td>
                        <td><?= $syswin->os ?></td>
                    </tr>
                    <tr>
                        <td>Процессор:</td>
                        <td><?= $syswin->cpu ?></td>
                    </tr>
                    <tr>
                        <td>Оперативная память:</td>
                        <td><?= $syswin->ram ?></td>
                    </tr>
                    <tr>
                        <td>Видеокарта:</td>
                        <td><?= $syswin->videocard ?></td>
                    </tr>
                    <tr>
                        <td>DirectX:</td>
                        <td><?= $syswin->directx ?></td>
                    </tr>
                    <tr>
                        <td>Место на диске:</td>
                        <td><?= $syswin->hdd ?></td>
                    </tr>
                </table>
                <?php if($sysmac || $syslinux){ ?>
                <hr>
                <?php }?>
            <?php } ?>
            <?php if ($sysmac) { ?>
                <table>
                    <tr>
                        <th>Mac OS X</th>
                        <th></th>
                    </tr>
                    <tr>
                        <td>ОС:</td>
                        <td><?= $sysmac->os ?></td>
                    </tr>
                    <tr>
                        <td>Процессор:</td>
                        <td><?= $sysmac->cpu ?></td>
                    </tr>
                    <tr>
                        <td>Оперативная память:</td>
                        <td><?= $sysmac->ram ?></td>
                    </tr>
                    <tr>
                        <td>Видеокарта:</td>
                        <td><?= $sysmac->videocard ?></td>
                    </tr>
                    <tr>
                        <td>Место на диске:</td>
                        <td><?= $sysmac->hdd ?></td>
                    </tr>
                </table>
               <?php if($syslinux){ ?>
                <hr>
                <?php }?>
            <?php } ?>
            <?php if ($syslinux) { ?>
                <table>
                    <tr>
                        <th>SteamOS + Linux</th>
                        <th></th>
                    </tr>
                    <tr>
                        <td>ОС:</td>
                        <td><?= $syslinux->os ?></td>
                    </tr>
                    <tr>
                        <td>Процессор:</td>
                        <td><?= $syslinux->cpu ?></td>
                    </tr>
                    <tr>
                        <?php if ($syslinux->ram) { ?>
                            <td>Оперативная память:</td>
                            <td><?= $syslinux->ram ?></td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <td>Видеокарта:</td>
                        <td><?= $syslinux->videocard ?></td>
                    </tr>
                    <tr>
                        <td>Место на диске:</td>
                        <td><?= $syslinux->hdd ?></td>
                    </tr>
                    <tr>
                        <?php if ($syslinux->soundcard) { ?>
                            <td>Звуковая карта:</td>
                            <td><?= $syslinux->soundcard ?></td>
                        <?php } ?>
                    </tr>
                </table>
            <?php } ?>
        </div>
        <div class="marg"></div>
        <div id="vk_comments"></div>
    </div>
</div>