<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Registrasi';
if ($model->hasErrors()) {
    echo '<div class="alert alert-danger">';
    echo Html::errorSummary($model);
    echo '</div>';
}
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="site-register">
    <p>Silakan isi data berikut untuk mendaftar:</p>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
    <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
    <?= $form->field($model, 'password')->passwordInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Daftar', [
            'class' => 'btn btn-success',
            'name' => 'register-button',
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
