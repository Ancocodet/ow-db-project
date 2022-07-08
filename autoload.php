<?php

include_once __DIR__ . '/lib/Database.php';

include_once __DIR__ . '/lib/entities/GameEntity.php';
include_once __DIR__ . '/lib/entities/GameModeEntity.php';
include_once __DIR__ . '/lib/entities/GamePlayerEntity.php';
include_once __DIR__ . '/lib/entities/HeroEntity.php';
include_once __DIR__ . '/lib/entities/MapEntity.php';
include_once __DIR__ . '/lib/entities/PlayerEntity.php';
include_once __DIR__ . '/lib/entities/SkinEntity.php';

include_once __DIR__ . '/lib/enums/EGameMode.php';
include_once __DIR__ . '/lib/enums/EGame.php';
include_once __DIR__ . '/lib/enums/EGamePlayer.php';
include_once __DIR__ . '/lib/enums/EHero.php';
include_once __DIR__ . '/lib/enums/EMap.php';
include_once __DIR__ . '/lib/enums/EPlayer.php';
include_once __DIR__ . '/lib/enums/ESkin.php';

include_once __DIR__ . '/lib/managers/GameManager.php';
include_once __DIR__ . '/lib/managers/HeroManager.php';
include_once __DIR__ . '/lib/managers/PlayerManager.php';
include_once __DIR__ . '/lib/managers/MapManager.php';
include_once __DIR__ . '/lib/managers/GameModeManager.php';
