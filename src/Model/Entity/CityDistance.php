<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CityDistance Entity
 *
 * @property int $id
 * @property int $city_from
 * @property int $city_to
 * @property int $km
 */
class CityDistance extends Entity
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
        'city_from' => true,
        'city_to' => true,
        'km' => true
    ];
}
