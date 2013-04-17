<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'My Web Application',
    'language' => 'zh_cn',
    // preloading 'log' component
    'preload' => array('log','bootstrap'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.modules.user.models.*',
        'application.modules.user.components.*',
        'application.modules.srbac.controllers.SBaseController',
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool
        /*
          'gii' => array(
          'class' => 'system.gii.GiiModule',
          'password' => 'Enter Your Password Here',
          // If removed, Gii defaults to localhost only. Edit carefully to taste.
          'ipFilters' => array('127.0.0.1', '::1'),
          ),
         */
        'user' => array(
            # encrypting method (php hash function)
            'hash' => 'md5',
            # send activation email
            'sendActivationMail' => true,
            # allow access for non-activated users
            'loginNotActiv' => false,
            # activate user on registration (only sendActivationMail = false)
            'activeAfterRegister' => false,
            # automatically login from registration
            'autoLogin' => true,
            # registration path
            'registrationUrl' => array('/user/registration'),
            # recovery password path
            'recoveryUrl' => array('/user/recovery'),
            # login form path
            'loginUrl' => array('/user/login'),
            # page after login
            'returnUrl' => array('/user/profile'),
            # page after logout
            'returnLogoutUrl' => array('/user/login'),
        ),
        //*/
        'srbac' => array(
            'userclass' => 'User', //可选,默认是 User
            'userid' => 'id', //可选,默认是 userid
            'username' => 'username', //可选，默认是 username
            'debug' => true, //可选,默认是 false
            'pageSize' => 10, //可选，默认是 15
            'superUser' => 'Authority', //可选，默认是 Authorizer
            'css' => 'srbac.css', //可选，默认是 srbac.css
            'layout' => 'application.views.layouts.main', //可选,默认是
            // application.views.layouts.main, 必须是一个存在的路径别名
            'notAuthorizedView' => 'srbac.views.authitem.unauthorized', // 可选,默认是unauthorized.php
            //srbac.views.authitem.unauthorized, 必须是一个存在的路径别名
            'alwaysAllowed' => array(//可选,默认是 gui
                'SiteLogin', 'SiteLogout', 'SiteIndex', 'SiteAdmin',
                'SiteError', 'SiteContact'),
            'userActions' => array(//可选,默认是空数组
                'Show', 'View', 'List'),
            'listBoxNumberOfLines' => 15, //可选,默认是10
            'imagesPath' => 'srbac.images', //可选,默认是 srbac.images
            'imagesPack' => 'noia', //可选,默认是 noia
            'iconText' => true, //可选,默认是 false
            'header' => 'srbac.views.authitem.header', //可选,默认是
            // srbac.views.authitem.header, 必须是一个存在的路径别名
            'footer' => 'srbac.views.authitem.footer', //可选,默认是
            // srbac.views.authitem.footer, 必须是一个存在的路径别名
            'showHeader' => true, //可选,默认是false
            'showFooter' => true, //可选,默认是false
            'alwaysAllowedPath' => 'srbac.components', //可选,默认是 srbac.components
        // 必须是一个存在的路径别名
        ),
    ),
    // application components
    'components' => array(
        'user' => array(
            // enable cookie-based authentication
            'class' => 'WebUser',
            //'allowAutoLogin' => true,
            'loginUrl' => array('/user/login'),
        ),
        'authManager' => array(
            // 'class'=>'CDbAuthManager',// Manager 的类型
            'class' => 'srbac.components.SDbAuthManager',
            'connectionID' => 'db', //使用的数据库组
            'itemTable' => 'auth_item', // 授权项目表 (默认:authitem)
            'assignmentTable' => 'auth_assignment', // 授权分配表 (默认:authassignment)
            'itemChildTable' => 'auth_item_child', // 授权子项目表 (默认:authitemchild)
        ),
        'bootstrap' => array(
            'class' => 'ext.bootstrap.components.Bootstrap',
            'responsiveCss' => true,
        ),
        // uncomment the following to enable URLs in path-format
        /*
          'urlManager'=>array(
          'urlFormat'=>'path',
          'rules'=>array(
          '<controller:\w+>/<id:\d+>'=>'<controller>/view',
          '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
          '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
          ),
          ),

          'db' => array(
          'connectionString' => 'sqlite:' . dirname(__FILE__) . '/../data/testdrive.db',
          ),
         * 
         */
        // uncomment the following to use a MySQL database

        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=yiibootstrap',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'tablePrefix' => '',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
             */
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'asuper114@gmail.com',
    ),
);