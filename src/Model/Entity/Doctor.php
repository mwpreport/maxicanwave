<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Doctor Entity
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property int $speciality_id
 * @property string $qualification
 * @property int $mobile
 * @property int $phone
 * @property int $address
 * @property int $state_id
 * @property int $city_id
 * @property int $pincode
 * @property int $is_approved
 * @property int $is_active
 * @property int $is_deleted
 * @property \Cake\I18n\FrozenTime $last_updated
 * @property \Cake\I18n\FrozenTime $dt
 *
 * @property \App\Model\Entity\Speciality $speciality
 * @property \App\Model\Entity\State $state
 * @property \App\Model\Entity\City $city
 * @property \App\Model\Entity\DoctorsRelation[] $doctors_relation
 * @property \App\Model\Entity\WorkPlan[] $work_plans
 * @property \App\Model\Entity\WorkReport[] $work_reports
 */
class Doctor extends Entity
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
        'code' => true,
        'name' => true,
        'speciality_id' => true,
        'qualification' => true,
        'mobile' => true,
        'phone' => true,
        'address' => true,
        'state_id' => true,
        'city_id' => true,
        'pincode' => true,
        'is_approved' => true,
        'is_active' => true,
        'is_deleted' => true,
        'last_updated' => true,
        'dt' => true,
        'speciality' => true,
        'state' => true,
        'city' => true,
        'doctors_relation' => true,
        'work_plans' => true,
        'work_reports' => true
    ];
}
