<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SpecialitiesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SpecialitiesTable Test Case
 */
class SpecialitiesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SpecialitiesTable
     */
    public $Specialities;

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
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Specialities') ? [] : ['className' => SpecialitiesTable::class];
        $this->Specialities = TableRegistry::get('Specialities', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Specialities);

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
}
