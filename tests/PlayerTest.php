<?php
declare(strict_types=1);

namespace Tests;

use FantasyPoints\Domain\Player;
use FantasyPoints\Domain\Projections;
use FantasyPoints\Domain\ScoringGuidelines;
use PHPUnit\Framework\TestCase;

class PlayerTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_return_fantasy_points_according_scoring_guidelines(): void
    {
        $pas_att = 0;
        $pas_cmp = 0;
        $pas_tds = 0;
        $pas_yds = 0;
        $rus_att = 0.26;
        $rus_tds = 0.01;
        $rus_yds = 1.81;
        $rec_rec = 2.89;
        $rec_tds = 0.25;
        $rec_yds = 37.83;

        $expectedFantasyPoints =
                                $pas_tds * ScoringGuidelines::PASSING_TOUCHDOWN_GUIDELINE +
                                $pas_yds * ScoringGuidelines::PASSING_YARDS_GUIDELINE +
                                $rus_tds * ScoringGuidelines::RUSHING_TOUCHDOWNS_GUIDELINE +
                                $rus_yds * ScoringGuidelines::RUSHING_YARDS_GUIDELINE +
                                $rec_rec * ScoringGuidelines::RECEPTIONS_GUIDELINE+
                                $rec_tds * ScoringGuidelines::RECEIVING_TOUCHDOWNS_GUIDELINE +
                                $rec_yds * ScoringGuidelines::RECEIVING_YARDS_GUIDELINE;

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

        $player = new Player(
            7246,
            "Mecole Hardman",
            "WR",
            $projection
        );

        $this->assertEquals($expectedFantasyPoints, $player->fantasyPoints());
    }
}
