<?php
    require "../private/init.php";

    const type = ["character", "accessory"]; // 0 => "Character", 1 => "Accessory";

    $query = "select * from game_entries where name like :search";
    $params = ['search' => "%".$_POST['search']."%"];
    if (isset($_POST['type']) && $_POST['type'] != '') {
        $query .= ' and type = :type';
        $params['type'] = $_POST['type'];
    }

    $db = new DB();
    $game_entries = $db->read($query, $params);
    if ((is_array($game_entries) && count($game_entries) > 0))
    {
        if ($_POST['displaytype'] == 0) {
            foreach($game_entries as $entry) {
                echo '<li><a href="/'.type[$entry['type']].'/'.$entry['name'].'">'.$entry['name'].'</a></li>';
            }
        }
        else
        {
            foreach($game_entries as $entry) {
                echo '<tr>';
                echo '<td><a href="/'.type[$entry['type']].'/'.$entry['name'].'">'.$entry['name'].'</a></td>';
                echo '<td>'.ucfirst(type[$entry['type']]).'</td>';
                echo '<td>'.$entry['description'].'</td>';

                echo '<td>'.$entry['health'].'</td>';
                echo '<td>'.$entry['strength'].'</td>';
                echo '<td>'.$entry['constitution'].'</td>';
                echo '<td>'.$entry['intelligence'].'</td>';
                echo '<td>'.$entry['charisma'].'</td>';
                echo '<td>'.$entry['requirement'].'</td>';
                echo '</tr>';
            }
        }
    }
?>