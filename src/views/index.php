<h1><?= $title ?>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Mot de passe</th>
        </tr>
    </thead>
<tbody>
    <?php 
    foreach($users as $v) { 
        echo "<tr>";
        foreach($v as $vv) {
            echo "<td>".$vv."</td>"; 
        }
       echo "</tr>";
    }
    ?>
</tbody>
</table>