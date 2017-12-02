<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WorkReportsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WorkReportsTable Test Case
 */
class WorkReportsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\WorkReportsTable
     */
    public $WorkReports;

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
        'app.cities',
        'app.states',
        'app.chemists',
        'app.chemists_relation',
        'app.doctors',
        'app.specialities',
        'app.doctors_relation',
        'app.plans'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('WorkReports') ? [] : ['className' => WorkReportsTable::class];
        $this->WorkReports = TableRegistry::get('WorkReports', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->WorkReports);

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
