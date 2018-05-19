<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Stockists Model
 *
 * @property \App\Model\Table\StatesTable|\Cake\ORM\Association\BelongsTo $States
 * @property \App\Model\Table\CitiesTable|\Cake\ORM\Association\BelongsTo $Cities
 * @property \App\Model\Table\StockistsRelationTable|\Cake\ORM\Association\HasMany $StockistsRelation
 *
 * @method \App\Model\Entity\Stockist get($primaryKey, $options = [])
 * @method \App\Model\Entity\Stockist newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Stockist[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Stockist|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Stockist patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Stockist[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Stockist findOrCreate($search, callable $callback = null, $options = [])
 */
class StockistsTable extends Table
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

        $this->setTable('stockists');
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
            ->scalar('contact_person')
            ->requirePresence('contact_person', 'create')
            ->notEmpty('contact_person');

        $validator
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->requirePresence('mobile', 'create')
            ->notEmpty('mobile');

        $validator
            ->requirePresence('phone', 'create')
            ->allowEmpty('phone');

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
            ->integer('pincode')
            ->requirePresence('pincode', 'create')
            ->notEmpty('pincode');

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
        $rules->add($rules->existsIn(['state_id'], 'States'));
        $rules->add($rules->existsIn(['city_id'], 'Cities'));
		$rules->add($rules->isUnique(['email']));

        return $rules;
    }
}
