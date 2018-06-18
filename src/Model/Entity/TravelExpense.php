<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TravelExpense Entity
 *
 * @property int $id
 * @property int $expense_id
 * @property int $city_from
 * @property int $city_to
 * @property int $km
 * @property int $fare
 * @property string $travel_mode
 * @property \Cake\I18n\FrozenTime $started
 * @property \Cake\I18n\FrozenTime $reached
 *
 * @property \App\Model\Entity\Expense $expense
 */
class TravelExpense extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'expense_id' => true,
        'work_type_id' => true,
        'city_from' => true,
        'city_to' => true,
        'km' => true,
        'fare' => true,
        'travel_mode' => true,        
        'expense' => true,
        'city' => true
    ];
}
