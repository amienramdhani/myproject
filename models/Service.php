<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Service extends ActiveRecord
{
    // Menentukan tabel yang digunakan oleh model ini
    public static function tableName()
    {
        return 'services';
    }

    // Mengatur aturan validasi
    public function rules()
    {
        return [
            [['name', 'price'], 'required'], // Nama layanan dan harga wajib diisi
            [['merchant_id'], 'integer'], // ID merchant adalah integer
            [['price'], 'number'], // Harga adalah tipe angka
            [['description'], 'string'], // Deskripsi adalah tipe teks
            [['created_at'], 'safe'], // Tanggal aman
        ];
    }

    // Menghubungkan layanan dengan merchant
    public function getMerchant()
    {
        return $this->hasOne(Merchant::className(), ['id' => 'merchant_id']);
    }
}
