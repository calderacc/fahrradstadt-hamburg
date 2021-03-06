<?php declare(strict_types=1);

namespace AppBundle\Widget\LuftWidget;

use AppBundle\Entity\City;
use AppBundle\Widget\WidgetDataInterface;

class LuftModel implements WidgetDataInterface
{
    /** @var array $dataList */
    protected $dataList = [];

    /** @var City $city */
    protected $city;

    public function setCity(City $city): LuftModel
    {
        $this->city = $city;

        return $this;
    }

    public function addData(LuftDataModel $luftData): LuftModel
    {
        $this->dataList[] = $luftData;

        return $this;
    }

    public function getDataList(): array
    {
        return $this->dataList;
    }

    public function getIdentifier(): string
    {
        return sprintf('luft-%s', $this->city->getSlug());
    }
}
