<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * DoctorsRelation Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $doctor_id
 * @property int $class
 * @property int $is_active
 * @property \Cake\I18n\FrozenTime $dt
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Doctor $doctor
 */
class DoctorsRelation extends Entity
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
        'user_id' => true,
        'doctor_id' => true,
        'class' => true,
        'is_active' => true,
        'dt' => true,
        'user' => true,
        'doctor' => true
    ];
}
