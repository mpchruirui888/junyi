<?php
/**
 * Created by PhpStorm.
 * User: lrving
 * Date: 2019/11/21
 * Time: 9:21
 */

namespace app\models;


use yii\db\ActiveRecord;

class AdminUser extends ActiveRecord
{
    public static $table = 'jy_admin_user';
    public static function tableName()
    {
            return  self::$table;
    }

    public function rules()
    {
        return [
            [['username','password'],'required'],
            [['id'],'integer']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id'=>'用户ID',
            'username'=>'用户名',
            'salt'=>'盐',
            'password'=>'用户密码',
            'mobile'=>'用户联系方式',
            'permission'=>'用户权限',
            'add_time'=>'增加时间',
        ];
    }

}