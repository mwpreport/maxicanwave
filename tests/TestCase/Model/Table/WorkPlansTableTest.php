<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WorkPlansTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WorkPlansTable Test Case
 */
class WorkPlansTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\WorkPlansTable
     */
    public $WorkPlans;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.work_plans',
        'app.users',
        'app.work_types',
        'app.work_reports',
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
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('WorkPlans') ? [] : ['className' => WorkPlansTable::class];
        $this->WorkPlans = TableRegistry::get('WorkPlans', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->WorkPlans);

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
