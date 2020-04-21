<?php
    session_start();
    // $dsn = "mysql:host=localhost;dbname=id10853538_modernedatabases";
    // $user = "id10853538_modernedatabase";
    // $passwd = "F3O=]Iy?M(x~eArn";
    //
    // $link = new PDO($dsn, $user, $passwd);
    //
    // $statement = $link->prepare('INSERT INTO testtable (name, lastname, age)
    //     VALUES (:fname, :sname, :age)');
    //
    // $statement->execute([
    //     'fname' => 'Bob',
    //     'sname' => 'Desaunois',
    //     'age' => '18',
    // ]);

    if (isset($_POST['type'])) {
        if ($_POST['type'] == "next") {
            ?>
            <!DOCTYPE html>

            <head>
                <!-- <meta http-equiv="refresh" content="0;URL=mem.php"> -->
            </head>
            <html>

            <body>
            Next Q
            </body>

            </html>
<?php
        } else {?>
            <!DOCTYPE html>

            <head>
                <!-- <meta http-equiv="refresh" content="0;URL=thanks.php"> -->
            </head>
            <html>

            <body>
                Submit answer
            </body>

            </html>
<?php   }
    } else {?>
    <!DOCTYPE html>

    <head>
    </head>
    <html>

    <body>
        What are you doing here?
    </body>

    </html>
<?php }?>
