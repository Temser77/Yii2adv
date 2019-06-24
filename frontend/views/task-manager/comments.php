<?php

use yii\helpers\Html;
/* @var $model common\models\tables\Comments */
$previewImgPath = Yii::getAlias('@domain') . "/frontend/web/comments-img/small/" . $model->uploaded_file_path;
$ImgPath = Yii::getAlias('@domain') . "/frontend/web/comments-img/" . $model->uploaded_file_path;
?>


<div class="media">
    <div class="comment">
        <a href="#" class="pull-left">
            <img src="http://bootstraptema.ru/snippets/element/2016/comments/com-1.jpg" alt=""
                 class="img-circle">
        </a>
        <div class="media-body">
            <strong class="text-success"><?=$model->creator->username?></strong>
            <span class="text-muted">
 <small class="text-muted"><?=$model->created?></small>
 </span>
            <p>
                <?=$model->description?>
            </p>
            <a data-fancybox="gallery" href="<?=$ImgPath?>">
                <img class="img-fluid" src="<?=$previewImgPath?>" alt="<?=$model->uploaded_file_path?>">
            </a>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<img src="" alt="">