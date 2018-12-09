<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $prize app\services\PrizeFactory */

$this->title = 'My Yii Application';
?>
<div class="site-index text-center">
    <h4>
        Your prize - <?php echo $prize->getInfo(); ?>
    </h4>

    <hr>

    <table class="table table-bordered table-condensed"  style='width: 350px; margin: 0 auto;'>
        <tr>
            <td><?php echo Html::a( '1', ['apply'], ['class' => 'btn btn-success'] ); ?></td>
            <th>Принять приз?</th>
        </tr>
        <?php if( $prize instanceof \app\services\Cash ): ?>
            <tr>
                <td><?php echo Html::a( '2', ['convert'], ['class' => 'btn btn-success'] ); ?></td>
                <th>Конвертировать деньги, в бонусы?</th>
            </tr>
        <?php elseif( $prize instanceof \app\services\Gift ): ?>
            <tr>
                <td><?php echo Html::a( '2', ['send-gift'], ['class' => 'btn btn-success'] ); ?></td>
                <th>Отправить подарок куръером?</th>
            </tr>
        <?php endif; ?>
        <tr>
            <td><?php echo Html::a( '3', ['reject'], ['class' => 'btn btn-success'] ); ?></td>
            <th>Отклонить приз?</th>
        </tr>
    </table>

<div>





    </div>

</div>
