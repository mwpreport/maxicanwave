<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ExpenseApprovalsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ExpenseApprovalsController Test Case
 */
class ExpenseApprovalsControllerTest extends IntegrationTestCase
{

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
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
