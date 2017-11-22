<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * WorkTypes Model
 *
 * @property \App\Model\Table\WorkPlansTable|\Cake\ORM\Association\HasMany $WorkPlans
 * @property \App\Model\Table\WorkReportsTable|\Cake\ORM\Association\HasMany $WorkReports
 *
 * @method \App\Model\Entity\WorkType get($primaryKey, $options = [])
 * @method \App\Model\Entity\WorkType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\WorkType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\WorkType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\WorkType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\WorkType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\WorkType findOrCreate($search, callable $callback = null, $options = [])
 */
class WorkTypesTable extends Table
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

        $this->setTable('work_types');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('WorkPlans', [
            'foreignKey' => 'work_type_id'
        ]);
        $this->hasMany('WorkReports', [
            'foreignKey' => 'work_type_id'
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
            ->scalar('color')
            ->requirePresence('color', 'create')
            ->notEmpty('color');

        return $validator;
    }
}
