<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * State Entity
 *
 * @property int $id
 * @property string $name
 * @property string $state_code
 *
 * @property \App\Model\Entity\Chemist[] $chemists
 * @property \App\Model\Entity\City[] $cities
 * @property \App\Model\Entity\Doctor[] $doctors
 * @property \App\Model\Entity\User[] $users
 */
class State extends Entity
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
        'state_code' => true,
        'chemists' => true,
        'cities' => true,
        'doctors' => true,
        'users' => true
    ];
}
