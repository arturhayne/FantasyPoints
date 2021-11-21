<?php
declare(strict_types=1);

namespace FantasyPoints\Domain;

class PlayersHeap extends \SplHeap
{
    use SimpleToArray;

    /**
     * @param Player $value1
     * @param Player $value2
     * @return int|void
     */
    protected function compare($value1, $value2)
    {
        if ($value1->fantasyPoints() === $value2->fantasyPoints()) return 0;
        return $value1->fantasyPoints() < $value2->fantasyPoints() ? -1 : 1;
    }

    public function toArray(): array
    {
        $array = [];
        while ($this->valid()) {
            /** @var Player $player */
            $player = $this->current();
            $array[$player->id()] = $player->toArray();
            $this->next();
        }

        return $array;
    }
}
