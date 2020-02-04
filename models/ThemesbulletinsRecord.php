<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "themesbulletins".
 *
 * @property int $id
 * @property int $bulletins_id
 * @property int $themes_id
 *
 * @property Bulletins $bulletins
 * @property Themes $themes
 */
class ThemesbulletinsRecord extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'themesbulletins';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bulletins_id', 'themes_id'], 'required'],
            [['bulletins_id', 'themes_id'], 'integer'],
            [['bulletins_id'], 'exist', 'skipOnError' => true, 'targetClass' => BulletinsRecord::className(), 'targetAttribute' => ['bulletins_id' => 'id']],
            [['themes_id'], 'exist', 'skipOnError' => true, 'targetClass' => ThemesRecord::className(), 'targetAttribute' => ['themes_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bulletins_id' => 'Bulletins ID',
            'themes_id' => 'Themes ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBulletins()
    {
        return $this->hasOne(BulletinsRecord::className(), ['id' => 'bulletins_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getThemes()
    {
        return $this->hasOne(ThemesRecord::className(), ['id' => 'themes_id']);
    }
}
