<?php

    $server="localhost";

    $user="root";

    $password="";

    $database="database bimbel azwana 2026_05_01";

    $con=mysqli_connect($server,$user,$password,$database);

    $url_artikel = "http://localhost/AZWANA/public_html/";

    if (!function_exists('randomColor')) {
        function randomColor()
        {
            $rcolor = '#';
            for ($i = 0; $i < 6; $i++) {
                $rNumber = rand(0, 15);
                if ($rNumber >= 10) {
                    $rcolor .= strtoupper(dechex($rNumber));
                } else {
                    $rcolor .= $rNumber;
                }
            }
            return $rcolor;
        }
    }

    if (!function_exists('track_pengunjung')) {
        function track_pengunjung($con, $sessionId, $visitTitle)
        {
        date_default_timezone_set('Asia/Jakarta');
        $time = date('H:i:sa');
        $tgl = date('Y-m-d');

        $sessionId = mysqli_real_escape_string($con, $sessionId);
        $visitTitle = mysqli_real_escape_string($con, $visitTitle);
        $tgl = mysqli_real_escape_string($con, $tgl);

        $visitorQuery = mysqli_query($con, "SELECT `warna` FROM `pengunjung` WHERE `session`='" . $sessionId . "' ORDER BY `id` DESC LIMIT 1");
        $warna = null;
        if ($visitorQuery && ($row = mysqli_fetch_assoc($visitorQuery))) {
            $warna = $row['warna'];
        }

        if (!$warna) {
            $warna = randomColor();
        }

        $dateQuery = mysqli_query($con, "SELECT `value` FROM `date` WHERE `date`='" . $tgl . "' LIMIT 1");
        if (!$dateQuery) {
            return false;
        }

        if (mysqli_num_rows($dateQuery) === 0) {
            $maxIdResult = mysqli_query($con, "SELECT MAX(`id`) AS max_id FROM `date`");
            $newId = 1;
            if ($maxIdResult && ($maxIdRow = mysqli_fetch_assoc($maxIdResult))) {
                $newId = ((int) $maxIdRow['max_id']) + 1;
                if ($newId < 1) {
                    $newId = 1;
                }
            }
            mysqli_query($con, "INSERT INTO `date` (`id`,`date`,`value`) VALUES ('" . $newId . "','" . $tgl . "', 1)");
            mysqli_query($con, "DELETE FROM `pengunjung` WHERE `date` != '" . $tgl . "'");
        } else {
            $countResult = mysqli_query($con, "SELECT COUNT(*) AS total FROM `pengunjung` WHERE `date`='" . $tgl . "'");
            $count = 0;
            if ($countResult && ($countRow = mysqli_fetch_assoc($countResult))) {
                $count = (int) $countRow['total'];
            }
            mysqli_query($con, "UPDATE `date` SET `value`='" . ($count + 1) . "' WHERE `date`='" . $tgl . "'");
        }

        mysqli_query(
            $con,
            "INSERT INTO `pengunjung` (`date`,`time`,`value`,`visit`,`warna`,`session`) VALUES ('" . $tgl . "','" . $time . "',1,'" . $visitTitle . "','" . $warna . "','" . $sessionId . "')"
        );

        return true;
    }
}

?>