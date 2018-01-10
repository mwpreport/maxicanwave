<?php
namespace App\Test\TestCase\Controller;

use App\Controller\QualificationsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\QualificationsController Test Case
 */
class QualificationsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.qualifications',
        'app.doctors',
        'app.specialities',
        'app.states',
        'app.chemists',
        'app.cities',
        'app.users',
        'app.roles',
        'app.work_plans',
        'app.work_types',
        'app.work_reports',
        'app.plans',
        'app.leave_types',
        'app.chemists_relation',
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
