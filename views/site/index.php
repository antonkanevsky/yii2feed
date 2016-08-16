<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'Welcome to Yii2 test site';
?>
<div class="site-index">
    <div class="jumbotron">
        <h1>Hello, <?= Yii::$app->user->isGuest ? 'guest' : 'user' ?>!</h1>
        <p>Welcome to Yii2 test site!</p>
        <p class="lead">
            <?php if (Yii::$app->user->isGuest) { ?>
                Please, <a href="<?= Url::to(['site/login']) ?>">login</a>
                to watch the entities, created by generator.
            <?php } else { ?>
                To watch the entities, created by generator, follow
                <a href="<?= Url::to(['entity/index']) ?>">this page</a>.
            <?php } ?>
        </p>
    </div>

</div>
