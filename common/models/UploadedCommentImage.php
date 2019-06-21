<?php
/**
 * Created by PhpStorm.
 * User: post.user14
 * Date: 07.06.2019
 * Time: 15:03
 */

namespace common\models;
use common\models\tables\Comments;
use yii\base\Model;
use yii\web\UploadedFile;
use Yii;
use yii\imagine\Image;


class UploadedCommentImage extends Model
{
    /**
     * @var UploadedFile file attribute
     */
    public $file;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['file'], 'file', 'extensions' => 'gif, jpg, png, bmp', 'maxSize' => 1024 * 1024 * 2],
        ];
    }

    /**
     * @var $model Comments model
     * @var $attribute string attribute
     * @return string uploaded filename;
     */
    public function uploadCommentImg($model, $attribute)
    {
        $this->file = UploadedFile::getInstance($model, $attribute);
        if ($this->file) {
            if (!$this->validate()) {
                Yii::$app->session->setFlash('commentImgNotValidate', "Загружать можно только картинки размером не более 2Мб");
                return false;
            } else {
                $filename = $this->file->name;
                $filePath = Yii::getAlias("@commentsImg/$filename");
                $this->file->saveAs($filePath);
                Image::thumbnail($filePath, null, 100)
                    ->save(Yii::getAlias("@commentsImg/small/$filename"), ['quality' => 90]);
                return $this->file->name;
            }
        } else {
            return false;
        }
    }
}
