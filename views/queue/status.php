<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $queue app\models\Queue */

$this->title = 'Status Antrian #' . $queue->queue_number;
?>

<h1><?= Html::encode($this->title) ?></h1>

<p>Merchant: <?= Html::encode($queue->merchant->name) ?></p>
<p>Layanan: <?= Html::encode($queue->service->name) ?></p>
<p>Status Antrian: <?= Html::encode($queue->queue_status) ?></p>

<?= Html::a(
    'Kembali ke Daftar Antrian',
    ['index'],
    ['class' => 'btn btn-primary']
) ?>
