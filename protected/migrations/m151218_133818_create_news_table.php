<?php

class m151218_133818_create_news_table extends CDbMigration {

//	public function up()
//	{
//	}
//
//	public function down()
//	{
//		echo "m151218_133818_create_news_table does not support migration down.\n";
//		return false;
//	}
//	
//	## Using Trasaction
//    public function up() {
//        $transaction = $this->getDbConnection()->beginTransaction();
//        try {
//            $this->createTable('tbl_news', array(
//                'id' => 'pk',
//                'title' => 'string NOT NULL',
//                'content' => 'text',
//            ));
//            $transaction->commit();
//        } catch (Exception $e) {
//            echo "Exception: " . $e->getMessage() . "\n";
//            $transaction->rollback();
//            return false;
//        }
//    }
//
//    ## we can do same for the down
//
//    public function down() {
//        $this->dropTable('tbl_news');
//    }

    /*
      // Use safeUp/safeDown to do migration with transaction
     * However, an easier way to get transaction support is to implement the safeUp() method instead of up(), and safeDown() instead of down(). 
      public function safeUp()
      {
      }

      public function safeDown()
      {
      }
     */
    ## safe method default use transaction if any error occur then it roll back every thing 
    public function safeUp() {
        $this->createTable('tbl_news', array(
            'id' => 'pk',
            'title' => 'string NOT NULL',
            'content' => 'text',
        ));
        $this->_addColumn('tbl_news', 'desc', 'text');
    }

    public function safeDown() {
        $this->dropTable('tbl_news');
    }
    /**

     * 
     * @param type $table : name of the table
     * @param type $column : nsme of the column
     * @param type $type   datatype of the column  /
     */
    public function _addColumn($table, $column, $type) {

        // Fetch the table schema
        $table_to_check = Yii::app()->db->schema->getTable($table);
        if (!isset($table_to_check->columns[$column])) {
            $this->addColumn($table, $column, $type);
        }
    }
//    $this->_addColumn('table_name', 'column_name', 'varchar(255)');
//    public function columnAdd() {
//        $this->_addColumn('tbl_news', 'desc', 'text');
//    }
}
