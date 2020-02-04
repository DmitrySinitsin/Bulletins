<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%themesbulletins}}`.
 */
class m200112_133621_create_themesbulletins_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%themesbulletins}}', [
            'id' => $this->primaryKey(),
            'bulletins_id' => $this->integer()->notNull(),
            'themes_id' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey('chain_to_bulletins',
                             '{{%themesbulletins}}',
                             'bulletins_id',
                             'bulletins',
                             'id',
                             'CASCADE'
                             );
        $this->addForeignKey('chain_to_themes',
                             '{{%themesbulletins}}',
                             'themes_id',
                             'themes',
                             'id',
                             'CASCADE'
                             );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%themesbulletins}}');
    }
}
