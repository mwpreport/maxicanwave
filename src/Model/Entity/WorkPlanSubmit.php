<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * WorkPlanSubmit Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenDate $date
 * @property int $user_id
 * @property int $lead_id
 * @property int $is_approved
 * @property \Cake\I18n\FrozenTime $dt
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Lead $lead
 */
class WorkPlanSubmit extends Entity
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
