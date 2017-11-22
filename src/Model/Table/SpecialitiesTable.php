<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Specialities Model
 *
 * @property \App\Model\Table\DoctorsTable|\Cake\ORM\Association\HasMany $Doctors
 *
 * @method \App\Model\Entity\Speciality get($primaryKey, $options = [])
 * @method \App\Model\Entity\Speciality newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Speciality[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Speciality|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Speciality patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Speciality[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Speciality findOrCreate($search, callable $callback = null, $options = [])
 */
class SpecialitiesTable extends Table
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

        $this->setTable('specialities');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Doctors', [
            'foreignKey' => 'speciality_id'
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
            ->scalar('name')
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->scalar('code')
            ->requirePresence('code', 'create')
            ->notEmpty('code');

        return $validator;
    }
}
