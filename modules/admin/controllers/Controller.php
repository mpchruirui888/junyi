<?php
namespace  app\modules\admin\controllers;
/**
 * Created by PhpStorm.
 * User: lrving
 * Date: 2019/11/20
 * Time: 11:12
 */


class Controller  extends  \yii\web\Controller
{
            public $layout = 'admin';
            public function beforeAction($name)
            {
                $safeAction = [
                    'admin/login/login','admin/login/index'
                ];
                $action = \Yii::$app->controller->getRoute();
                $session = \Yii::$app->session;
                if(!in_array($action,$safeAction))
                 {
                    if(isset($session['adminUserName'])){
                        return true;
                    }else{
                     return $this->redirect(array('/admin/login/index'));
                    }
                }
                else{
                    return true;
                }

            }
}