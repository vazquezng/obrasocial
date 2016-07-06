<style type="text/css">
<!--
table { vertical-align: top; }
tr    { vertical-align: top; }
td    { vertical-align: top; }
.midnight-blue{
	background:#2c3e50;
	padding: 4px 4px 4px;
	color:white;
	font-weight:bold;
	font-size:12px;
}
.silver{
	background:white;
	padding: 3px 4px 3px;
}
.clouds{
	background:#ecf0f1;
	padding: 3px 4px 3px;
}
.border-top{
	border-top: solid 1px #bdc3c7;

}
.border-left{
	border-left: solid 1px #bdc3c7;
}
.border-right{
	border-right: solid 1px #bdc3c7;
}
.border-bottom{
	border-bottom: solid 1px #bdc3c7;
}
table.page_footer {width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;}
}
-->
</style>
<page backtop="15mm" backbottom="15mm" backleft="15mm" backright="15mm" style="font-size: 12pt; font-family: arial" >
    <page_footer>
        <table class="page_footer">
            <tr>

                <td style="width: 50%; text-align: left">
                    P&aacute;gina [[page_cu]]/[[page_nb]]
                </td>
                <td style="width: 50%; text-align: right">
                    &copy; <?php echo "obrasocial "; echo  $anio=date('Y'); ?>
                </td>
            </tr>
        </table>
    </page_footer>
    <table cellspacing="0" style="width: 100%;">
        <tr>

            <td style="width: 25%; color: #444444;">
                <!--img style="width: 100%;" src="../../img/logo.jpg" alt="Logo"--><br>

            </td>
			<td style="width: 50%; color: #34495e;font-size:12px;text-align:center">
                <span style="color: #34495e;font-size:14px;font-weight:bold"><?php echo $liquidacion['provider']['name'];?></span>
				<br><?php echo $liquidacion['provider']['address'];?><br>
				<?php echo $liquidacion['provider']['specialties_name'];?>

            </td>
			<td style="width: 25%;text-align:right">
			Month <?php echo $month;?>
			</td>

        </tr>
    </table>
    <br>



    <table  class="table table-hover" cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        <tr class='midnight-blue' style="width: 100%;padding:10px">
           <td>LIQUIDACIÓN</td>
		   <td></td>
		   <td></td>
		   <td></td>
        </tr>
		<tr style="width: 100%;">
           <td style="padding:0 10px">Monto Basico</td>
		   <td style="padding:0 10px"></td>
		   <td style="padding:0 10px"></td>
		   <td style="padding:0 10px">$<?php echo $liquidacion['basic']?></td>
        </tr>
		<?php foreach ($liquidacion['list'] as $value) { ?>
			<tr style="width: 100%;">
	           <td style="padding:0 10px">
				   <?php echo $value['patient']?>
			   </td>
			   <td style="padding:0 10px"><?php echo $value['type']?></td>
			   <td style="padding:0 10px"> <?php echo $value['date']?> </td>
			   <td style="padding:0 10px"> $<?php echo $value['price']?></td>
	        </tr>
		<?php
			}
		?>
		<tr style="width: 100%;">
           <td style="padding:0 10px">Total</td>
		   <td style="padding:0 10px"></td>
		   <td style="padding:0 10px"></td>
		   <td style="padding:0 10px">$<?php echo $liquidacion['total']?></td>
        </tr>
    </table>
	<br>
	<div style="font-size:11pt;text-align:center;font-weight:bold">Gracias por su servicio!</div>
</page>
