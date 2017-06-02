<?php

namespace App\Tests\Unit\Pipes\Category\Store;

use App\Models\Category;
use App\Passables\Category\Store;
use App\Pipes\Category\Store\Format as PipeFormat;
use App\Tests\Unit\Pipes\Store\Format;
use Exception;

/**
 * Class FormatTest
 * @package App\Tests\Unit\Pipes\Category\Store
 */
class FormatTest extends Format
{
    /**
     * UpdateTest constructor.
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

        $this->setPassable(Store::class);
        $this->setPipe(PipeFormat::class);
        $this->setModel(Category::class);
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Category
     * @group App.Pipes.Category.Store
     * @group App.Pipes.Category.Store.Format
     * @group App.Pipes.Category.Store.Format.Success
     */
    public function testFormatSuccess()
    {
        $this->formatSuccess();
    }

    /**
     * @group                    App
     * @group                    App.Pipes
     * @group                    App.Pipes.Category
     * @group                    App.Pipes.Category.Store
     * @group                    App.Pipes.Category.Store.Format
     * @group                    App.Pipes.Category.Store.Format.Failure
     * @expectedExceptionCode    500
     * @expectedException Exception
     * @expectedExceptionMessage Category format failed.
     */
    public function testFormatFailure()
    {
        $this->formatFailure();
    }
}
