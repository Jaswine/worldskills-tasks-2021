<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%city}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%country}}`
 */
class m191014_134550_create_city_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%city}}', [
            'code' => $this->string(2),
            'name' => $this->string(64)->notNull()->unique(),
            'country_code' => $this->string(2)->notNull(),
            'PRIMARY KEY (code)'
        ]);

        // creates index for column `country_code`
        $this->createIndex(
            '{{%idx-city-country_code}}',
            '{{%city}}',
            'country_code'
        );

        // add foreign key for table `{{%country}}`
        $this->addForeignKey(
            '{{%fk-city-country_code}}',
            '{{%city}}',
            'country_code',
            '{{%country}}',
            'code',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%country}}`
        $this->dropForeignKey(
            '{{%fk-city-country_code}}',
            '{{%city}}'
        );

        // drops index for column `country_code`
        $this->dropIndex(
            '{{%idx-city-country_code}}',
            '{{%city}}'
        );

        $this->dropTable('{{%city}}');
    }
}
