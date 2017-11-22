<?php
namespace App\Test\TestCase\Controller;

use App\Controller\WorkReportsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\WorkReportsController Test Case
 */
class WorkReportsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.work_reports',
        'app.users',
        'app.work_types',
        'app.work_plans',
        'app.plans',
        'app.cities',
        'app.states',
        'app.chemists',
        'app.chemists_relation',
        'app.doctors',
        'app.specialities',
        'app.doctors_relation'
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
