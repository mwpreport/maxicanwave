<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ExpenseApprovalsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ExpenseApprovalsTable Test Case
 */
class ExpenseApprovalsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ExpenseApprovalsTable
     */
    public $ExpenseApprovals;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.expense_approvals',
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
        'app.leads'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ExpenseApprovals') ? [] : ['className' => ExpenseApprovalsTable::class];
        $this->ExpenseApprovals = TableRegistry::get('ExpenseApprovals', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ExpenseApprovals);

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
