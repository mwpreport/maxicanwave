<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * IssuedGifts Model
 *
 * @property \App\Model\Table\GiftsTable|\Cake\ORM\Association\BelongsTo $Gifts
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\DoctorsTable|\Cake\ORM\Association\BelongsTo $Doctors
 * @property \App\Model\Table\GiftsTable|\Cake\ORM\Association\BelongsTo $Gifts
 *
 * @method \App\Model\Entity\IssuedGift get($primaryKey, $options = [])
 * @method \App\Model\Entity\IssuedGift newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\IssuedGift[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\IssuedGift|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\IssuedGift patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\IssuedGift[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\IssuedGift findOrCreate($search, callable $callback = null, $options = [])
 */
class IssuedGiftsTable extends Table
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

        $this->setTable('issued_gifts');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Gifts', [
            'foreignKey' => 'gift_id'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
        ]);
        $this->belongsTo('Doctors', [
            'foreignKey' => 'doctor_id'
        ]);
        $this->belongsTo('Gifts', [
            'foreignKey' => 'plan_id',
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
            ->allowEmpty('id', 'create');

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
        $rules->add($rules->existsIn(['doctor_id'], 'Doctors'));
        $rules->add($rules->existsIn(['plan_id'], 'Gifts'));

        return $rules;
    }
}
