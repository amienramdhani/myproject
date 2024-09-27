<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $merchant app\models\Merchant */
/* @var $services app\models\Service[] */

$this->title = 'Detail Merchant: ' . Html::encode($merchant->name);
?>

<h1><?= Html::encode($this->title) ?></h1>

<p>Lokasi: <?= Html::encode($merchant->location) ?></p>
<p>Kategori: <?= Html::encode($merchant->category) ?></p>

<h2>Layanan yang Tersedia</h2>

<?php if (!empty($services)): ?>
    <ul>
        <?php foreach ($services as $service): ?>
            <li>
                <?= Html::encode(
                    $service->name
                ) ?> - <?= Yii::$app->formatter->asCurrency($service->price) ?>
                (<?= Html::encode($service->description) ?>)
                <?= Html::a(
                    'Daftar Antrian',
                    ['queue/create', 'serviceId' => $service->id],
                    ['class' => 'btn btn-primary']
                ) ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Tidak ada layanan yang tersedia di merchant ini.</p>
<?php endif; ?>
