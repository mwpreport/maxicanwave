<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * WorkReport Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $work_type_id
 * @property \Cake\I18n\FrozenDate $plan_id
 * @property \Cake\I18n\FrozenDate $strart_date
 * @property int $city_id
 * @property int $doctor_id
 * @property string $report_details
 * @property int $is_missed
 * @property int $is_completed
 * @property int $is_deleted
 * @property \Cake\I18n\FrozenTime $dt
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\WorkType $work_type
 * @property \App\Model\Entity\Plan $plan
 * @property \App\Model\Entity\City $city
 * @property \App\Model\Entity\Doctor $doctor
 */
class WorkReport extends Entity
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
        'work_type_id' => true,
        'plan_id' => true,
        'strart_date' => true,
        'city_id' => true,
        'doctor_id' => true,
        'report_details' => true,
        'is_missed' => true,
        'is_completed' => true,
        'is_deleted' => true,
        'dt' => true,
        'user' => true,
        'work_type' => true,
        'plan' => true,
        'city' => true,
        'doctor' => true
    ];
}
