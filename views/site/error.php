<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <?php if ($exception->statusCode == '404') { ?>
        <img src="../../web/img/404.jpg">
    <?php } else if ($exception->statusCode == '403') { ?>
        <img src="../../web/img/403.jpg">
    <?php } else { ?>
        <h1><?= Html::encode($this->title) ?></h1>

        <div class="alert alert-danger">
            <?= nl2br(Html::encode($message)) ?>
        </div>

        <p>
            The above error occurred while the Web server was processing your request.
        </p>
        <p>
            Please contact us if you think this is a server error. Thank you.
        </p>
    <?php } ?>

</div>
