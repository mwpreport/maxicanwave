<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OtherExpenses Model
 *
 * @property \App\Model\Table\ExpensesTable|\Cake\ORM\Association\BelongsTo $Expenses
 *
 * @method \App\Model\Entity\OtherExpense get($primaryKey, $options = [])
 * @method \App\Model\Entity\OtherExpense newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\OtherExpense[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OtherExpense|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OtherExpense patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\OtherExpense[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\OtherExpense findOrCreate($search, callable $callback = null, $options = [])
 */
class OtherExpensesTable extends Table
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

        $this->setTable('other_expenses');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Expenses', [
            'foreignKey' => 'expense_id',
        ]);

        $this->belongsTo('OtherAllowances', [
            'foreignKey' => 'other_allowance_id',            
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
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        $validator
            ->integer('fare')
            ->requirePresence('fare', 'create')
            ->notEmpty('fare');

        $validator
            ->integer('voucher_no')
            ->requirePresence('voucher_no', 'create')
            ->notEmpty('voucher_no');

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
        $rules->add($rules->existsIn(['expense_id'], 'Expenses'));

        return $rules;
    }
}
