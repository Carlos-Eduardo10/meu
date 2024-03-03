<?php

namespace app\controllers;
use yii\web\Controller;


class PainelController extends Controller
{



    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionIntegrado()
    {
        return $this->render('integrado');
    }

}