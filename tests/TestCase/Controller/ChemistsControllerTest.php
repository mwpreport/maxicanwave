<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ChemistsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ChemistsController Test Case
 */
class ChemistsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.chemists',
        'app.states',
        'app.cities',
        'app.doctors',
        'app.specialities',
        'app.doctors_relation',
        'app.work_plans',
        'app.work_reports',
        'app.users',
        'app.chemists_relation'
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
