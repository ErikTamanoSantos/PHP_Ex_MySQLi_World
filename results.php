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
            $consulta = "SELECT * FROM city WHERE CountryCode ='" .$_POST["codi_pais"]. "';";
    
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

            <?php
                echo "<h1> Ciutats de ".$_POST["codi_pais"]."</h1>";
                echo "<table>\n";
                # (3.2) Bucle while
                while( $registre = mysqli_fetch_assoc($resultat) )
                {
                    # els \t (tabulador) i els \n (salt de línia) son perquè el codi font quedi llegible
        
                    # (3.3) obrim fila de la taula HTML amb <tr>
                    echo "\t<tr>\n";
        
                    # (3.4) cadascuna de les columnes ha d'anar precedida d'un <td>
                    #	després concatenar el contingut del camp del registre
                    #	i tancar amb un </td>
                    echo "\t\t<td>".$registre["Name"]."</td>\n";
                    echo "\t\t<td>".$registre['CountryCode']."</td>\n";
                    echo "\t\t<td>".$registre["District"]."</td>\n";
                    echo "\t\t<td>".$registre['Population']."</td>\n";
        
                    # (3.5) tanquem la fila
                    echo "\t</tr>\n";
                }
                echo "</table>\n";
            ?>
    </main>
</body>
</html>