<?php

namespace app\modules\admin\controllers;
use app\models\UploadConfig;
use app\modules\admin\models\AdminForm;


/**
 * Default controller for the `Module` module
 */
class IndexController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionDemo()
    {
        return  $this->renderPartial('demo');
    }


}
