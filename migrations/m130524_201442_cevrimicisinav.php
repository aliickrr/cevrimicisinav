<?php

use yii\db\Schema;
use yii\db\Migration;

class m130524_201442_cevrimicisinav extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%cevrimicisinavs}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(200)->notNull(),
			'description' => $this->text()->notNull(),
            'picture' => $this->text(),
        ], $tableOptions);

        $this->createTable('{{%cevrimicisinav_data}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'cevrimicisinav_id' => $this->integer(11)->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx_cevrimicisinav_data_cevrimicisinav_id-1',
            'cevrimicisinav_data',
            'cevrimicisinav_id'
        );

        $this->addForeignKey(
          'fk_cevrimicisinav_data_cevrimicisinav_id-1',
          'cevrimicisinav_data',
          'cevrimicisinav_id',
          'cevrimicisinavs',
          'id'
        );

    }

    public function down()
    {
        $this->dropForeignKey('fk_cevrimicisinav_data_cevrimicisinav_id-1','cevrimicisinav_data');
        $this->dropIndex('idx_cevrimicisinav_data_cevrimicisinav_id-1','cevrimicisinav_data');
        $this->dropTable('{{%cevrimicisinav_data}}');
        $this->dropTable('{{%cevrimicisinavs}}');
    }
}
