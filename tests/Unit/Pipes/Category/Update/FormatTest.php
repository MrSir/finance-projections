<?php

namespace App\Tests\Unit\Pipes\Category\Update;

use App\Models\Category;
use App\Passables\Category\Update;
use App\Pipes\Category\Update\Format as PipeFormat;
use App\Tests\Unit\Pipes\Update\Format;
use Exception;

/**
 * Class FormatTest
 * @package App\Tests\Unit\Pipes\Category\Update
 */
class FormatTest extends Format
{
    /**
     * SearchTest constructor.
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

        $this->setPassable(Update::class);
        $this->setPipe(PipeFormat::class);
        $this->setModel(Category::class);
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Category
     * @group App.Pipes.Category.Update
     * @group App.Pipes.Category.Update.Format
     * @group App.Pipes.Category.Update.Format.Success
     */
    public function testFormatSuccess()
    {
        $this->formatSuccess();
    }

    /**
     * @group                    App
     * @group                    App.Pipes
     * @group                    App.Pipes.Category
     * @group                    App.Pipes.Category.Update
     * @group                    App.Pipes.Category.Update.Format
     * @group                    App.Pipes.Category.Update.Format.Failure
     * @expectedExceptionCode    500
     * @expectedException Exception
     * @expectedExceptionMessage Category format failed.
     */
    public function testFormatFailure()
    {
        $this->formatFailure();
    }
}
