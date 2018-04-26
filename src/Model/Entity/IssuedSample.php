<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * IssuedSample Entity
 *
 * @property int $id
 * @property int $product_id
 * @property int $user_id
 * @property int $doctor_id
 * @property int $plan_id
 * @property int $count
 * @property \Cake\I18n\FrozenTime $dt
 *
 * @property \App\Model\Entity\Product $product
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Doctor $doctor
 */
class IssuedSample extends Entity
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
        '*' => true
    ];
}
