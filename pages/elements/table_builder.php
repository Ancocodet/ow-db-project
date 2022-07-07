<?php

class TableBuilder
{

    private array $table_heads;
    private array $table_elements;

    public function __construct(array $table_heads, array $table_elements)
    {
        $this->table_heads = $table_heads;
        $this->table_elements = $table_elements;
    }

    public function build() : string{
        return '<table class="table">'
            .$this->buildHead()
            .$this->buildBody()
        .'</table>';
    }

    private function buildBody() : string{
        $rows = "";
        foreach ($this->table_elements as $element)
        {
            $row = "<tr>";
            for($i = 0; $i < count($element); $i++){
                if($i == 0){
                    $row .= "<th>$element[$i]</th>";
                }else{
                    $row .= "<td>$element[$i]</td>";
                }
            }
            $rows .= $row . "</td>";
        }
        return "<thead><tr>$rows</tr></thead>";
    }

    private function buildHead() : string
    {
        $heads = "";
        foreach ($this->table_heads as $head)
        {
           $heads .= "<th scope='col'>$head</th>";
        }
        return "<thead><tr>$heads</tr></thead>";
    }

}