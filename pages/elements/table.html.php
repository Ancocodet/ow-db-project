<table class="table">
    <thead>
        <tr>
            <?php
            foreach ($table_head as $head)
            {
                echo "<th scope='col'>$head</th>";
            }
            ?>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($table_elements as $element)
        {
            echo "<tr>";
            for($i = 0; $i < count($element); $i++){
                if($i == 0){
                    echo "<th>$element[$i]</th>";
                }else{
                    echo "<td>$element[$i]</td>";
                }
            }
            echo "</tr>";
        }
        ?>
    </tbody>
</table>