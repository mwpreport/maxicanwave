<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * WorkPlanSubmit Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\LeadsTable|\Cake\ORM\Association\BelongsTo $Leads
 *
 * @method \App\Model\Entity\WorkPlanSubmit get($primaryKey, $options = [])
 * @method \App\Model\Entity\WorkPlanSubmit newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\WorkPlanSubmit[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\WorkPlanSubmit|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\WorkPlanSubmit patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\WorkPlanSubmit[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\WorkPlanSubmit findOrCreate($search, callable $callback = null, $options = [])
 */
class WorkPlanSubmitTable extends Table
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

        $this->setTable('work_plan_submit');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'lead_id'
        ]);

        $this->hasOne('Expenses', [
            'foreignKey' => 'work_plan_submit_id'
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
            ->date('date')
			->requirePresence('date', 'create')
            ->notEmpty('date');

        $validator
            ->integer('user_id')
			->requirePresence('user_id', 'create')
            ->notEmpty('user_id');

        $validator
            ->integer('lead_id')
			->requirePresence('lead_id', 'create')
            ->notEmpty('lead_id');

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
        $rules->add($rules->existsIn(['lead_id'], 'Users'));

        return $rules;
    }
}
