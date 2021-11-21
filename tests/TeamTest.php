<?php
declare(strict_types=1);

namespace Tests;

use FantasyPoints\Domain\Player;
use FantasyPoints\Domain\Projections;
use FantasyPoints\Domain\Team;
use PHPUnit\Framework\TestCase;

class TeamTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_sort_team_players_by_fantasy_points_descending(): void
    {
        $players                = [];
        $playerWithLowerScore   = $this->createPlayer(1);
        $playerWithGreaterScore = $this->createPlayer(3, ['rus_tds' => 3000]);
        $playerWith200RusTDS    = $this->createPlayer(3, ['rus_tds' => 200]);
        $playerWith100RusTDS    = $this->createPlayer(4, ['rus_tds' => 100]);

        $players[1] = $playerWithLowerScore;
        $players[2] = $playerWithGreaterScore;
        $players[3] = $playerWith200RusTDS;
        $players[4] = $playerWith100RusTDS;

        $team = new Team(1, 'test', 'test', $players);

        $team->sortPlayersByFantasyPoints();

        $array       = $team->players();
        $firstPlayer = array_shift($array);
        $this->assertEquals($playerWithGreaterScore, $firstPlayer);
        $secondPlayer = array_shift($array);
        $this->assertEquals($playerWith200RusTDS, $secondPlayer);
        $thirdPlayer = array_shift($array);
        $this->assertEquals($playerWith100RusTDS, $thirdPlayer);
        $fourthPlayer = array_shift($array);
        $this->assertEquals($playerWithLowerScore, $fourthPlayer);
    }

    /**
     * @param int   $id
     * @param array $data
     * @return Player
     */
    private function createPlayer(int $id, array $data = []): Player
    {
        $pas_att = $data['pas_att'] ?? 0;
        $pas_cmp = $data['pas_cmp'] ?? 0;
        $pas_tds = $data['pas_tds'] ?? 0;
        $pas_yds = $data['pas_yds'] ?? 0;
        $rus_att = $data['rus_att'] ?? 0.26;
        $rus_tds = $data['rus_tds'] ?? 0.01;
        $rus_yds = $data['rus_yds'] ?? 1.81;
        $rec_rec = $data['rec_rec'] ?? 2.89;
        $rec_tds = $data['rec_tds'] ?? 0.25;
        $rec_yds = $data['rec_yds'] ?? 37.83;

        $projection = new Projections(
            $pas_yds,
            $rus_yds,
            $rus_tds,
            $rec_rec,
            $rec_yds,
            $rec_tds,
            $rus_att,
            $pas_tds,
            $pas_cmp,
            $pas_att
        );

        return new Player(
            $id,
            "test",
            "test",
            $projection
        );
    }
}
