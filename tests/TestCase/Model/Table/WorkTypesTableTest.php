<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WorkTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WorkTypesTable Test Case
 */
class WorkTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\WorkTypesTable
     */
    public $WorkTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.work_types',
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
        $config = TableRegistry::exists('WorkTypes') ? [] : ['className' => WorkTypesTable::class];
        $this->WorkTypes = TableRegistry::get('WorkTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->WorkTypes);

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
