<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;
use yii\web\BadRequestHttpException;

class SiteController extends Controller
{
    public function actionError()
    {
        $error = Yii::$app->errorHandler->exception;

        if ($error) {
            return $this->render('error', ['error' => $error]);
        }
    }

    public function actionRegister()
    {
        $model = new \yii\base\DynamicModel(['username', 'password']);
        $model
            ->addRule(['username', 'email', 'password'], 'required')
            ->addRule('username', 'string', ['min' => 3])
            ->addRule('email', 'string', ['min' => 3])
            ->addRule('password', 'string', ['min' => 6]);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user = new User();
            $user->username = $model->username;
            $user->email = $model->email;
            $user->password = Yii::$app->security->generatePasswordHash(
                $model->password
            );
            $user->auth_token = Yii::$app->security->generateRandomString();
            $user->created_at = time();

            if ($user->save()) {
                // Login otomatis setelah registrasi
                Yii::$app->user->login($user);
                return $this->goHome();
            }
        }

        return $this->render('register', ['model' => $model]);
    }

    public function actionLogin()
    {
        $model = new \yii\base\DynamicModel(['username', 'password']);
        $model->addRule(['username', 'password'], 'required');

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user = User::findByUsername($model->username);
            if ($user && $user->validatePassword($model->password)) {
                Yii::$app->user->login($user);
                return $this->goHome();
            }
            $model->addError('password', 'Username atau password salah.');
        }

        return $this->render('login', ['model' => $model]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
}
