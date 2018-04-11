<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Doctors Model
 *
 * @property \App\Model\Table\SpecialitiesTable|\Cake\ORM\Association\BelongsTo $Specialities
 * @property \App\Model\Table\StatesTable|\Cake\ORM\Association\BelongsTo $States
 * @property \App\Model\Table\CitiesTable|\Cake\ORM\Association\BelongsTo $Cities
 * @property \App\Model\Table\DoctorsRelationTable|\Cake\ORM\Association\HasMany $DoctorsRelation
 * @property \App\Model\Table\WorkPlansTable|\Cake\ORM\Association\HasMany $WorkPlans
 * @property \App\Model\Table\WorkReportsTable|\Cake\ORM\Association\HasMany $WorkReports
 *
 * @method \App\Model\Entity\Doctor get($primaryKey, $options = [])
 * @method \App\Model\Entity\Doctor newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Doctor[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Doctor|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Doctor patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Doctor[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Doctor findOrCreate($search, callable $callback = null, $options = [])
 */
class PgOthersTable extends Table
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

        $this->setTable('pg_others');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Specialities', [
            'foreignKey' => 'speciality_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('States', [
            'foreignKey' => 'state_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Cities', [
            'foreignKey' => 'city_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('WorkPlans', [
            'foreignKey' => 'pgother_id'
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'user_id'
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
            ->scalar('code')
            ->allowEmpty('code');

        $validator
            ->scalar('name')
            ->requirePresence('name', 'create')
            ->notEmpty('name');

		$validator
            ->scalar('add_qualification')
            ->allowEmpty('add_qualification');
			
        $validator
            ->scalar('speciality_id')
            ->requirePresence('speciality_id', 'create')
            ->notEmpty('speciality_id');

        $validator
            ->scalar('clinic_name')
            ->allowEmpty('clinic_name');
			
        $validator
            ->scalar('door_no')
            ->allowEmpty('door_no');
			
        $validator
            ->scalar('street')
            ->allowEmpty('street');
			
        $validator
            ->scalar('area')
            ->allowEmpty('area');

			
        $validator
            ->date('dob')
            ->allowEmpty('dob');
			
        $validator
            ->date('dow')
            ->allowEmpty('dow');

        $validator
            ->scalar('state_id')
            ->requirePresence('state_id', 'create')
            ->notEmpty('state_id');

		$validator
            ->scalar('city_id')
            ->requirePresence('city_id', 'create')
            ->notEmpty('city_id');
			
        $validator
            ->integer('is_deleted')
            ->allowEmpty('is_deleted');

        $validator
            ->dateTime('last_updated')
            ->allowEmpty('last_updated');

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
        $rules->add($rules->existsIn(['speciality_id'], 'Specialities'));
        $rules->add($rules->existsIn(['state_id'], 'States'));
        $rules->add($rules->existsIn(['city_id'], 'Cities'));
		$rules->add($rules->isUnique(['email']));

        return $rules;
    }
}
