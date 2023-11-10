<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <main>
        <?php
            # (1.1) Connectem a MySQL (host,usuari,contrassenya)
            $conn = mysqli_connect('localhost','erik','Thyr10N191103!--');
    
            # (1.2) Triem la base de dades amb la que treballarem
            mysqli_select_db($conn, 'world');
    
            # (2.1) creem el string de la consulta (query)
            $consulta = "SELECT * FROM country;";
    
            # (2.2) enviem la query al SGBD per obtenir el resultat
            $resultat = mysqli_query($conn, $consulta);
    
            # (2.3) si no hi ha resultat (0 files o bé hi ha algun error a la sintaxi)
            #     posem un missatge d'error i acabem (die) l'execució de la pàgina web
            if (!$resultat) {
                    $message  = 'Consulta invàlida: ' . mysqli_error($conn) . "\n";
                    $message .= 'Consulta realitzada: ' . $consulta;
                    die($message);
            }
        ?>
        <h1>Filtre de ciutats per país</h1>
        <form method="POST" action="results.php">
            <select name="codi_pais">
                <?php 
                    while( $registre = mysqli_fetch_assoc($resultat) )
                    {
                        echo "\t\t<option value=".$registre["Code"].">".$registre["Name"]."</option>\n";
                    }
                ?>
            </select>

            <input type="submit">
        </form>

    </main>
</body>
</html>