<?php
declare(strict_types=1);

namespace FantasyPoints\Domain;

class Team
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
    private $teamAbr;

    /**
     * @var array|null
     */
    private $players;

    /**
     * Team constructor.
     * @param int    $id
     * @param string $name
     * @param string $teamAbr
     * @param array  $players
     */
    public function __construct(int $id, string $name, string $teamAbr, ?array $players = null)
    {
        $this->id      = $id;
        $this->name    = $name;
        $this->teamAbr = $teamAbr;
        $this->players = $players;
    }

    /**
     * @param array $gameArray
     * @return static
     */
    public static function createTeamFromGameArray(array $gameArray): self
    {
        return new static ($gameArray['TeamID'], $gameArray['Team'], $gameArray['Team_Abbr']);
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
    public function teamAbr(): string
    {
        return $this->teamAbr;
    }

    /**
     * @return array|null
     */
    public function players(): ?array
    {
        return $this->players;
    }

    /**
     * @param Player $player
     */
    public function addPlayer(Player $player): void
    {
        $this->players[$player->id()] = $player;
    }

    public function sortPlayersByFantasyPoints(): void
    {
        uasort($this->players,
            function (Player $playerA,Player $playerB) {
                return $playerA->fantasyPoints() < $playerB->fantasyPoints();
            }
        );
    }
}
