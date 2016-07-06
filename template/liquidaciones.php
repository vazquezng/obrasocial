<?php
include_once 'head.php';
?>


<div class="container">
        <div class="navbar">
            <div class="navbar-inner">
                <a class="brand" href="#">Liquidaciones</a>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="row">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Mes</th>
                                <th>Abrir</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i = 0;
                        while ($months[$i] !== $currentMonth) {
                               echo '<tr>
                                        <td>' . $months[$i] . '</td>
                                        <td><a href="/pdf/documentos/liquidacion_pdf.php?idPrestador='.$idProvider.'&mes=' . $months[$i] . '">liquidacion</a></td>
                                    </tr>';
                                $i++;
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php
include_once 'footer.php';
?>
