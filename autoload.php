<?php

include_once 'lib/Database.php';

include_once 'lib/entities/GameEntity.php';
include_once 'lib/entities/GameModeEntity.php';
include_once 'lib/entities/GamePlayerEntity.php';
include_once 'lib/entities/HeroEntity.php';
include_once 'lib/entities/MapEntity.php';
include_once 'lib/entities/PlayerEntity.php';
include_once 'lib/entities/SkinEntity.php';

include_once 'lib/enums/EGameMode.php';
include_once 'lib/enums/EGame.php';
include_once 'lib/enums/EGamePlayer.php';
include_once 'lib/enums/EHero.php';
include_once 'lib/enums/EMap.php';
include_once 'lib/enums/EPlayer.php';
include_once 'lib/enums/ESkin.php';

include_once 'lib/managers/GameManager.php';
include_once 'lib/managers/HeroManager.php';
include_once 'lib/managers/PlayerManager.php';

if( file_exists(".SETUP") )
{
    include_once 'setup/FileReader.php';

    include_once 'setup/converter/GameConverter.php';
    include_once 'setup/converter/GameModeConverter.php';
    include_once 'setup/converter/HeroConverter.php';
    include_once 'setup/converter/MapConverter.php';
    include_once 'setup/converter/PlayerConverter.php';
    include_once 'setup/converter/SkinConverter.php';
}