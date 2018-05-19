<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DoctorsRelation Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\DoctorsTable|\Cake\ORM\Association\BelongsTo $Doctors
 *
 * @method \App\Model\Entity\DoctorsRelation get($primaryKey, $options = [])
 * @method \App\Model\Entity\DoctorsRelation newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\DoctorsRelation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DoctorsRelation|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DoctorsRelation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DoctorsRelation[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\DoctorsRelation findOrCreate($search, callable $callback = null, $options = [])
 */
class DoctorsRelationTable extends Table
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

        $this->setTable('doctors_relation');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Doctors', [
            'foreignKey' => 'doctor_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('DoctorTypes', [
            'foreignKey' => 'class',
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
            ->integer('class')
            ->requirePresence('class', 'create')
            ->notEmpty('class');

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
        $rules->add($rules->existsIn(['doctor_id'], 'Doctors'));

        return $rules;
    }
}
