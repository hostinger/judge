<?php

use PHPUnit\Framework\TestCase;

class JudgeTest extends TestCase
{
    /**
     * @dataProvider negativeCases
     */
    public function testNegatives($value, $msg = null)
    {
        $j = new Judge();
        $this->assertFalse($j->isValid($value, $msg));
    }

    public function negativeCases()
    {
        return [
            ['-', 'no hyphen'],
            ['-----', 'can not be only hyphens'],
            ['-example-', 'can not start or end with hyphen'],
            ['-example', 'can not start with hyphen'],
            ['example-', 'can not end with hyphen'],
            ['admin-2', 'can not be admin with numbering'],
            ['admin', 'can not be admin'],
            ['sql'],
            ['sql-1'],
            ['sql111'],
        ];
    }

    /**
     * @dataProvider positiveCases
     */
    public function testPositives($value)
    {
        $j = new Judge();
        $this->assertTrue($j->isValid($value));
    }

    public function positiveCases()
    {
        return [
            ['sql-1-s'],
            ['sql-aa'],
            ['sqlbkkb'],
            ['i-am-admin'],
            ['example'],
            ['ex-am-ple'],
            ['ex-65'],
            ['65-65'],
            ['65'],
            ['6*5'],
        ];
    }

}

