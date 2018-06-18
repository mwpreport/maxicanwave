<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CityDistances Model
 * @property \App\Model\Table\CitiesTable|\Cake\ORM\Association\BelongsTo $Cities
 *
 * @method \App\Model\Entity\CityDistance get($primaryKey, $options = [])
 * @method \App\Model\Entity\CityDistance newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CityDistance[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CityDistance|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CityDistance patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CityDistance[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CityDistance findOrCreate($search, callable $callback = null, $options = [])
 */
class CityDistancesTable extends Table
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

        $this->setTable('city_distances');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('CitiesFrom', [
            'foreignKey' => 'city_from',
            'joinType' => 'INNER',
            'className' => 'Cities'
        ]);

        $this->belongsTo('CitiesTo', [
            'foreignKey' => 'city_to',
            'joinType' => 'INNER',
            'className' => 'Cities'
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
            ->integer('city_from')
            ->requirePresence('city_from', 'create')
            ->notEmpty('city_from');

        $validator
            ->integer('city_to')
            ->requirePresence('city_to', 'create')
            ->notEmpty('city_to');

        $validator
            ->integer('km')
            ->requirePresence('km', 'create')
            ->notEmpty('km');

        return $validator;
    }
}
