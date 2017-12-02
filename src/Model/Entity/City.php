<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * City Entity
 *
 * @property int $id
 * @property int $state_id
 * @property string $city_name
 *
 * @property \App\Model\Entity\State $state
 * @property \App\Model\Entity\Chemist[] $chemists
 * @property \App\Model\Entity\Doctor[] $doctors
 * @property \App\Model\Entity\User[] $users
 * @property \App\Model\Entity\WorkPlan[] $work_plans
 * @property \App\Model\Entity\WorkReport[] $work_reports
 */
class City extends Entity
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
        'state_id' => true,
        'city_name' => true,
        'state' => true,
        'chemists' => true,
        'doctors' => true,
        'users' => true,
        'work_plans' => true,
        'work_reports' => true
    ];
}
