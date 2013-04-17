<?php
$this->pageTitle = Yii::app()->name . ' - ' . UserModule::t("Login");
$this->breadcrumbs = array(
    UserModule::t("Login"),
);
?>

<div class="row-fluid">

    <div class="row-fluid">
        <div class="span12 center login-header">
            <h2>Welcome to CMS</h2>
        </div><!--/span-->
    </div><!--/row-->

    <div class="row-fluid">
        <div class="well span5 center login-box">
                <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'form_login',
    'htmlOptions'=>array('class'=>'form-horizontal'),
    'enableAjaxValidation'=>true,
    //'enableClientValidation'=>true,//是否客户端验证
    'method'=>'post',
)); ?>
             
               <?php echo $form->errorSummary($model,null,null,array('class'=>'alert alert-info')); ?>
               
            
                <fieldset>
                    <div class="input-prepend" title="Username" data-rel="tooltip">
                        <span class="add-on"><i class="icon-user"></i></span>
                        <?php echo $form->textField($model, 'username', array('class'=>'input-large span10','placeholder'=>'用户名')); ?>
                    </div>
                    <div class="clearfix"></div>

                    <div class="input-prepend" title="Password" data-rel="tooltip">
                        <span class="add-on"><i class="icon-lock"></i></span>
                        <?php echo $form->passwordField($model, 'password', array('class'=>'input-large span10','placeholder'=>'密码')); ?>
                    </div>
                    <div class="clearfix"></div>

                    <div class="input-prepend">
                        
                        <?php echo $form->checkBoxRow($model, 'rememberMe', array('class'=>'')); ?>
                    </div>
                    <div class="clearfix"></div>

                    <p class="center span5">
                        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'登录','htmlOptions'=>array('class'=>'btn btn-primary'))); ?>
                    </p>
                </fieldset>
            <?php $this->endWidget(); ?>
        </div><!--/span-->
    </div><!--/row-->
</div><!--/fluid-row-->

</div><!--/.fluid-container-->
