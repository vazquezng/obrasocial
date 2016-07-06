<?php
include_once 'head.php';
?>


<div class="container">
        <div class="navbar">
            <div class="navbar-inner">
                <a class="brand" href="#">Prestadores</a>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="row">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>nombre</th>
                                <th>liquidacion</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($providers->getProviders() as $provider) {
                               echo '<tr>
                                        <td>' . $provider['id'] . '</td>
                                        <td>' . $provider['name'] . '</td>
                                        <td><a href="/prestadores/liquidaciones/'.$provider['id'].'">liquidacion</a></td>
                                    </tr>';
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
