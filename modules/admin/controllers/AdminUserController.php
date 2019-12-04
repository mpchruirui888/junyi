<?php
/**
 * Created by PhpStorm.
 * User: lrving
 * Date: 2019/11/22
 * Time: 10:58
 */

namespace app\modules\admin\controllers;
use app\helper\FileUpload;
use app\modules\admin\models\LoginForm;
use app\modules\admin\models\AdminForm;
use app\modules\admin\models\AdminUserForm;


class AdminUserController  extends Controller
{
    /**管理员个人信息
     * User: lrving
     * DateTime: 2019/11/21 16:22
     */
    public function actionInfo()
    {
        $data = AdminForm::getInfo($_SESSION['adminUserName']);
        return $this->renderPartial('adminInfo',['data'=>$data]);
    }

    /**更换头像
     * @return string}
     * User: lrving
     * DateTime: 2019/11/22 13:37
     */
    public function actionUpload(){
       $file = new  FileUpload();
       $result = $file->Upload($_FILES['img']);
       return json_encode(['code'=>200,'msg'=>'请求成功','url'=>$result]);
    }

    /**修改个人信息
     * User: lrving
     * DateTime: 2019/11/22 13:37
     */
    public function actionEdit()
    {
        $data =  \Yii::$app->request->post();
        $result =   new AdminForm();
        $result->attributes = $data;
        return $result->Edit();

    }
}