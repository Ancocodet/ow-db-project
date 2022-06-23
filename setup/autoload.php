<?php

include_once '../lib/Database.php';

include_once('steps/IStep.php');
include_once('steps/ConfigFillStep.php');
include_once('steps/CreateTablesStep.php');
include_once('steps/EntryCreationStep.php');
include_once('steps/FinishedStep.php');

include_once('converter/FileReader.php');
include_once 'converter/GameConverter.php';
include_once 'converter/GameModeConverter.php';
include_once 'converter/GamePlayerConverter.php';
include_once 'converter/HeroConverter.php';
include_once 'converter/MapConverter.php';
include_once 'converter/PlayerConverter.php';
include_once 'converter/SkinConverter.php';