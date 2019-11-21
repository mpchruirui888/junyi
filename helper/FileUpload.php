<?php
/**
 * Created by PhpStorm.
 * User: lrving
 * Date: 2019/10/31
 * Time: 15:12
 */
namespace  app\helper;
use Obs\ObsClient;

class FileUpload
{
    private $key = 'EDZZUHSB2YG7PNU2NQRN';
    private $secret = 'FL3knol0Oy7jUi89rsDnuhOk5Ww1Br68gOuVCEXJ';
    private $endpoint = 'obs.cn-south-1.myhuaweicloud.com';
    private $bucket = 'obs-jkyptest';
    private $domain = 'https://jktestobs.jkslw.cn/';

    public  function Upload($file)
    {
         $check = $this->checkFile($file);

         if($check['objectName']){
             // 创建ObsClient实例
             $obsClient = new ObsClient([
                 'key' => $this->key,
                 'secret' => $this->secret,
                 'endpoint' => $this->endpoint,
             ]);

             $resp = $obsClient->putObject([
                 'Bucket' => $this->bucket,
                 'Key' => 'images/'.$check['objectName'],
                 'SourceFile' => $check['SourceFile']  // localfile为待上传的本地文件路径，需要指定到具体的文件名
             ]);
         }
         $a = trim(strrchr($resp['ObjectURL'], '443/'),'443/');
         $url = $this->domain.$a;
         return $url;
    }

    public function checkFile($file)
    {
        $fileSize = $file['size'];
        $filePostfix = trim(strrchr($file['name'], '.'),'.');
//        $fileNewName = makeRnd(4).time().".".$filePostfix;
        $fileNewName = makeRnd(4).".".$filePostfix;
        if($fileSize>204800){
            return false;
        }
        if(!in_array($filePostfix,['jpg','png','jpeg'])){
            return false;
        }
        return ['objectName'=>$fileNewName,'SourceFile'=>$file['tmp_name']];
    }


}