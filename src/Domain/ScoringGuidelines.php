<?php
declare(strict_types=1);

namespace FantasyPoints\Domain;

/**
 * Class ScoringGuidelines
 * @package FantasyPoints\Domain
            Passing Yards: +0.04
            Passing Touchdowns: +4.00
            Rushing Yards: +0.10
            Rushing Touchdowns: +6.00
            Receptions: +1.00
            Receiving Yards: +0.10
            Receiving Touchdowns: +6.00
 */
class ScoringGuidelines
{
    const PASSING_YARDS_GUIDELINE = 0.04;

    const PASSING_TOUCHDOWN_GUIDELINE = 4.00;

    const RUSHING_YARDS_GUIDELINE = 0.10;

    const RUSHING_TOUCHDOWNS_GUIDELINE = 6.00;

    const RECEPTIONS_GUIDELINE = 1.00;

    const RECEIVING_YARDS_GUIDELINE = 0.10;

    const RECEIVING_TOUCHDOWNS_GUIDELINE = 6.00;
}
