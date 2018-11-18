<?php
namespace app\models;
$this->title = 'My Yii Application';
?>
<div class="jumbotron">
    <!--<p>
        <?= \yii\helpers\Html::a('Вход','/web/site/login',['class' => 'btn btn-success']) ?>
    </p>-->
    <?php
        if(!\Yii::$app->user->isGuest)
            echo '<h2>Для создания нового документа, нажмите кнопку "Дела" в правом верхнем углу страницы</h2>';
        else
            echo '<h2>Для начала работы, авторизуйтесь в системе нажатием кнопки "Вход" в правом верхнем углу страницы</h2>';
        ?>
    <?php
//    $user_id = \Yii::$app->user->identity->getId();
  //  $user_dn = User::findOne($user_id);
    //$email = $user_dn->displayname;
    //echo $email;
    ?>
</div>