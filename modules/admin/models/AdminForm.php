<?php
/**
 * Created by PhpStorm.
 * User: lrving
 * Date: 2019/11/22
 * Time: 10:14
 */

namespace app\modules\admin\models;


use app\models\AdminUser;
//use app\modules\admin\Module;
use yii\base\Model;

class AdminForm  extends Model
{
    public $username;
    public $password;
    public $id;
    public $mobile;
    public $head;

    public function rules()
    {
        return [
            [['username','password'],'required'],
            [['id'],'integer'],
            [['mobile'],'number'],
            [['head'],'url'],
        ];
    }

    /**获取个人资料
     * User: lrving
     * DateTime: 2019/11/22 10:14
     */
    public static function getInfo($username)
    {
        $result = AdminUser::findOne(['username'=>$username])->toArray();
        return $result;
    }

    /**修改数据
     * User: lrving
     * DateTime: 2019/11/22 13:43
     */
    public function Edit()
    {
        $user = AdminUser::findOne(['id'=>$this->attributes['id']]);

        $user->username = $this->attributes['username'];
        if($this->password ){
           $user->password = md5(md5($this->attributes['password'].$user->salt));
        }
        if($this->head){
           $user->password = $this->head ;
        }
        $user->mobile = $this->attributes['mobile'];
        $user->head = $this->attributes['head'];
        $result  = $user->save();
        if($result){
            $session = \Yii::$app->session;
            $session['adminUserName'] = $this->username;
            $session['adminUserId'] = $this->id;
            if( $this->head){
                $session['adminUserHead'] = $this->head;
            }
            return json_encode(['code'=>200,'msg'=>'操作成功']);
        }else{
            return json_encode(['code'=>200,'msg'=>'操作失败']);
        }
    }
}