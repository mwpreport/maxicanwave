<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PlanRelationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PlanRelationsTable Test Case
 */
class PlanRelationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PlanRelationsTable
     */
    public $PlanRelations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.plan_relations',
        'app.work_plans',
        'app.users',
        'app.roles',
        'app.states',
        'app.chemists',
        'app.cities',
        'app.doctors',
        'app.specialities',
        'app.qualifications',
        'app.doctors_relation',
        'app.work_reports',
        'app.work_types',
        'app.plans',
        'app.chemists_relation',
        'app.leave_types'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PlanRelations') ? [] : ['className' => PlanRelationsTable::class];
        $this->PlanRelations = TableRegistry::get('PlanRelations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PlanRelations);

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
