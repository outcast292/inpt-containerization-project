<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projet Conteneurisation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</head>

<body>



    <div class="container">
        <div class="row mt-5">
            <div class="alert alert-info col-12">
                une application qui affiche une liste des universités au Maroc </div>

        </div>
        <?php
        require_once("php/db.php");
        if (isset($_POST["name"]) && isset($_POST["domain"])) {
            if (!empty($_POST['name'])) {
                $uploaddir = 'imgs/';
                $uploadfile = $uploaddir . basename($_FILES['image']['name']);
                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
                    $sql = "INSERT INTO universities (name_u, domain_u, img) VALUES (?,?,?)";
                    if ($conn->prepare($sql)->execute([$_POST["name"], $_POST["domain"], $uploadfile])) {
        ?>
                        <div class="row mt-5">
                            <div class="alert alert-success col-12 alert-dismissible fade show">
                                l'université a ete ajoutée avec succès </div>

                        </div>
        <?php
                    }
                } else {
                    echo "Attaque potentielle par téléchargement de fichiers.  Voici plus d'informations :\n";
                    print_r($_FILES);
                }
            }
        }

        ?>
        <fieldset>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group row">
                    <label for="text" class="col-4 col-form-label">Nom de l'université</label>
                    <div class="col-8">
                        <input id="text" name="name" type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="text" class="col-4 col-form-label">Nom du domaine</label>
                    <div class="col-8">
                        <input id="text" name="domain" placeholder="x.ac.ma" type="text" required="required" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="text" class="col-4 col-form-label">Image</label>
                    <div class="col-8">
                        <input id="image" name="image" type="file" accept="image/*" required="required" class="form-file-control">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="offset-4 col-8">
                        <button name="submit" type="submit" class="btn btn-block btn-primary">Ajouter</button>
                    </div>
                </div>
            </form>
        </fieldset>


        <h3>Tableau des universités</h3>
        <hr>
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Domain</th>
                    <th>Photo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM universities";
                foreach ($conn->query($sql) as $row) {
                ?>
                    <tr>
                        <td><?= $row["id"]  ?></td>
                        <td><?= $row["name_u"] ?></td>
                        <td><a href="<?= $row["domain_u"] ?>"><?= $row["domain_u"] ?></a></td>
                        <td><img src="<?= $row["img"] ?>" class="img-thumbnail" height="100" width="100" alt="" srcset=""></td>
                    </tr>

                <?php

                }

                ?>

            </tbody>
        </table>

    </div>
</body>

</html>