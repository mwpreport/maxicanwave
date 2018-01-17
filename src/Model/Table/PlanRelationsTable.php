<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PlanRelations Model
 *
 * @property \App\Model\Table\WorkPlansTable|\Cake\ORM\Association\BelongsTo $WorkPlans
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\DoctorsTable|\Cake\ORM\Association\BelongsTo $Doctors
 *
 * @method \App\Model\Entity\PlanRelation get($primaryKey, $options = [])
 * @method \App\Model\Entity\PlanRelation newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PlanRelation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PlanRelation|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PlanRelation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PlanRelation[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PlanRelation findOrCreate($search, callable $callback = null, $options = [])
 */
class PlanRelationsTable extends Table
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

        $this->setTable('plan_relations');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('WorkPlans', [
            'foreignKey' => 'plan_id'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
        ]);
        $this->belongsTo('Doctors', [
            'foreignKey' => 'doctor_id'
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
            ->allowEmpty('id', 'create');

        $validator
            ->integer('is_missedcall')
             ->allowEmpty('is_missedcall');

        $validator
            ->integer('is_missed')
            ->allowEmpty('is_missed');

        $validator
            ->integer('is_unplanned')
            ->allowEmpty('is_unplanned');

        $validator
            ->integer('work_with')
            ->allowEmpty('work_with');

        $validator
            ->scalar('reason')
            ->allowEmpty('reason');

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
        $rules->add($rules->existsIn(['plan_id'], 'WorkPlans'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['doctor_id'], 'Doctors'));

        return $rules;
    }
}
