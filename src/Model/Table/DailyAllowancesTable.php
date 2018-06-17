<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DailyAllowances Model
 *
 * @property \App\Model\Table\ExpenseTypesTable|\Cake\ORM\Association\BelongsTo $ExpenseTypes
 * @property \App\Model\Table\RolesTable|\Cake\ORM\Association\BelongsTo $Roles
 *
 * @method \App\Model\Entity\DailyAllowance get($primaryKey, $options = [])
 * @method \App\Model\Entity\DailyAllowance newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\DailyAllowance[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DailyAllowance|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DailyAllowance patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DailyAllowance[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\DailyAllowance findOrCreate($search, callable $callback = null, $options = [])
 */
class DailyAllowancesTable extends Table
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

        $this->setTable('daily_allowances');
        $this->setDisplayField('cost');
        $this->setPrimaryKey('id');

        $this->belongsTo('ExpenseTypes', [
            'foreignKey' => 'expense_type_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
            'joinType' => 'INNER'
        ]);
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
            ->integer('expense_type_id')
            ->requirePresence('expense_type_id', 'create')
            ->notEmpty('expense_type_id');

        $validator
            ->integer('role_id')
            ->requirePresence('role_id', 'create')
            ->notEmpty('role_id');

        $validator
            ->integer('cost')
            ->requirePresence('cost', 'create')
            ->notEmpty('cost');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['expense_type_id'], 'ExpenseTypes'));
        $rules->add($rules->existsIn(['role_id'], 'Roles'));

        return $rules;
    }
}
