<?php
declare(strict_types=1);

namespace Tests;

use FantasyPoints\Domain\Player;
use FantasyPoints\Domain\PlayersHeap;
use FantasyPoints\Domain\Projections;
use PHPUnit\Framework\TestCase;

class PlayersHeapTest  extends TestCase
{

    /**
     * @test
     */
    public function it_should_return_player_in_order_descending_by_fantasy_points(): void
    {
        $players                = new PlayersHeap();
        $playerWithLowerScore   = $this->createPlayer(1);
        $playerWithGreaterScore = $this->createPlayer(3, ['rus_tds' => 3000]);
        $playerWith200RusTDS    = $this->createPlayer(3, ['rus_tds' => 200]);
        $playerWith100RusTDS    = $this->createPlayer(4, ['rus_tds' => 100]);

        $players->insert($playerWithLowerScore);
        $players->insert($playerWithLowerScore);
        $players->insert($playerWithGreaterScore);
        $players->insert($playerWith200RusTDS);
        $players->insert($playerWith100RusTDS);

        $this->assertEquals($playerWithGreaterScore, $players->current());
        $players->next();
        $this->assertEquals($playerWith200RusTDS, $players->current());
        $players->next();
        $this->assertEquals($playerWith100RusTDS, $players->current());
        $players->next();
        $this->assertEquals($playerWithLowerScore, $players->current());
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
