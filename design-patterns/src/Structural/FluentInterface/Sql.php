<?php
declare(strict_types=1);

namespace App\Structural\FluentInterface;

/**
 * Class Sql
 * @package App\Structural\FluentInterface
 */
class Sql
{
    /**
     * @var array
     */
    private $fields = [];

    /**
     * @var array
     */
    private $from = [];

    /**
     * @var array
     */
    private $where = [];

    /**
     * @param array $fields
     * @return Sql
     */
    public function select(array $fields): Sql
    {
        $this->fields = $fields;

        return $this;
    }

    /**
     * @param string $table
     * @param string $alias
     * @return Sql
     */
    public function from(string $table, string $alias): Sql
    {
        $this->from[] = $table . ' AS ' . $alias;

        return $this;
    }

    /**
     * @param string $condition
     * @return Sql
     */
    public function where(string $condition): Sql
    {
        $this->where[] = $condition;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return sprintf(
            'SELECT %s FROM %s WHERE %s',
            implode(', ', $this->fields),
            implode(', ', $this->from),
            implode(' AND ', $this->where)
        );
    }
}