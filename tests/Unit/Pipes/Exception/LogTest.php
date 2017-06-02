<?php

namespace App\Tests\Unit\Pipes\Exception;

use App\Pipes\Exception\Log;
use App\Tests\TestCase;
use Exception;

class LogTest extends TestCase
{
    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Exception
     * @group App.Pipes.Exception.Log
     * @group App.Pipes.Exception.Log.Success
     */
    public function testLogSuccess()
    {
        $filename = storage_path('logs/laravel.log');
        shell_exec('rm ' . $filename);

        $pipe = new Log();
        $exception = new Exception(
            'Test',
            500
        );

        $pipe->handle(
            $exception,
            function ($passable) {
                //do nothing
            }
        );

        $logFile = file($filename);
        $this->assertContains(
            'testing.CRITICAL: Test',
            $logFile[0]
        );
    }
}
