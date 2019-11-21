<?php
/**
 * Created by PhpStorm.
 * User: lrving
 * Date: 2019/11/20
 * Time: 15:58
 */

namespace app\modules\admin\controllers;


use app\models\AdminUser;
use app\modules\admin\models\LoginForm;

class LoginController  extends Controller
{


    public function actionIndex()
    {
       return  $this->renderPartial('login');
    }

    public function actionLogin()
    {
        $model =  new LoginForm();
        $model->attributes = \Yii::$app->request->post();
        $result = $model->check();
        return $result;
    }

    public function actionLoginOut()
    {
        $model =  new LoginForm();
        return  $model->loginOut();
    }
}