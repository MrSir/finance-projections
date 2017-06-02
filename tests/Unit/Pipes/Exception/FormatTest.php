<?php

namespace App\Tests\Unit\Pipes\Exception;

use App\Pipes\Exception\Format;
use App\Tests\TestCase;
use Exception;

class FormatTest extends TestCase
{
    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Exception
     * @group App.Pipes.Exception.Format
     * @group App.Pipes.Exception.Format.Success
     */
    public function testLogSuccess()
    {
        $pipe = new Format();
        $exception = new Exception(
            'Test',
            500
        );

        $pipe->handle(
            $exception,
            function ($passable) {
                $this->assertEquals(
                    500,
                    $passable['code']
                );
                $this->assertEquals(
                    'Test',
                    $passable['message']
                );
            }
        );
    }
}
