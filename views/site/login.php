<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Login';
if ($model->hasErrors()) {
    echo '<div class="alert alert-danger">';
    echo Html::errorSummary($model);
    echo '</div>';
}
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="site-login">
    <p>Silakan isi data berikut untuk login:</p>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
    <?= $form->field($model, 'password')->passwordInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Login', [
            'class' => 'btn btn-primary',
            'name' => 'login-button',
        ]) ?>
    </div>
    <p>Belum memiliki akun? <?= Html::a('Daftar di sini', [
        'site/register',
    ]) ?></p>


    <?php ActiveForm::end(); ?>
</div>
