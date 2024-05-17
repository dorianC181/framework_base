<form action="/user/add" method="POST">
    <label for="nom">Nom :</label>
    <input type="text" name="nom">

    <label for="prenom">Prénom :</label>
    <input type="text" name="prenom">

    <label for="email">Email :</label>
    <input type="text" name="email">

    <label for="password">Password :</label>
    <input type="text" name="password">

    <label for="role">Role :</label>
    <select name="id_role">
            <option value=""></option>
        <?php
        foreach ($roles as $role) {
            echo "<option value=".$role["id"].">".$role["libelle"];
        }
        ?>
        </select>
    <button type="submit">Valider</button>
</form>
