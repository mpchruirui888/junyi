<?php
/**
 * Created by PhpStorm.
 * User: lrving
 * Date: 2019/11/20
 * Time: 15:58
 */

namespace app\modules\admin\controllers;


class LoginController  extends Controller
{
    public function actionIndex()
    {
       return  $this->renderPartial('login');
    }

    public function actionLogin()
    {
        echo "22";
        die;
    }
}