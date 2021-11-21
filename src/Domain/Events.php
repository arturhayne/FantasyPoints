<?php
declare(strict_types=1);

namespace FantasyPoints\Domain;

class Events
{
    use SimpleToArray;

    /**
     * @var array
     */
    private $events;

    /**
     * Games constructor.
     * @param array $events
     */
    public function __construct(array $events)
    {
        $this->events = $events;
    }

    /**
     * @param array $eventsArray
     * @return static
     */
    public static function createEventsFromArray(array $eventsArray): self
    {
        $events = [];
        foreach ($eventsArray as $node) {
            $gameId = $node['GameID'];
            if (!isset($events[$gameId])) {
                $game = Game::createGameFromArray($node);
                $events[$gameId] = $game;
            }

            $game = $events[$gameId];

            if ($game->getTeamById($node['TeamID']) == null) {
                $game->addTeamInAGame(Team::createTeamFromGameArray($node));
            }
            $team = $game->getTeamById($node['TeamID']);
            $player = Player::createPlayerFromArray($node);
            $team->addPlayer($player);
        }

        return new static($events);
    }

    /**
     * @return array
     */
    public function events(): array
    {
        return $this->events;
    }
}
