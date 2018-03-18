<?php declare(strict_types=1);

namespace AppBundle\PhotoManipulator;

use AppBundle\PhotoManipulator\PhotoInterface\PhotoInterface;

interface PhotoManipulatorInterface
{
    public function open(PhotoInterface $photo): PhotoManipulatorInterface;
    public function save(): PhotoManipulatorInterface;

    public function rotate(int $angle): PhotoManipulatorInterface;
    public function censor(array $areaDataList, int $displayWidth): PhotoManipulatorInterface;
}
