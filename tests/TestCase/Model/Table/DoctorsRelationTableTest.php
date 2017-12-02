<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DoctorsRelationTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DoctorsRelationTable Test Case
 */
class DoctorsRelationTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DoctorsRelationTable
     */
    public $DoctorsRelation;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.doctors_relation',
        'app.users',
        'app.doctors',
        'app.specialities',
        'app.states',
        'app.chemists',
        'app.cities',
        'app.work_plans',
        'app.work_reports',
        'app.chemists_relation'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('DoctorsRelation') ? [] : ['className' => DoctorsRelationTable::class];
        $this->DoctorsRelation = TableRegistry::get('DoctorsRelation', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DoctorsRelation);

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
