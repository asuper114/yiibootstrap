<?php

class ChannelController extends Controller {

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

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    /*
      public function accessRules()
      {
      return array(
      array('allow',  // allow all users to perform 'index' and 'view' actions
      'actions'=>array('index','view'),
      'users'=>array('*'),
      ),
      array('allow', // allow authenticated user to perform 'create' and 'update' actions
      'actions'=>array('create','update','assign'),
      'users'=>array('@'),
      ),
      array('allow', // allow admin user to perform 'admin' and 'delete' actions
      'actions'=>array('admin','delete','assign'),
      'users'=>array('admin'),
      ),
      array('deny',  // deny all users
      'users'=>array('*'),
      ),
      );
      }
     * *
     */

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Channel;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Channel'])) {
            $model->attributes = $_POST['Channel'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->channel_id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Channel'])) {
            $model->attributes = $_POST['Channel'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->channel_id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Channel');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Channel('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Channel']))
            $model->attributes = $_GET['Channel'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionAssign() {

        $user = Yii::app()->request->getParam('User');
        $userId = isset($user['id']) ? $user['id'] : "";
        $model = Channel::model();
        $data = array();
        $data['listBoxNumberOfLines'] = 30;

        $data['userAssignedChannel'] = array();
        $data['userNoAssignedChannel'] = array();
        $data['revoke'] = true;
        $data['assign'] = true;

        //$data['userAssignedChannel'] = Yii::app()->getModule('user')->getUserAssignedChannel($userId) ;
        if (!Yii::app()->request->isAjaxRequest) {
            $this->render('assign', array(
                'model' => $model,
                'data' => $data,
            ));
        } else {
            $this->_GetChannel();
        }
    }

    public function actionAssignChannel() {
        //$revokeChannel = Yii::app()->request->getParam('revokeChannel', 0);
        if (isset($_SERVER['REQUEST_METHOD']) && ($_SERVER['REQUEST_METHOD'] == 'POST' || $_SERVER['REQUEST_METHOD'] == 'GET')) {
            //['Channel']['channel_id']['revoke'];
            $userId = isset($_REQUEST['User']['id']) ? $_REQUEST['User']['id'] : NULL;
            $revokeChannel = Yii::app()->request->getParam('revokeChannel');
            $revokeId = isset($_REQUEST['Channel']['channel_id']['revoke']) ? $_REQUEST['Channel']['channel_id']['revoke'] : NULL;
            if (is_array($revokeId) && !empty($userId)&&$revokeChannel) {
                //修改数据库
                    Yii::app()->getModule('user')->revokeChannel($userId, $revokeId);
            }

            $assignId = isset($_REQUEST['Channel']['channel_id']['assign']) ? $_REQUEST['Channel']['channel_id']['assign'] : NULL;
            $assignChannel = Yii::app()->request->getParam('assignChannel');
            if (is_array($assignId) && !empty($userId) && $assignChannel) {

                Yii::app()->getModule('user')->assignChannel($userId, $assignId);
            }
             //加载模版
                $this->_GetChannel();
        }
    }

    public function actionGetChannel() {
        $this->_GetChannel();
    }

    private function _GetChannel() {
        $model = Channel::model();
        $user = Yii::app()->request->getParam('User');
        $userId = isset($user['id']) ? $user['id'] : '';
        $data = array();
        $data['listBoxNumberOfLines'] = 30;
        $data['revoke'] = $data['assign'] = false;
        $data['userAssignedChannel'] = Yii::app()->getModule('user')->getUserAssignedChannel($userId);
        $data['userNoAssignedChannel'] = Yii::app()->getModule('user')->getUserNoAssignedChannel($userId);
        if ($data['userAssignedChannel'] == array()) {
            $data['revoke'] = true;
        }
        if ($data['userNoAssignedChannel'] == array()) {
            $data['assign'] = true;
        }
        $this->renderPartial('//channel/_assign_channel', array('model' => $model, 'data' => $data), false, true);
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Channel the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Channel::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Channel $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'channel-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
