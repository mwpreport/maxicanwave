<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OtherAllowancesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OtherAllowancesTable Test Case
 */
class OtherAllowancesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\OtherAllowancesTable
     */
    public $OtherAllowances;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.other_allowances'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('OtherAllowances') ? [] : ['className' => OtherAllowancesTable::class];
        $this->OtherAllowances = TableRegistry::get('OtherAllowances', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->OtherAllowances);

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
