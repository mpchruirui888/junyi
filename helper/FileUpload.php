<?php
/**
 * Created by PhpStorm.
 * User: lrving
 * Date: 2019/10/31
 * Time: 15:12
 */
namespace  app\helper;
use app\models\UploadConfig;
use Obs\ObsClient;


class FileUpload
{
    private $key;
    private $secret;
    private $endpoint;
    private $bucket;
    private $domain;
    public function __construct()
    {
        $data = UploadConfig::findOne(1)->toArray();
        $this->key = $data['key'];
        $this->secret = $data['secret'];
        $this->endpoint = $data['endpoint'];
        $this->bucket = $data['bucket'];
        $this->domain = $data['domain'];
    }
    
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
                 'Key' => 'junyi/'.$check['objectName'],
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