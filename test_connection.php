<?php

// Paramètres de connexion FTP
$ftp_server = '10.10.12.15';
$ftp_username = 'SOBCO0\cs_ftp_wincc';
$ftp_password = '8RYiZj';

/*$ftp_server = '193.70.112.49';
$ftp_username = 'debian';
$ftp_password = 'vz6SenfrKNQN';*/
// Connexion au serveur FTP
$conn_id = ftp_connect($ftp_server,'21');

// Vérification de la connexion
if ($conn_id) {
    // Authentification
    $login_result = ftp_login($conn_id, $ftp_username, $ftp_password);
    if ($login_result) {
        // Changement de répertoire
        $remote_dir = "";
        if (ftp_chdir($conn_id, $remote_dir)) {
            echo "Changement de répertoire réussi\n";

            // Liste des fichiers dans le répertoire
            $files = ftp_nlist($conn_id, ".");
            if ($files) {
                echo "Liste des fichiers dans le répertoire :\n";
                foreach ($files as $file) {
                    echo $file . "\n";
                }
            } else {
                echo "Impossible de lister les fichiers dans le répertoire\n";
            }
        } else {
            echo "Impossible de changer de répertoire\n";
        }
    } else {
        echo "Échec de l'authentification\n";
    }

    // Fermeture de la connexion FTP
    ftp_close($conn_id);
} else {
    echo "Impossible de se connecter au serveur FTP\n";
}
?>
