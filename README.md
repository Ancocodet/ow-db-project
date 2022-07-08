# OverWatch DB

This project was developed within the framework of vocational school for database teaching. The project creates a database based on the computer game, which can be managed with a rudimentary UI.

For the use of a PHP debug server a "router.php" is included, which allows to use the project as intended.

**This project is in no case intended for productive use.**

## Requirements

- PHP >= 7.4
- php_mysqli

## Database Structure

```mermaid
erDiagram
  games ||--o{ gamemodes : ""
  games ||--o{ maps : ""
  games }o--|| game_player : ""
  skins ||--o{ game_player : ""
  heroes ||--o{ skins : ""
  players ||--o{ game_player: ""
```

## Relationsschreibweise

- gamemodes([gamemode_id], name, team_size)
- maps([map_id], name, location)- 
- games([game_id], [/gamemode_id/], [/map_id/], started, finisted, winner)
- skins([skin_id],[/hero_id/], name, rarity)
- heroes([hero_id], name, description, class)
- game_player([game_player_id], team, [/player_id/], [/game_id/], [/skin_id/])
- players([player_id], nickname,level,prestige)

