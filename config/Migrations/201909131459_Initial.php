<?php

use Authentication\PasswordHasher\DefaultPasswordHasher;
use Migrations\AbstractMigration;

class Initial extends AbstractMigration {

    protected $now;

    public function up() {

        $this->now = $this->fetchRow('select now();')[0];

        $this->groupsUp();
        $this->usersUp();
    }

    protected function groupsUp() {
        $this->table('groups')
            ->addColumn('name', 'string', [
                'limit' => 100,
                'null' => false
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true
            ])
            ->insert([
                [
                    'id' => 1,
                    'name' => 'Admin',
                    'modified' => $this->now,
                    'created' => $this->now
                ]
            ])
            ->save();
    }

    protected function usersUp() {

        $this->table('users')
            ->addColumn('first_name', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => false,
            ])
            ->addColumn('last_name', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => true,
            ])
            ->addColumn('email', 'string', [
                'limit' => 50,
                'null' => false,
            ])
            ->addColumn('password', 'string', [
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('group_id', 'integer', [
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('enabled', 'boolean', [
                'default' => false,
                'null' => false,
            ])
            ->addColumn('force_password_change', 'boolean', [
                'default' => false,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addForeignKey('group_id', 'groups', 'id', [
                'delete' => 'CASCADE'
            ])
            ->insert([
                [
                    'id' => 1,
                    'first_name' => 'Default admin',
                    'email' => 'admin@blah.co.uk',
                    'password' => (new DefaultPasswordHasher)->hash('password'),
                    'group_id' => 1,
                    'enabled' => 1,
                    'modified' => $this->now,
                    'created' => $this->now
                ]
            ])
            ->save();
    }

    public function down() {

        $this->table('users')->drop()->save();
        $this->table('groups')->drop()->save();
    }
}
