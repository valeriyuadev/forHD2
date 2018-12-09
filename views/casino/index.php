<?php

use yii\helpers\Html;


/* @var $this yii\web\View */

$this->title = 'Играть';
?>
<div class="site-index text-center">
    <h4>Generate prize</h4>
    <?php echo Html::a( $this->title, ['generate'], ['class' => 'btn btn-success'] ); ?>
</div>
