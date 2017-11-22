<?php
namespace App\Test\TestCase\Controller;

use App\Controller\SpecialitiesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\SpecialitiesController Test Case
 */
class SpecialitiesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.specialities',
        'app.doctors',
        'app.states',
        'app.chemists',
        'app.cities',
        'app.users',
        'app.work_plans',
        'app.work_reports',
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
