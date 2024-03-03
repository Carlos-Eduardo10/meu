<?php

namespace app\controllers;

use yii\web\Controller;


class FaturaController extends Controller
{


    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionDados()
    {
        return $this->render('dados');
    }



}