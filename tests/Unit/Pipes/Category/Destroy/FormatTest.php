<?php

namespace App\Tests\Unit\Pipes\Category\Destroy;

use App\Models\Category;
use App\Passables\Category\Destroy;
use App\Pipes\Category\Destroy\Format as PipeFormat;
use App\Tests\Unit\Pipes\Destroy\Format;
use Exception;

/**
 * Class FormatTest
 * @package App\Tests\Unit\Pipes\Category\Destroy
 */
class FormatTest extends Format
{
    /**
     * FormatTest constructor.
     *
     * @param null   $name
     * @param array  $data
     * @param string $dataName
     */
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct(
            $name,
            $data,
            $dataName
        );

        $this->setPassable(Destroy::class);
        $this->setPipe(PipeFormat::class);
        $this->setModel(Category::class);
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Category
     * @group App.Pipes.Category.Destroy
     * @group App.Pipes.Category.Destroy.Format
     * @group App.Pipes.Category.Destroy.Format.Success
     */
    public function testFormatSuccess()
    {
        $this->formatSuccess();
    }

    /**
     * @group                    App
     * @group                    App.Pipes
     * @group                    App.Pipes.Category
     * @group                    App.Pipes.Category.Destroy
     * @group                    App.Pipes.Category.Destroy.Format
     * @group                    App.Pipes.Category.Destroy.Format.Failure
     * @expectedExceptionCode    500
     * @expectedException Exception
     * @expectedExceptionMessage Category format failed.
     */
    public function testFormatFailure()
    {
        $this->formatFailure();
    }
}
