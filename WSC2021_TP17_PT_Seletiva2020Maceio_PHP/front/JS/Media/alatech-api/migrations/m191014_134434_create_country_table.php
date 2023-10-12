<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%country}}`.
 */
class m191014_134434_create_country_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%country}}', [
            'code' => $this->string(2),
            'name' => $this->string(64)->notNull()->unique(),
            'population' => $this->integer(),
            'deleted' => $this->boolean()->defaultValue(false)->notNull(),
            'PRIMARY KEY (code)'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%country}}');
    }
}
