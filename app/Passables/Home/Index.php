<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 9:42 AM
 */

namespace App\Passables\Home;

use App\Passables\Index as PassableIndex;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class Index
 * @package App\Passables\Home
 */
class Index extends PassableIndex
{
    /**
     * @var Collection
     */
    protected $frequencies;

    /**
     * Index constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return Collection
     */
    public function getFrequencies()
    {
        return $this->frequencies;
    }

    /**
     * @param Collection $frequencies
     */
    public function setFrequencies($frequencies)
    {
        $this->frequencies = $frequencies;
    }
}
