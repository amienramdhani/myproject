<?php

use yii\bootstrap5\ActiveForm;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $merchants app\models\Merchant[] */

$this->title = 'Daftar Merchant';
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="merchant-search">
    <?php $form = ActiveForm::begin([
        'method' => 'get', // Menggunakan metode GET untuk pencarian
        'action' => ['merchant/index'], // Aksi untuk dikirim
    ]); ?>

    <div class="row">
        <div class="col-md-4">
            <?= $form
                ->field($searchModel, 'name')
                ->textInput(['placeholder' => 'Nama Merchant'])
                ->label(false) ?>
        </div>
        <div class="col-md-4">
            <?= $form
                ->field($searchModel, 'category')
                ->textInput(['placeholder' => 'Kategori'])
                ->label(false) ?>
        </div>
        <div class="col-md-4">
            <?= Html::submitButton('Cari', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'name',
        'location',
        'category',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view}',
            'buttons' => [
                'view' => function ($url, $model) {
                    return Html::a('Lihat', $url, [
                        'class' => 'btn btn-info',
                    ]);
                },
            ],
        ],
    ],
]) ?>

<?php if (!empty($merchants)): ?>
    <ul>
        <?php foreach ($merchants as $merchant): ?>
            <li>
                <?= Html::a(Html::encode($merchant->name), [
                    'view',
                    'id' => $merchant->id,
                ]) ?>
                - <?= Html::encode(
                    $merchant->location
                ) ?> (Kategori: <?= Html::encode($merchant->category) ?>)
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Tidak ada merchant yang tersedia.</p>
<?php endif; ?>
