<?php
declare(strict_types=1);

namespace App\Patterns\Visitor;

/**
 * Class CompositeUnit
 * @package App\Patterns\Composite
 */
abstract class CompositeUnit extends Unit
{
    /**
     * @var Unit[]
     */
    private $units = [];

    /**
     * @return CompositeUnit
     */
    public function getComposite(): CompositeUnit
    {
        return $this;
    }

    /**
     * @return Unit[]
     */
    public function getUnits(): array
    {
        return $this->units;
    }

    /**
     * @return int
     */
    public function unitsCount(): int
    {
        $count = 0;
        foreach ($this->getUnits() as $unit) {
            $count += $unit->unitsCount();
        }

        return $count;
    }

    /**
     * @param ArmyVisitor $visitor
     */
    public function accept(ArmyVisitor $visitor)
    {
        parent::accept($visitor);
        foreach ($this->getUnits() as $unit) {
            $unit->accept($visitor);
        }
    }

    /**
     * @param Unit $unit
     */
    public function addUnit(Unit $unit): void
    {
        if (\in_array($unit, $this->units, true)) {
            return;
        }

        $unit->setDepth($unit->getDepth() + 1);
        $this->units[] = $unit;
    }

    /**
     * @inheritDoc
     *
     * @param Unit $unit
     */
    public function removeUnit(Unit $unit): void
    {
        $unitId = array_search($unit, $this->units, true);

        if (is_int($unitId)) {
            array_splice($this->units, $unitId, 1, []);
        }
    }
}