<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TravelExpensesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TravelExpensesTable Test Case
 */
class TravelExpensesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TravelExpensesTable
     */
    public $TravelExpenses;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.travel_expenses',
        'app.expenses',
        'app.users',
        'app.roles',
        'app.states',
        'app.chemists',
        'app.cities',
        'app.doctors',
        'app.specialities',
        'app.doctor_types',
        'app.qualifications',
        'app.doctors_relation',
        'app.work_plans',
        'app.work_types',
        'app.work_reports',
        'app.plans',
        'app.stockists',
        'app.pg_others',
        'app.leave_types',
        'app.work_plan_submit',
        'app.expense_types',
        'app.daily_allowances',
        'app.other_expenses'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TravelExpenses') ? [] : ['className' => TravelExpensesTable::class];
        $this->TravelExpenses = TableRegistry::get('TravelExpenses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TravelExpenses);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
