<?php
	foreach ($data_array as $data) {
		?>
		<tr id="row_<?php echo $data->CustomerActivityID; ?>">                                      
			<td align="center"><?php echo $data->MethodName; ?></td>  
			<td align="center"><?php echo $data->UserName . " " .$data->Description; ?></td>
			<td align="center"><?php echo ($data->CreatedDate!="")?GetDateTimeInFormat($data->CreatedDate):''; ?></td>
		</tr>
<?php }
?>  
