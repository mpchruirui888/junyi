<?php
/**
 * Created by PhpStorm.
 * User: lrving
 * Date: 2019/11/21
 * Time: 16:06
 */

namespace app\models;


use yii\db\ActiveRecord;

class UploadConfig extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%upload_config}}';
    }
}