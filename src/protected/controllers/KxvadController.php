<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class KxvadController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/main';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function actionIndex() {
        $model = new Kxvad('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Kxvad'])){
            $model->attributes=$_GET['Kxvad'];
        }
        
        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionMember() {
        $model = new KxvMember('search');
        //$model->unsetAttributes();  // clear any default values
        if(isset($_GET['KxvMember'])){
            $model->attributes=$_GET['KxvMember'];
        }
        $this->render('member', array(
            'model' => $model,
        ));
    }
    public function actionCharge() {
        $model = new KxvCharge('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['KxvCharge']))
                $model->attributes=$_GET['KxvCharge'];
        $this->render('charge', array(
            'model' => $model,
        ));
    }

}
