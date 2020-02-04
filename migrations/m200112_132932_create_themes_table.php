<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%themes}}`.
 */
class m200112_132932_create_themes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%themes}}', [
            'id' => $this->primaryKey(),
            'parental_id' => $this->integer()->defaultValue(0),
            'title' => $this->string(),
            'info' => 'LONGTEXT',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%themes}}');
    }
}
