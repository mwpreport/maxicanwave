<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\QualificationTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\QualificationTable Test Case
 */
class QualificationTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\QualificationTable
     */
    public $Qualification;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.qualification'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Qualification') ? [] : ['className' => QualificationTable::class];
        $this->Qualification = TableRegistry::get('Qualification', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Qualification);

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
