<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\QualificationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\QualificationsTable Test Case
 */
class QualificationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\QualificationsTable
     */
    public $Qualifications;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.qualifications',
        'app.doctors',
        'app.specialities',
        'app.states',
        'app.chemists',
        'app.cities',
        'app.users',
        'app.roles',
        'app.work_plans',
        'app.work_types',
        'app.work_reports',
        'app.plans',
        'app.leave_types',
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
        $config = TableRegistry::exists('Qualifications') ? [] : ['className' => QualificationsTable::class];
        $this->Qualifications = TableRegistry::get('Qualifications', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Qualifications);

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
