<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%userinfo}}`.
 */
class m200102_140749_create_userinfo_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%userinfo}}', [
            'id' => $this->primaryKey(),
            'user_id'=>$this->integer(),
            'surname'=>$this->string(),
            'name'=>$this->string(),
            'middlename'=>$this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%userinfo}}');
    }
}
