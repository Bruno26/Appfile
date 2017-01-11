<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "video".
 *
 * @property integer $id_video
 * @property string $descripcion
 * @property string $url
 * @property integer $status
 */
class Video extends \yii\db\ActiveRecord
{
  public $nameFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'video';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre','descripcion', 'url', 'status'], 'required'],
            [['status'], 'integer'],
            [['descripcion'], 'string', 'max' => 200],
            [['nombre'], 'string', 'max' => 50],
            [['url'], 'string', 'skipOnEmpty' => false, 'max' => 250],

            //IMAGEN
            [['nameFile'], 'file', 'mimeTypes' => 'movie/*'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_video' => 'Id Video',
            'descripcion' => 'Descripción',
            'url' => 'Url',
            'status' => 'Status',
            'nombre' => 'Nombre',
        ];
    }
}
