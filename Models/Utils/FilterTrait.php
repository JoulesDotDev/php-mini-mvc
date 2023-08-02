<?php

trait FilterTrait
{
    public function filteredData()
    {
        $filterKeys = self::secret();
        $objectVars = get_object_vars($this);

        foreach ($filterKeys as $key) {
            if (array_key_exists($key, $objectVars)) {
                unset($objectVars[$key]);
            }
        }

        return $objectVars;
    }
}
