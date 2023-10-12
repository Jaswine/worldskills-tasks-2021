<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m191014_131530_Initial_Migration
 */
class m191014_131530_Initial_Migration extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        //
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191014_131530_Initial_Migration cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191014_131530_Initial_Migration cannot be reverted.\n";

        return false;
    }
    */
}
