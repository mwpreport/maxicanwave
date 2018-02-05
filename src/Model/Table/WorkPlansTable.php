<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * WorkPlans Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\WorkTypesTable|\Cake\ORM\Association\BelongsTo $WorkTypes
 * @property \App\Model\Table\CitiesTable|\Cake\ORM\Association\BelongsTo $Cities
 * @property \App\Model\Table\DoctorsTable|\Cake\ORM\Association\BelongsTo $Doctors
 *
 * @method \App\Model\Entity\WorkPlan get($primaryKey, $options = [])
 * @method \App\Model\Entity\WorkPlan newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\WorkPlan[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\WorkPlan|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\WorkPlan patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\WorkPlan[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\WorkPlan findOrCreate($search, callable $callback = null, $options = [])
 */
class WorkPlansTable extends Table
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

        $this->setTable('work_plans');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('WorkTypes', [
            'foreignKey' => 'work_type_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Cities', [
            'foreignKey' => 'city_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Doctors', [
            'foreignKey' => 'doctor_id',
            'joinType' => 'LEFT'
        ]);
        $this->belongsTo('Chemists', [
            'foreignKey' => 'chemist_id',
            'joinType' => 'LEFT'
        ]);
        $this->belongsTo('Stockists', [
            'foreignKey' => 'stockist_id',
            'joinType' => 'LEFT'
        ]);
        $this->belongsTo('LeaveTypes', [
            'foreignKey' => 'plan_reason',
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
            ->dateTime('start_date')
            ->requirePresence('start_date', 'create')
            ->notEmpty('start_date');

        $validator
            ->dateTime('end_date')
            ->requirePresence('end_date', 'create')
            ->notEmpty('end_date');

        $validator
            ->scalar('plan_reason')
            ->allowEmpty('plan_reason');

        $validator
            ->scalar('plan_details')
            ->allowEmpty('plan_details');

        $validator
            ->integer('is_completed')
            ->allowEmpty('is_completed');

        $validator
            ->integer('is_deleted')
            ->allowEmpty('is_deleted');

        $validator
            ->dateTime('dt')
            ->allowEmpty('dt');

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
        $rules->add($rules->existsIn(['work_type_id'], 'WorkTypes'));
        $rules->add($rules->existsIn(['city_id'], 'Cities'));
        $rules->add($rules->existsIn(['doctor_id'], 'Doctors'));
        $rules->add($rules->existsIn(['plan_reason'], 'LeaveTypes'));

        return $rules;
    }
}
