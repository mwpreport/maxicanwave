<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * WorkType Entity
 *
 * @property int $id
 * @property string $name
 * @property string $color
 *
 * @property \App\Model\Entity\WorkPlan[] $work_plans
 * @property \App\Model\Entity\WorkReport[] $work_reports
 */
class WorkType extends Entity
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
        'name' => true,
        'color' => true,
        'work_plans' => true,
        'work_reports' => true
    ];
}
