<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ExpenseTypes Model
 *
 * @property \App\Model\Table\DailyAllowancesTable|\Cake\ORM\Association\HasMany $DailyAllowances
 *
 * @method \App\Model\Entity\ExpenseType get($primaryKey, $options = [])
 * @method \App\Model\Entity\ExpenseType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ExpenseType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ExpenseType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ExpenseType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ExpenseType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ExpenseType findOrCreate($search, callable $callback = null, $options = [])
 */
class ExpenseTypesTable extends Table
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

        $this->setTable('expense_types');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('DailyAllowances', [
            'foreignKey' => 'expense_type_id'
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
            ->scalar('name')
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        return $validator;
    }
}
