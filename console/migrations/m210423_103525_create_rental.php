<?php

use yii\db\Migration;

/**
 * Class m210423_103525_create_rental
 */
class m210423_103525_create_rental extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210423_103525_create_rental cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('rental', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'name' => $this->string(),
            'price' => $this->decimal(15, 2),
            'city' => $this->string(),
            'coordinate' => $this->text(),
        ]);

    }

    public function down()
    {
        echo "m210423_103525_create_rental cannot be reverted.\n";
        $this->dropTable('rental');

        return false;
    }

}
