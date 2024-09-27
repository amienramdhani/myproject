<?php

namespace app\controllers;

use Yii;
use app\models\Queue;
use app\models\Service;
use app\models\Merchant;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class QueueController extends Controller
{
    // Mengatur behavior controller
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    // Menampilkan semua antrian yang dimiliki oleh user yang sedang login
    public function actionIndex()
    {
        $userId = Yii::$app->user->id; // Mendapatkan ID user yang sedang login
        $queues = Queue::find()
            ->where(['user_id' => $userId])
            ->all(); // Mengambil antrian untuk user tersebut

        return $this->render('index', [
            'queues' => $queues,
        ]);
    }

    // Membuat antrian baru setelah user memilih layanan
    public function actionCreate($serviceId)
    {
        $service = Service::findOne($serviceId);
        if (!$service) {
            throw new NotFoundHttpException('Layanan tidak ditemukan.');
        }

        $queue = new Queue();
        $queue->user_id = Yii::$app->user->id;
        $queue->merchant_id = $service->merchant_id;
        $queue->service_id = $service->id;

        // Dapatkan nomor antrian terakhir dari merchant yang sama
        $lastQueue = Queue::find()
            ->where(['merchant_id' => $service->merchant_id])
            ->orderBy(['queue_number' => SORT_DESC])
            ->one();

        // Jika ada antrian sebelumnya, tambah nomor antrian; jika tidak, mulai dari 1
        $queue->queue_number = $lastQueue ? $lastQueue->queue_number + 1 : 1;
        $queue->queue_status = 'waiting';
        $queue->save();

        return $this->redirect(['status', 'id' => $queue->id]);
    }

    // Menampilkan status antrian berdasarkan ID
    public function actionStatus($id)
    {
        $queue = Queue::findOne($id);
        if (!$queue || $queue->user_id != Yii::$app->user->id) {
            throw new NotFoundHttpException('Antrian tidak ditemukan.');
        }

        return $this->render('status', [
            'queue' => $queue,
        ]);
    }
}
