<?php

echo"<table>";
echo "<thead>
        <tr>
            <th>Date</th>
            <th>Work Description</th>
            <th>Hours</th>
            <th>Charge Code</th>
            <th>Activity Code</th>
            <th>Approved By</th>
        </tr>
      <thead>";
echo "<tbody>";
foreach ($data as $key => $value){
    echo"<tr>";
        echo"<td>".$value['date']."</td>";
        echo"<td>".$value['desc_work']."</td>";
        echo"<td>".$value['hours']."</td>";
        echo"<td>".$value['charge_code']."</td>";
        echo"<td>".$value['activity']."</td>";
        echo"<td>".$value['approvedby']."</td>";
    echo"</tr>";
}
echo "</tbody>";
echo"</table>";
?>
