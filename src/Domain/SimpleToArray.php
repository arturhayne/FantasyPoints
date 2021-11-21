<?php
declare(strict_types=1);

namespace FantasyPoints\Domain;

trait SimpleToArray
{
    /**
     * @param null $source
     * @return array
     */
    public function toArray($source = null): array
    {
        $source   = $source ?? get_object_vars($this);
        $filtered = array_filter($source, function ($value) {
            return !is_null($value);
        });
        return array_map(
            function ($value) {
                if (is_object($value)) {
                    return $value->toArray();
                }
                if (is_array($value)) {
                    return $this->toArray($value);
                }

                return $value;
            },
            $filtered
        );
    }
}
