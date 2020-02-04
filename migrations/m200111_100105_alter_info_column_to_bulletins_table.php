<?php

use yii\db\Migration;

/**
 * Class m200111_100105_alter_info_column_to_bulletins_table
 */
class m200111_100105_alter_info_column_to_bulletins_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{bulletins}}', 'info', 'LONGTEXT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200111_100105_alter_info_column_to_bulletins_table cannot be reverted.\n";
        $this->alterColumn('{{bulletins}}', 'info', $this->string());
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200111_100105_alter_info_column_to_bulletins_table cannot be reverted.\n";

        return false;
    }
    */
}
