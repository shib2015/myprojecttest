<?php 
$conn   = mysqli_connect("localhost","root","","mytestdb") or die('Error');
$r = 1;
if (($handle = fopen("test2.csv", "r")) !== FALSE) {
   echo '<table>';
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
       echo '<tr>';
		echo '<td><input type="checkbox" name="approve_date" id="approve_date'.$r.'" value="'.$r.'"></td>';
        $r++;
        for ($c=0; $c < $num; $c++) {
		  if($c==0){
				$sql    = "SELECT count(`id`) AS numrow, `id` FROM `statelist` WHERE `State` = '".trim(strtoupper(($data[0])))."' LIMIT 1";
				$result = $conn->query($sql);
				$row   = $result->fetch_assoc();
				if($row["numrow"] > 0){
					$valid = 1;
					$validtxt = 'Valid';
				}else{
					$valid = 0;
					$validtxt = 'Not-valid';
				}
			}			
			echo '<td>'.$data[$c]. "</td>";
			
        }
		if($valid == 1){
			$sql0    = "SELECT count(`id`) AS numrow, `id` FROM `districtlist` WHERE `district` = '".trim($data[1])."' AND `stateid` = ".$row['id'];
			$result0 = $conn->query($sql0);
			$row0   = $result0->fetch_assoc();
			if($row0["numrow"] == 0){
			   if($data[1]!=''){
				$sql1 = "INSERT INTO `districtlist` ( `stateid`, `district`)
									VALUES (".$row['id'].",'".$data[1]."')";
						$conn->query($sql1);
				$validtxt = 'Success';
			   }else{
			   	$validtxt = 'Blank';
			   }
			}else{
				$validtxt = 'Duplicate';
			}
		}
		echo '<td>'.$validtxt."</td>";
		echo '</tr>';
    }
	echo '</table>';
	echo '<button type="button" name="btn-save">Save to DB</button>';
    fclose($handle);
}
