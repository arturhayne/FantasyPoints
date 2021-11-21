<?php

declare(strict_types=1);

namespace FantasyPoints\Domain;

class Player
{
    use SimpleToArray;

    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $position;
    /**
     * @var Projections
     */
    private $projections;

    /**
     * Player constructor.
     * @param int         $id
     * @param string      $name
     * @param string      $position
     * @param Projections $projections
     */
    public function __construct(
        int $id,
        string $name,
        string $position,
        Projections $projections
    ) {
        $this->id                  = $id;
        $this->name                = $name;
        $this->position            = $position;
        $this->projections         = $projections;
    }

    /**
     * @param array $player
     * @return static
     */
    public static function createPlayerFromArray(array $player): self
    {
        $projections = Projections::createFromArray($player);
        return new static (
            $player['PlayerID'],
            $player['Player'],
            $player['Position'],
            $projections
        );
    }

    /**
     * @return int
     */
    public function id(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function position(): string
    {
        return $this->position;
    }

    /**
     * @return float
     */
    public function fantasyPoints(): float
    {
        return $this->projections->fantasyPoints() ?? 0.00;
    }
}
