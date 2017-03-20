<?php
    use app\models\Gamemedia;
    $game_img = Gamemedia::find()->where(['game_id' => $game->id])->one();
?>
 <li>
     <a href="<?=$game->link?>">
        <img src="<?=$game_img->img_main?>" alt="game image">
        <h1><?=$game->name?></h1>
        <p><?=$game->price?> грн</p>
        <?php if($game->discount > 0 ){ ?> <div>-<?=$game->discount?>%</div> <?php } ?>
      </a>
 </li>
