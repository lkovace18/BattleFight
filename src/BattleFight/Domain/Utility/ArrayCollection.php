<?php declare(strict_types=1);

namespace BattleFight\Domain\Utility;

use ArrayIterator;
use Countable;
use IteratorAggregate;

/**
 * Class ArrayCollection
 * @package BattleFight\Domain\Utility
 * @todo: refactor implement ArrayIterator or use  Illuminate\Support\Collection
 */
abstract class ArrayCollection implements Countable, IteratorAggregate
{
    /** @var array */
    private $elements;

    /**
     * ArrayCollection constructor.
     *
     * @param array $elements
     */
    public function __construct(array $elements = [])
    {
        $this->elements = $elements;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->elements;
    }

    /**
     * @return mixed
     */
    public function first()
    {
        return reset($this->elements);
    }

    /**
     * @return mixed
     */
    public function last()
    {
        return end($this->elements);
    }

    /**
     * @return int|string|null
     */
    public function key()
    {
        return key($this->elements);
    }

    /**
     * @return mixed
     */
    public function next()
    {
        return next($this->elements);
    }

    /**
     * @return mixed
     */
    public function current()
    {
        return current($this->elements);
    }

    /**
     * @param mixed $key
     *
     * @return mixed|null
     */
    public function remove($key)
    {
        if (!isset($this->elements[$key]) && !array_key_exists($key, $this->elements)) {
            return null;
        }
        $removed = $this->elements[$key];
        unset($this->elements[$key]);

        return $removed;
    }

    /**
     * @param mixed $element
     *
     * @return bool
     */
    public function removeElement($element)
    {
        $key = array_search($element, $this->elements, true);
        if ($key === false) {
            return false;
        }
        unset($this->elements[$key]);

        return true;
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->elements);
    }

    /**
     * @param mixed $key
     * @param mixed $element
     *
     * @return bool
     */
    public function add($key, $element): bool
    {
        $this->elements[$key] = $element;

        return true;
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return empty($this->elements);
    }

    /**
     * @return ArrayIterator|\Traversable
     */
    public function getIterator()
    {
        return new ArrayIterator($this->elements);
    }

    /**
     * @param array $elements
     *
     * @return ArrayCollection
     */
    protected function createFrom(array $elements)
    {
        return new static($elements);
    }
}
