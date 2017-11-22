<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ChemistsRelationTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ChemistsRelationTable Test Case
 */
class ChemistsRelationTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ChemistsRelationTable
     */
    public $ChemistsRelation;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.chemists_relation',
        'app.users',
        'app.chemists',
        'app.states',
        'app.cities',
        'app.doctors',
        'app.specialities',
        'app.doctors_relation',
        'app.work_plans',
        'app.work_reports'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ChemistsRelation') ? [] : ['className' => ChemistsRelationTable::class];
        $this->ChemistsRelation = TableRegistry::get('ChemistsRelation', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ChemistsRelation);

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
