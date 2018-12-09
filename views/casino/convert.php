<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $prize app\services\PrizeFactory */

$this->title = 'My Yii Application';
?>
<div class="site-index text-center">
    <h4>
        Cash converted to bonus - <?php echo $prize->getInfo(); ?>
    </h4>

    <div>
        <?php echo Html::a( 'More play?', ['index'], ['class' => 'btn btn-success'] ); ?>
    </div>

</div>
