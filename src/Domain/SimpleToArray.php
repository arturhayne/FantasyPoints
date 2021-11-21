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
                    // Return as-is to support empty objects during json encode(e.g. {})
                    if ($this->isEmptyObject($value)) {
                        return $value;
                    }
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

    /**
     * @param $value
     * @return bool If it's an empty stdClass or not
     */
    protected function isEmptyObject($value): bool
    {
        if (count((array) $value) == 0) {
            return true;
        }

        return false;
    }
}
