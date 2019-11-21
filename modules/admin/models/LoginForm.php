<?php
namespace app\modules\admin\models;

use app\models\AdminUser;
use yii\base\Model;

/**
 * Created by PhpStorm.
 * User: lrving
 * Date: 2019/11/21
 * Time: 9:35
 */

class LoginForm  extends Model
{
    public $username;
    public $password;

    public function rules()
    {
        return [
            [['username','password'],'required']
        ];
    }

    //验证身份
    public function check()
    {
        $result = $this->checkInput($this->attributes);
        return $result;
    }

    public function getUserbyName($username)
    {

        $admin = AdminUser::findOne(['username'=>$username]);

        if(!isset($admin)){
            return json_encode(['code'=>400,'msg'=>'用户不存在']);
        }else{
            return $this->checkPassword($admin);
        }
    }

    /**检查输入的用户名
     * @param $admin
     * User: lrving
     * DateTime: 2019/11/21 10:31
     */
    public function checkInput($admin)
    {
        if(empty($admin['username'])){
                return json_encode(['code'=>400,'msg'=>'用户名不能为空']);
        }else{
                return $this->getUserbyName($admin['username']);
        }
    }

    /**对比密码
     * User: lrving
     * DateTime: 2019/11/21 10:54
     */
    public function checkPassword($admin)
    {
        $nowPassword = md5(md5($this->attributes['password'].$admin['salt']));
        if( $admin['password'] == $nowPassword){
               $session =  \Yii::$app->session;
               $session->set('adminUserId',$admin['id']);
               $session->set('adminUserName',$admin['username']);
               $session->set('adminUserHead',$admin['head']);
            return json_encode(['code'=>200,'msg'=>'登陆成功']);
        }else{
            return json_encode(['code'=>400,'msg'=>'密码错误']);
        }
    }

    public function loginOut()
    {
        $session =  \Yii::$app->session;
        unset($session['adminUserName']);
        unset($session['adminUserId']);
        if(!isset($session['adminUserName'])){
            return json_encode(['code'=>200,'msg'=>'退出成功']);
        }
    }
}