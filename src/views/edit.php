<form action="/user/edit/<?= $user['id'] ?> "method= POST>

    <input type="hidden" name="id" value="<?= $user['id'] ?>">
    
    <label for="nom">Nom :</label>
    <input type="text" name="nom" value="<?= $user['nom'] ?>">

    <label for="prenom">Prénom :</label>
    <input type="text" name="prenom" value="<?= $user['prenom'] ?>">

    <label for="email">Email :</label>
    <input type="text" name="email" value="<?= $user['email'] ?>">

    <label for="password">Password :</label>
    <input type="text" name="password" value="<?= $user['password'] ?>">

    <label for="role">Role :</label>
    <select name="id_role">
            <option value=""></option>
        <?php
        foreach ($roles as $role) {
            if($user['id_role'] == $role['id']){
                echo "<option value=".$role["id"]." selected>".$role["libelle"]."</option>";
            } else {
                echo "<option value=".$role["id"].">".$role["libelle"]."</option>";
            }
        }
        ?>
        </select>
    <button type="submit">Valider</button>
</form>
