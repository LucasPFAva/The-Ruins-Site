<?php
    const type = ["character", "accessory"]; // 0 => "Character", 1 => "Accessory";

    $name = '';
    $type = 0;
    $description = '';
    
    $health = '';
    $strength = '';
    $constitution = '';
    $intelligence = '';
    $charisma = '';
    $requirement = '';

    $db = new DB();
    $character = $db->read("select * from game_entries where name = :search limit 1", ['search' => $URL[1]])[0];
    if ((is_array($character) && count($character) > 0))
    {
        $name = $character['name'];
        $type =  $character['type'];
        $description = $character['description'];

        if ($character['health'])
            $health = $character['health'];
        else
            $health = 'none';

        if ($character['strength'])
            $strength = $character['strength'];
        else
            $strength = 'none';

        if ($character['constitution'])
            $constitution = $character['constitution'];
        else
            $constitution = 'none';

        if ($character['intelligence'])
            $intelligence = $character['intelligence'];
        else
            $intelligence = 'none';

        if ($character['charisma'])
            $charisma = $character['charisma'];
        else
            $charisma = 'none';

        if ($character['requirement'])
            $requirement = $character['requirement'];
        else
            $requirement = 'none';
    }
?>
<h1><?=$name?></h1>
<p>Type: <?=type[$type]?></p>
<p>Description: <?=$description?></p>
<h2>Stats</h2>
<p>Health: <?=$health?></p>
<p>Strength: <?=$strength?></p>
<p>Constitution: <?=$constitution?></p>
<p>Intelligence: <?=$intelligence?></p>
<p>Charisma: <?=$charisma?></p>
<p>Requirement: <?=$requirement?></p>

<a href="<?=base()?>characters">back</a>