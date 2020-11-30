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
namespace Struct\Test\Fixture;

use Struct\Struct;

class Employee extends Struct
{
    public string $name;
    public string $email;
    public ?Employee $reportsTo;

    /**
     * @var \Struct\Test\Fixture\Struct\Employee[] $subordinates
     */
    public array $subordinates = [];

    protected function initialize(array $data)
    {
    }
}
