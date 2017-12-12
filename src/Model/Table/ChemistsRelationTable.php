<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ChemistsRelation Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\ChemistsTable|\Cake\ORM\Association\BelongsTo $Chemists
 *
 * @method \App\Model\Entity\ChemistsRelation get($primaryKey, $options = [])
 * @method \App\Model\Entity\ChemistsRelation newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ChemistsRelation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ChemistsRelation|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ChemistsRelation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ChemistsRelation[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ChemistsRelation findOrCreate($search, callable $callback = null, $options = [])
 */
class ChemistsRelationTable extends Table
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

        $this->setTable('chemists_relation');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Chemists', [
            'foreignKey' => 'chemist_id',
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
            ->allowEmpty('class');

        $validator
            ->integer('is_active')
            ->requirePresence('is_active', 'create')
            ->notEmpty('is_active');

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
        $rules->add($rules->existsIn(['chemist_id'], 'Chemists'));

        return $rules;
    }
}
