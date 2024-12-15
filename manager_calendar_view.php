<div class="table-container">
    <table class="styled-table">
        <thead>
            <tr>
                <th>Name</th>
                <?php
                    for ($i=1; $i <= $number_of_days; $i++) { 
                        echo "<th>" . $i . "</th>";
                    }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($data as $row) {
                    echo "<tr>";
                    echo "<td>" . $row["name"] . "</td>";
                    $month_from_db = explode("-",$row["start_date"])[1];
                    $year_from_db = explode("-",$row["start_date"])[0];
                    $date_from_db = explode("-",$row["start_date"])[2];
                    if($month_from_db == $month + 1 and $year_from_db == $year) {
                        for ($i=1; $i <= $number_of_days; $i++) {
                            if (in_array($i,range($date_from_db, $date_from_db + $row["date_difference"]))) {
                                echo "<td><i class='material-icons' style='color: green;'>check_circle</i></td>"; //"<i class='material-icons'></i>";
                            } else {
                                echo "<td><i class='material-icons' style='color: red;'>cancel</i></td>"; //"<i class='material-icons'></i>";
                            }
                        }
                    }
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</div>