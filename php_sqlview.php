<?php
$conn = mysqli_connect("localhost","root","","mage_svblivenew");
?>

<?php
$sql = "Select * from myView where name like 'c%' limit 50";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
?>
<table>
 <thead>
 	<tr bgcolor="#66aa55">
		<th>SKU</th>
		<th>PRODUCT</th>
		<th>DESCRIPTION</th>
	</tr> 
	</thead>
 <tbody>
<?php
$i=0;
while($row = mysqli_fetch_assoc($result)) { 
$bgcl=($i%2==0)?"#c7a3fc":"ffffff";
?>
<tr bgcolor='<?php echo $bgcl; ?>'>
		<td><?php echo $row["sku"]; ?></td>
		<td><?php echo $row["name"]; ?></td>
		<td><?php echo $row["description"]; ?></td>
	</tr>

<?php
$i++;
	}
	?>
	</tbody>
</table>
<?php
	}
	?>