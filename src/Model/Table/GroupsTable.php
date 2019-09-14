<?php

namespace App\Model\Table;

use App\Model\Entity\Group;
use Cake\Datasource\EntityInterface;
use Cake\ORM\Association\HasMany;
use Cake\ORM\Behavior\TimestampBehavior;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Groups Model
 *
 * @property UsersTable&HasMany $Users
 *
 * @method Group get($primaryKey, $options = [])
 * @method Group newEntity($data = null, array $options = [])
 * @method Group[] newEntities(array $data, array $options = [])
 * @method Group|false save(EntityInterface $entity, $options = [])
 * @method Group saveOrFail(EntityInterface $entity, $options = [])
 * @method Group patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method Group[] patchEntities($entities, array $data, array $options = [])
 * @method Group findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin TimestampBehavior
 */
class GroupsTable extends Table {
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     *
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('groups');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Users')
            ->setForeignKey('group_id');
    }

    /**
     * Default validation rules.
     *
     * @param Validator $validator Validator instance.
     *
     * @return Validator
     */
    public function validationDefault(Validator $validator) {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        return $validator;
    }
}
