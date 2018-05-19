<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Chemist Entity
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $contact_person
 * @property int $mobile
 * @property int $phone
 * @property string $address
 * @property int $state_id
 * @property int $city_id
 * @property int $pincode
 * @property int $is_deleted
 * @property \Cake\I18n\FrozenTime $last_updated
 * @property \Cake\I18n\FrozenTime $dt
 *
 * @property \App\Model\Entity\State $state
 * @property \App\Model\Entity\City $city
 */
class Chemist extends Entity
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
