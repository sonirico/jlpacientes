<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Initial extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '255',
                        ),
                        'surname' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '255',
                                'null' => TRUE
                        ),
                        'diagnosis' => array(
                                'type' => 'TEXT',
                                'null' => TRUE
                        ),
                        'stage' => array(
                                'type' => 'INT',
                                'constraint' => 5,
                                'unsigned' => TRUE
                        ),
                        'position' => array(
                                'type' => 'INT',
                                'constraint' => 5,
                                'unsigned' => TRUE
                        )
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('patient');
        }

        public function down()
        {
                $this->dbforge->drop_table('patient');
        }
}