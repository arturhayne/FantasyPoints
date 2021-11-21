<?php
declare(strict_types=1);

namespace FantasyPoints\Application;

use FantasyPoints\Domain\Events;

class FileHandler
{
    /**
     * @var string
     */
    private $sourceFilePath;

    /**
     * @var
     */
    private $targetFilePath;

    /**
     * FileHandler constructor.
     * @param string $sourceFilePath
     * @param string $targetFilePath
     */
    public function __construct(string $sourceFilePath, string $targetFilePath)
    {
        $this->sourceFilePath = $sourceFilePath;
        $this->targetFilePath = $targetFilePath;
    }

    public function generateFile(): void
    {
        if(!file_exists($this->sourceFilePath)) {
            print_r('File does not exist!'. PHP_EOL);
            return;
        }

        $stringFile = file_get_contents($this->sourceFilePath);

        $events = Events::createEventsFromArray(json_decode($stringFile, true));

        $events->sortPlayersByFantasyPoint();

        $json = json_encode($events->toArray());

        if(file_put_contents($this->targetFilePath, $json)){
            print_r('Json file created in '. $this->targetFilePath . PHP_EOL);
        }
    }
}
