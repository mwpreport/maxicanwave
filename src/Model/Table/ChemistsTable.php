<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Chemists Model
 *
 * @property \App\Model\Table\StatesTable|\Cake\ORM\Association\BelongsTo $States
 * @property \App\Model\Table\CitiesTable|\Cake\ORM\Association\BelongsTo $Cities
 * @property \App\Model\Table\ChemistsRelationTable|\Cake\ORM\Association\HasMany $ChemistsRelation
 *
 * @method \App\Model\Entity\Chemist get($primaryKey, $options = [])
 * @method \App\Model\Entity\Chemist newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Chemist[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Chemist|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Chemist patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Chemist[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Chemist findOrCreate($search, callable $callback = null, $options = [])
 */
class ChemistsTable extends Table
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

        $this->setTable('chemists');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('States', [
            'foreignKey' => 'state_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Cities', [
            'foreignKey' => 'city_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('ChemistsRelation', [
            'foreignKey' => 'chemist_id'
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
            ->requirePresence('code', 'create')
            ->notEmpty('code');

        $validator
            ->scalar('name')
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->scalar('contact_person')
            ->requirePresence('contact_person', 'create')
            ->notEmpty('contact_person');

        $validator
            ->requirePresence('mobile', 'create')
            ->notEmpty('mobile');

        $validator
            ->requirePresence('phone', 'create')
            ->notEmpty('phone');

        $validator
            ->integer('address')
            ->requirePresence('address', 'create')
            ->notEmpty('address');

        $validator
            ->integer('pincode')
            ->requirePresence('pincode', 'create')
            ->notEmpty('pincode');

        $validator
            ->integer('is_approved')
            ->requirePresence('is_approved', 'create')
            ->notEmpty('is_approved');

        $validator
            ->integer('is_active')
            ->requirePresence('is_active', 'create')
            ->notEmpty('is_active');

        $validator
            ->integer('is_deleted')
            ->requirePresence('is_deleted', 'create')
            ->notEmpty('is_deleted');

        $validator
            ->dateTime('last_updated')
            ->requirePresence('last_updated', 'create')
            ->notEmpty('last_updated');

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
        $rules->add($rules->existsIn(['state_id'], 'States'));
        $rules->add($rules->existsIn(['city_id'], 'Cities'));

        return $rules;
    }
}
