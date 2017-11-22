<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * WorkReports Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\WorkTypesTable|\Cake\ORM\Association\BelongsTo $WorkTypes
 * @property \App\Model\Table\PlansTable|\Cake\ORM\Association\BelongsTo $Plans
 * @property \App\Model\Table\CitiesTable|\Cake\ORM\Association\BelongsTo $Cities
 * @property \App\Model\Table\DoctorsTable|\Cake\ORM\Association\BelongsTo $Doctors
 *
 * @method \App\Model\Entity\WorkReport get($primaryKey, $options = [])
 * @method \App\Model\Entity\WorkReport newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\WorkReport[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\WorkReport|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\WorkReport patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\WorkReport[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\WorkReport findOrCreate($search, callable $callback = null, $options = [])
 */
class WorkReportsTable extends Table
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

        $this->setTable('work_reports');
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
        $this->belongsTo('Plans', [
            'foreignKey' => 'plan_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Cities', [
            'foreignKey' => 'city_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Doctors', [
            'foreignKey' => 'doctor_id',
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
            ->date('strart_date')
            ->requirePresence('strart_date', 'create')
            ->notEmpty('strart_date');

        $validator
            ->scalar('report_details')
            ->requirePresence('report_details', 'create')
            ->notEmpty('report_details');

        $validator
            ->integer('is_missed')
            ->requirePresence('is_missed', 'create')
            ->notEmpty('is_missed');

        $validator
            ->integer('is_completed')
            ->requirePresence('is_completed', 'create')
            ->notEmpty('is_completed');

        $validator
            ->integer('is_deleted')
            ->requirePresence('is_deleted', 'create')
            ->notEmpty('is_deleted');

        $validator
            ->dateTime('dt')
            ->requirePresence('dt', 'create')
            ->notEmpty('dt');

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
        $rules->add($rules->existsIn(['plan_id'], 'Plans'));
        $rules->add($rules->existsIn(['city_id'], 'Cities'));
        $rules->add($rules->existsIn(['doctor_id'], 'Doctors'));

        return $rules;
    }
}
