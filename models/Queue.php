<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Queue extends ActiveRecord
{
    public static function tableName()
    {
        return 'queues'; // Nama tabel antrian di database
    }

    public function rules()
    {
        return [
            [
                ['user_id', 'merchant_id', 'service_id', 'queue_number'],
                'required',
            ],
            [
                ['user_id', 'merchant_id', 'service_id', 'queue_number'],
                'integer',
            ],
            [['queue_status'], 'string'],
            [['created_at'], 'safe'],
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getMerchant()
    {
        return $this->hasOne(Merchant::className(), ['id' => 'merchant_id']);
    }

    public function getService()
    {
        return $this->hasOne(Service::className(), ['id' => 'service_id']);
    }
}
