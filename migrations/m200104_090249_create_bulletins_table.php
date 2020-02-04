<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%bulletins}}`.
 */
class m200104_090249_create_bulletins_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%bulletins}}', [
            'id' => $this->primaryKey(),
            'user_id'=> $this->integer()->notNull(),
            'date_pub'=>$this->dateTime(),
            'title'=>$this->string(),
            'info'=>$this->string(),
            'contacts'=>$this->string(),
            'city'=>$this->string(),
            'price'=>$this->double(),
            'status'=>$this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%bulletins}}');
    }
}
