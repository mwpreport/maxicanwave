<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OtherExpense Entity
 *
 * @property int $id
 * @property int $expense_id
 * @property string $description
 * @property int $fare
 * @property int $voucher_no
 *
 * @property \App\Model\Entity\Expense $expense
 */
class OtherExpense extends Entity
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
        'expense_id' => true,
        'other_allowance_id' => true,
        'description' => true,
        'fare' => true,
        'voucher_no' => true,
        'expense' => true,
        'other_allowance' => true,
    ];
}
