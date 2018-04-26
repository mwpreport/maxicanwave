<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AssignedGift Entity
 *
 * @property int $id
 * @property int $gift_id
 * @property int $user_id
 * @property int $count
 * @property int $balance
 * @property \Cake\I18n\FrozenTime $dt
 *
 * @property \App\Model\Entity\Gift $gift
 * @property \App\Model\Entity\User $user
 */
class AssignedGift extends Entity
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
