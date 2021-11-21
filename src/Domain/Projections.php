<?php
declare(strict_types=1);

namespace FantasyPoints\Domain;

class Projections
{
    use SimpleToArray;

    /**
     * @var float
     */
    private $fantasyPoints;
    /**
     * @var float
     */
    private $passingYards;
    /**
     * @var float
     */
    private $rushingYards;
    /**
     * @var float
     */
    private $rushingTouchdowns;
    /**
     * @var float
     */
    private $receptions;
    /**
     * @var float
     */
    private $receivingYards;
    /**
     * @var float
     */
    private $receivingTouchdowns;
    /**
     * @var float
     */
    private $rushingAttempts;
    /**
     * @var float
     */
    private $passingTouchdowns;
    /**
     * @var float
     */
    private $passingCompletions;
    /**
     * @var float
     */
    private $passingAttempts;

    /**
     * Projections constructor.
     * @param float $passingYards
     * @param float $rushingYards
     * @param float $rushingTouchdowns
     * @param float $receptions
     * @param float $receivingYards
     * @param float $receivingTouchdowns
     * @param float $rushingAttempts
     * @param float $passingTouchdowns
     * @param float $passingCompletions
     * @param float $passingAttempts
     */
    public function __construct(
        float $passingYards,
        float $rushingYards,
        float $rushingTouchdowns,
        float $receptions,
        float $receivingYards,
        float $receivingTouchdowns,
        float $rushingAttempts,
        float $passingTouchdowns,
        float $passingCompletions,
        float $passingAttempts
    ) {
        $this->passingYards        = $passingYards;
        $this->rushingYards        = $rushingYards;
        $this->rushingTouchdowns   = $rushingTouchdowns;
        $this->receptions          = $receptions;
        $this->receivingYards      = $receivingYards;
        $this->receivingTouchdowns = $receivingTouchdowns;
        $this->rushingAttempts     = $rushingAttempts;
        $this->passingTouchdowns   = $passingTouchdowns;
        $this->passingCompletions  = $passingCompletions;
        $this->passingAttempts     = $passingAttempts;
        $this->fantasyPoints       = $this->calculateFantasyPoints();
    }


    /**
     * Stat Translation Dictionary
        pas_att : PassingAttempts
        pas_cmp : PassingCompletions
        pas_tds : PassingTouchdowns
        pas_yds : PassingYards
        rus_att : RushingAttempts
        rus_tds : RushingTouchdowns
        rus_yds : RushingYards
        rec_rec : Receptions
        rec_tds : ReceivingTouchdowns
        rec_yds : ReceivingYards
     * @param array $projections
     * @return static
     */
    public static function createFromArray(array $projections): self
    {
        return new static(
            (float) $projections['pas_yds'],
            (float) $projections['rus_yds'],
            (float) $projections['rus_tds'],
            (float) $projections['rec_rec'],
            (float) $projections['rec_yds'],
            (float) $projections['rec_tds'],
            (float) $projections['rus_att'],
            (float) $projections['pas_tds'],
            (float) $projections['pas_cmp'],
            (float) $projections['pas_att']
        );
    }

    /**
     * @return float
     */
    private function calculateFantasyPoints(): float
    {
        return
            ($this->passingTouchdowns * ScoringGuidelines::PASSING_TOUCHDOWN_GUIDELINE) +
            ($this->passingYards * ScoringGuidelines::PASSING_YARDS_GUIDELINE) +
            ($this->rushingYards * ScoringGuidelines::RUSHING_YARDS_GUIDELINE) +
            ($this->rushingTouchdowns * ScoringGuidelines::RUSHING_TOUCHDOWNS_GUIDELINE) +
            ($this->receptions * ScoringGuidelines::RECEPTIONS_GUIDELINE) +
            ($this->receivingYards * ScoringGuidelines::RECEIVING_YARDS_GUIDELINE) +
            ($this->receivingTouchdowns * ScoringGuidelines::RECEIVING_TOUCHDOWNS_GUIDELINE);
    }

    /**
     * @return float
     */
    public function fantasyPoints(): float
    {
        return $this->fantasyPoints ?? 0.00;
    }
}
