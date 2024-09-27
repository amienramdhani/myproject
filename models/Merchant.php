<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

class Merchant extends ActiveRecord
{
    // Menentukan tabel yang digunakan oleh model ini
    public static function tableName()
    {
        return 'merchants';
    }

    // Mengatur aturan validasi
    public function rules()
    {
        return [
            [['name'], 'required'], // Nama merchant wajib diisi
            [['name', 'location', 'category'], 'string', 'max' => 255], // Batasan panjang karakter
            [['created_at'], 'safe'], // Kolom tanggal diizinkan tipe safe
        ];
    }

    // Menghubungkan merchant dengan layanan (services)
    public function getServices()
    {
        return $this->hasMany(Service::className(), ['merchant_id' => 'id']); // Relasi dengan tabel layanan
    }

    // Fungsi untuk pencarian merchant
    public function search($params)
    {
        $query = Merchant::find();

        // Setup DataProvider
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // Load data ke model
        $this->load($params);

        // Filter berdasarkan nama dan kategori
        if (!empty($this->name) || !empty($this->category)) {
            $query
                ->andFilterWhere(['like', 'name', $this->name])
                ->orFilterWhere(['like', 'category', $this->category]);
        }

        return $dataProvider;
    }
}
