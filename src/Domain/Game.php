<?php
declare(strict_types=1);

namespace FantasyPoints\Domain;

class Game
{
    use SimpleToArray;

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $dateTime;

    /**
     * @var array
     */
    private $teams;

    /**
     * Game constructor.
     * @param int        $id
     * @param string  $dateTime
     * @param array|null $teams
     */
    public function __construct(int $id, string $dateTime, ?array $teams = null)
    {
        $this->id       = $id;
        $this->dateTime = $dateTime;
        $this->teams    = $teams;
    }

    /**
     * @param array $game
     * @return static
     */
    public static function createGameFromArray(array $game): self
    {
        return new static($game['GameID'], $game['DateTime']);
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
    public function dateTime(): string
    {
        return $this->dateTime;
    }

    /**
     * @param int $teamId
     * @return Team|null
     */
    public function getTeamById(int $teamId): ?Team
    {
        return $this->teams[$teamId] ?? null;
    }

    public function addTeamInAGame(Team $team): void
    {
        $this->teams[$team->id()] = $team;
    }

    /**
     * @return array
     */
    public function teams(): array
    {
        return $this->teams;
    }
}
