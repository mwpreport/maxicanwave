<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PlanRelation Entity
 *
 * @property int $id
 * @property int $plan_id
 * @property int $user_id
 * @property int $doctor_id
 * @property int $is_missedcall
 * @property int $is_missed
 * @property int $is_unplanned
 * @property int $work_with
 * @property string $reason
 * @property \Cake\I18n\FrozenTime $dt
 *
 * @property \App\Model\Entity\WorkPlan $work_plan
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Doctor $doctor
 */
class PlanRelation extends Entity
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
        'plan_id' => true,
        'user_id' => true,
        'doctor_id' => true,
        'is_missedcall' => true,
        'is_missed' => true,
        'is_unplanned' => true,
        'work_with' => true,
        'reason' => true,
        'dt' => true,
        'work_plan' => true,
        'user' => true,
        'doctor' => true
    ];
}
