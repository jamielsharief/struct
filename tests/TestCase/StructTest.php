<?php
/**
 * Struct
 * Copyright 2020 Jamiel Sharief.
 *
 * Licensed under The MIT License
 * The above copyright notice and this permission notice shall be included in all copies or substantial
 * portions of the Software.
 *
 * @copyright   Copyright (c) Jamiel Sharief
 * @license     https://opensource.org/licenses/mit-license.php MIT License
 */
declare(strict_types = 1);
namespace Struct\Test\TestCase;

use RuntimeException;
use PHPUnit\Framework\TestCase;
use Struct\Test\Fixture\Employee;

class StructTest extends TestCase
{
    public function testSet()
    {
        $employee = new Employee();
        $this->expectException(RuntimeException::class);
        $employee->insurance_no = 'foo';
    }

    public function testGet()
    {
        $employee = new Employee();
        $this->expectException(RuntimeException::class);
        $no = $employee->insurance_no;
    }

    public function testClone()
    {
        $claire = new Employee([
            'name' => 'Claire',
            'email' => 'claire@example.com',
            'reportsTo' => null
        ]);

        $sarah = new Employee([
            'name' => 'Sarah',
            'email' => 'sarah@example.com',
            'reportsTo' => $claire
        ]);

        $bill = clone $sarah;
        $claire->name = 'Claire Bear';

        $this->assertEquals('Claire', $bill->reportsTo->name);
    }

    public function testCloneDeep()
    {
        $claire = new Employee([
            'name' => 'Claire',
            'email' => 'claire@example.com',
            'reportsTo' => null
        ]);
        $sarah = new Employee([
            'name' => 'Sarah',
            'email' => 'sarah@example.com',
            'reportsTo' => null,
            'subordinates' => [
                $claire
            ]
        ]);

        $bill = clone $sarah;
        $claire->name = 'Claire Bear';

        $this->assertEquals('Claire', $bill->subordinates[0]->name);
    }

    public function testSetState()
    {
        $employee = Employee::__set_state([
            'name' => 'Claire',
            'email' => 'claire@example.com',
            'reportsTo' => null
        ]);

        $this->assertInstanceOf(Employee::class, $employee);
        $this->assertEquals('claire@example.com', $employee->email);
    }
}
