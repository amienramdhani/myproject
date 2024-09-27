<?php

namespace app\controllers;

use Yii;
use app\models\Merchant;
use app\models\Service;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class MerchantController extends Controller
{
    // Menampilkan daftar semua merchant yang tersedia
    // Menampilkan daftar merchant dengan fitur pencarian
    public function actionIndex()
    {
        $searchModel = new Merchant(); // Inisialisasi model untuk pencarian
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams); // Mengambil data pencarian

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    // Menampilkan detail merchant dan layanan yang dimiliki oleh merchant
    public function actionView($id)
    {
        $merchant = Merchant::findOne($id); // Mencari merchant berdasarkan ID
        if (!$merchant) {
            throw new NotFoundHttpException('Merchant tidak ditemukan.');
        }

        $services = $merchant->getServices()->all(); // Mendapatkan semua layanan dari merchant

        return $this->render('view', [
            'merchant' => $merchant,
            'services' => $services,
        ]);
    }
}
