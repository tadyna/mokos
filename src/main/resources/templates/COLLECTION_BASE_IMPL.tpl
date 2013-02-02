<?php
/**
 * @date: ${date}
 * @version: ${version}
 * 
 * Implementation interface for ${domain_name} entity
 * ${domain_description}
 */
class ${domain_name}CollectionImpl extends CollectionBase
{
    /**
     * @inheritDoc
     */
    public function add(${domain_name} $entity) {
        $this->offsetSet($entity);
    }
    /**
     * @inheritDoc
     */
    public function remove(${domain_name} $entity) {
        $this->offsetUnset($entity);
    /**
     * @inheritDoc
     */
    public function offsetSet($key, $value) {
        if (!$value instanceof ${domain_name}) {
            throw new \InvalidArgumentException(
                "Could not add the ${domain_name} object to the collection.");
        }
        if (!isset($key)) {
            $this->items[] = $value;
        }
        else {
            $this->items[$key] = $value;
        }
    }
    /**
     * @inheritDoc
     */
    public function offsetUnset($key) {
        if ($key instanceof ${domain_name}) {
            $this->items = array_filter($this->items,
                function ($v) use ($key) {
                    return $v !== $key;
                });
        }
        else if (isset($this->items[$key])) {
            unset($this->items[$key]);
        }
    }
    /**
     * @inheritDoc
     */
    public function offsetExists($key) {
        return ($key instanceof ${domain_name})
            ? array_search($key, $this->items)
            : isset($this->items[$key]);
    }
}