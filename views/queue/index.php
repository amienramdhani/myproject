<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $queues app\models\Queue[] */

$this->title = 'Daftar Antrian Saya';
?>

<h1><?= Html::encode($this->title) ?></h1>

<?php if (!empty($queues)): ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nomor Antrian</th>
                <th>Merchant</th>
                <th>Layanan</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($queues as $queue): ?>
                <tr>
                    <td><?= Html::encode($queue->queue_number) ?></td>
                    <td><?= Html::encode($queue->merchant->name) ?></td>
                    <td><?= Html::encode($queue->service->name) ?></td>
                    <td><?= Html::encode($queue->queue_status) ?></td>
                    <td><?= Yii::$app->formatter->asDatetime(
                        $queue->created_at
                    ) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Anda belum memiliki antrian.</p>
<?php endif; ?>
