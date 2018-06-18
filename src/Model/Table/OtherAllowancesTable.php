<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OtherAllowances Model
 *
 * @method \App\Model\Entity\OtherAllowance get($primaryKey, $options = [])
 * @method \App\Model\Entity\OtherAllowance newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\OtherAllowance[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OtherAllowance|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OtherAllowance patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\OtherAllowance[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\OtherAllowance findOrCreate($search, callable $callback = null, $options = [])
 */
class OtherAllowancesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('other_allowances');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('name')
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        return $validator;
    }
}
