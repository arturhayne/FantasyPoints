<?php
declare(strict_types=1);

namespace Tests;

use FantasyPoints\Domain\Events;
use PHPUnit\Framework\TestCase;

class EventsTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_create_games_from_json(): void
    {
        $events = Events::createEventsFromArray(json_decode($this->sampleEventsJson(), true));

        $this->assertInstanceOf(Events::class, $events);
    }

    /**
     * @return string
     */
    private function sampleEventsJson(): string
    {
        return '[
          {
            "GameID": 4664,
            "DateTime": "2021-02-07T18:30:00-04:00",
            "TeamID": 16,
            "Team": "Kansas City Chiefs",
            "Team_Abbr": "KC",
            "PlayerID": 7246,
            "Player": "Mecole Hardman",
            "Position": "WR",
            "pas_att": 0,
            "pas_cmp": 0,
            "pas_tds": 0,
            "pas_yds": 0,
            "rus_att": 0.26,
            "rus_tds": 0.01,
            "rus_yds": 1.81,
            "rec_rec": 2.89,
            "rec_tds": 0.25,
            "rec_yds": 37.83
          },
          {
            "GameID": 4664,
            "DateTime": "2021-02-07T18:30:00-04:00",
            "TeamID": 16,
            "Team": "Kansas City Chiefs",
            "Team_Abbr": "KC",
            "PlayerID": 6032,
            "Player": "Tyreek Hill",
            "Position": "WR",
            "pas_att": 0,
            "pas_cmp": 0,
            "pas_tds": 0,
            "pas_yds": 0,
            "rus_att": 1.01,
            "rus_tds": 0.05,
            "rus_yds": 5.61,
            "rec_rec": 6.12,
            "rec_tds": 0.69,
            "rec_yds": 84.11
          },  {
            "GameID": 4664,
            "DateTime": "2021-02-07T18:30:00-04:00",
            "TeamID": 24,
            "Team": "Tampa Bay Buccaneers",
            "Team_Abbr": "TB",
            "PlayerID": 7011,
            "Player": "Ronald Jones",
            "Position": "RB",
            "pas_att": 0,
            "pas_cmp": 0,
            "pas_tds": 0,
            "pas_yds": 0,
            "rus_att": 8.12,
            "rus_tds": 0.28,
            "rus_yds": 37.27,
            "rec_rec": 1.17,
            "rec_tds": 0.04,
            "rec_yds": 9.18
          },
          {
            "GameID": 4664,
            "DateTime": "2021-02-07T18:30:00-04:00",
            "TeamID": 24,
            "Team": "Tampa Bay Buccaneers",
            "Team_Abbr": "TB",
            "PlayerID": 3912,
            "Player": "Rob Gronkowski",
            "Position": "TE",
            "pas_att": 0,
            "pas_cmp": 0,
            "pas_tds": 0,
            "pas_yds": 0,
            "rus_att": 0,
            "rus_tds": 0,
            "rus_yds": 0,
            "rec_rec": 2.45,
            "rec_tds": 0.3,
            "rec_yds": 34.27
          }
         ]';
    }
}
