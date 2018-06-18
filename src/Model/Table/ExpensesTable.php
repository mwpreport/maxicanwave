<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Expenses Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\WorkPlanSubmitTable|\Cake\ORM\Association\BelongsTo $WorkPlanSubmit
 * @property \App\Model\Table\ExpenseTypesTable|\Cake\ORM\Association\BelongsTo $ExpenseTypes
 * @property \App\Model\Table\OtherExpensesTable|\Cake\ORM\Association\HasMany $OtherExpenses
 * @property \App\Model\Table\TravelExpensesTable|\Cake\ORM\Association\HasMany $TravelExpenses
 *
 * @method \App\Model\Entity\Expense get($primaryKey, $options = [])
 * @method \App\Model\Entity\Expense newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Expense[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Expense|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Expense patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Expense[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Expense findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ExpensesTable extends Table
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

        $this->setTable('expenses');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('WorkPlanSubmit', [
            'foreignKey' => 'work_plan_submit_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ExpenseTypes', [
            'foreignKey' => 'expense_type_id',            
        ]);
        $this->hasMany('OtherExpenses', [
            'foreignKey' => 'expense_id'
        ]);
        $this->hasMany('TravelExpenses', [
            'foreignKey' => 'expense_id'
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
            ->date('expense_date')
            ->requirePresence('expense_date', 'create')
            ->notEmpty('expense_date');

        $validator
            ->integer('daily_allowance')
            ->requirePresence('daily_allowance', 'create')
            ->notEmpty('daily_allowance');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['work_plan_submit_id'], 'WorkPlanSubmit'));
        $rules->add($rules->existsIn(['expense_type_id'], 'ExpenseTypes'));

        return $rules;
    }
}
