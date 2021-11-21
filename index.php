<?php

use FantasyPoints\Application\FileHandler;

require_once(__DIR__ . '/vendor/autoload.php');

define("DEFAULT_SOURCE_FILE", __DIR__ . '/events.json');
define("DEFAULT_TARGET_FILE", __DIR__ . '/result.json');

$sourceFile = $argv[1] ?? DEFAULT_SOURCE_FILE;
$targetFile = $argv[2] ?? DEFAULT_TARGET_FILE;

$file = new FileHandler($sourceFile, $targetFile);

$file->generateFile();
