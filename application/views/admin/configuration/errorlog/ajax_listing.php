<?php foreach ($data_array as $data) { ?>
	<tr id="row_<?php echo $data->ErrorLogID; ?>">                                      
		
		<td align='center'><?php echo $data->MethodName; ?></td>  
		<td align='center'><?php echo $data->ErrorMessage; ?></td>
		<td align="center"><?php echo ($data->CreatedDate!="")?GetDateTimeInFormat($data->CreatedDate):''; ?></td>

	</tr>
<?php }
?>