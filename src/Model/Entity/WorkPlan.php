<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * WorkPlan Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $work_type_id
 * @property \Cake\I18n\FrozenTime $start_date
 * @property \Cake\I18n\FrozenTime $end_date
 * @property int $city_id
 * @property int $doctor_id
 * @property string $plan_reason
 * @property string $plan_details
 * @property int $is_completed
 * @property int $is_deleted
 * @property \Cake\I18n\FrozenTime $dt
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\WorkType $work_type
 * @property \App\Model\Entity\City $city
 * @property \App\Model\Entity\Doctor $doctor
 */
class WorkPlan extends Entity
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
        'long_plan' => true,
        'start_date' => true,
        'end_date' => true,
        'city_id' => true,
        'doctor_id' => true,
        'chemist_id' => true,
        'plan_reason' => true,
        'plan_details' => true,
        'is_completed' => true,
        'is_deleted' => true,
        'dt' => true,
        'user' => true,
        'work_type' => true,
        'city' => true,
        'doctor' => true
    ];
}
