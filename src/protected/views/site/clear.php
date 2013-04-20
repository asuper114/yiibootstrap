<?php if(Yii::app()->user->hasFlash('message')): ?>
<div class="notification success_w png_bg">
    <div>
    <?php echo Yii::app()->user->getFlash('message'); ?>
    </div>
</div>
<?php endif; ?>
<form method="post">
<button name="btn" value="clear" class="button">清空缓存</button>
</form>