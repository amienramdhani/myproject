<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Queue */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Dapatkan Nomor Antrian';
?>

<h1><?= Html::encode($this->title) ?></h1>

<p>Anda akan mendapatkan nomor antrian untuk layanan ini.</p>

<?php $form = ActiveForm::begin(); ?>

    <?= $form
        ->field($model, 'merchant_id')
        ->hiddenInput()
        ->label(false) ?>
    <?= $form
        ->field($model, 'service_id')
        ->hiddenInput()
        ->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Dapatkan Nomor Antrian', [
            'class' => 'btn btn-success',
        ]) ?>
    </div>

<?php ActiveForm::end(); ?>

<p><?= Html::a('Kembali ke Daftar Merchant', ['merchant/index']) ?></p>
