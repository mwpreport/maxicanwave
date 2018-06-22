<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Expense Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $work_plan_submit_id
 * @property \Cake\I18n\FrozenDate $expense_date
 * @property int $expense_type_id
 * @property int $daily_allowance
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $updated
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\WorkPlanSubmit $work_plan_submit
 * @property \App\Model\Entity\ExpenseType $expense_type
 * @property \App\Model\Entity\OtherExpense[] $other_expenses
 * @property \App\Model\Entity\TravelExpense[] $travel_expenses
 */
class Expense extends Entity
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
        'user_id' => true,
        'work_plan_submit_id' => true,
        'expense_date' => true,
        'expense_type_id' => true,
        'daily_allowance' => true,
        'created' => true,
        'updated' => true,
        'user' => true,
        'work_plan_submit' => true,
        'expense_type' => true,
        'other_expenses' => true,
        'travel_expenses' => true,
        'started' => true,
        'reached' => true,
        'disallowed' => true,
        'disallowed_remark' => true,
        'abeyance' => true,
        'abeyance_remark' => true
    ];
}
