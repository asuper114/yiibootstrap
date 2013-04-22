<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <!-- blueprint CSS framework -->
        
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
        <![endif]-->


        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <style type="text/css">
            .sub-memu{display: list-item;text-align: -webkit-match-parent;margin-left: 0;list-style-type: none;}
            </style>

            
    </head>
    <body>
        <div id="maincontainer" class="clearfix">
            <header>
                <div class="navbar navbar-fixed-top">
                    <div class="navbar-inner">
                        <div class="container-fluid">
                            <a class="brand" href="dashboard.htm"><i class="icon-home icon-white"></i> Welcome Admin <span class="sml_t">1.0</span></a>
                            <ul class="nav user_menu pull-right">


                                <li class="divider-vertical hidden-phone hidden-tablet"></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?php echo Yii::app()->bootstrap->getAssetsUrl();?>/img/user_avatar.png" alt="" class="user_avatar"><?php echo Yii::app()->user->name;?> <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="/index.php?r=user/profile">My Profile</a></li>

                                        <li class="divider"></li>
                                        <li><a href="/index.php?r=user/logout">Log Out</a></li>
                                    </ul>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>

            </header>
            <!-- 开始-->
            <div id="contentwrapper">
                <div class="main_content">
                    <?php echo $content; ?>
                </div>
            </div>
<?php echo $this->renderPartial('//layouts/_leftMenu'); ?>
        </div>
    </body>


</html>
