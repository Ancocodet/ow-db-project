<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/lib/Database.php';

include_once(__DIR__ . '/steps/IStep.php');
include_once(__DIR__ . '/steps/ConfigFillStep.php');
include_once(__DIR__ . '/steps/CreateTablesStep.php');
include_once(__DIR__ . '/steps/EntryCreationStep.php');
include_once(__DIR__ . '/steps/FinishedStep.php');

include_once __DIR__ . '/converter/FileReader.php';
include_once __DIR__ . '/converter/GameConverter.php';
include_once __DIR__ . '/converter/GameModeConverter.php';
include_once __DIR__ . '/converter/GamePlayerConverter.php';
include_once __DIR__ . '/converter/HeroConverter.php';
include_once __DIR__ . '/converter/MapConverter.php';
include_once __DIR__ . '/converter/PlayerConverter.php';
include_once __DIR__ . '/converter/SkinConverter.php';