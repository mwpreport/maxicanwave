<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AssignedGifts Model
 *
 * @property \App\Model\Table\GiftsTable|\Cake\ORM\Association\BelongsTo $Gifts
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\AssignedGift get($primaryKey, $options = [])
 * @method \App\Model\Entity\AssignedGift newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AssignedGift[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AssignedGift|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AssignedGift patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AssignedGift[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AssignedGift findOrCreate($search, callable $callback = null, $options = [])
 */
class AssignedGiftsTable extends Table
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

        $this->setTable('assigned_gifts');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Gifts', [
            'foreignKey' => 'gift_id'
        ]);
        $this->belongsTo('Users', [
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
            ->allowEmpty('id', 'create');

        $validator
            ->integer('gift_id')
            ->requirePresence('gift_id', 'create')
            ->notEmpty('gift_id');
        $validator
            ->integer('user_id')
            ->requirePresence('user_id', 'create')
            ->notEmpty('user_id');
        $validator
            ->integer('count')
            ->requirePresence('count', 'create')
            ->notEmpty('count');


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
        $rules->add($rules->existsIn(['gift_id'], 'Gifts'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
