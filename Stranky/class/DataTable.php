<style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    th{
        background-color: rgb(0, 16, 83);
        color: white;
        height: 2em;
    }
    td{
        background-color: white;
        width: 10em;
        height: 1.25em;
        text-align: center;
    }
</style>

<?php

class DataTable
{
    private $dataSet;
    private $columns;

    /**
     * DataTable constructor.
     * @param array $dataSet
     */
    public function __construct($dataSet)
    {
        $this->dataSet = $dataSet;
    }

    public function addColumn($databaseColumnName, $tableHeadTitle)
    {
        $this->columns[$databaseColumnName] = array("table-head-title" => $tableHeadTitle);
    }

    public function render()
    {
        echo "<table>";
        echo "<thead>";
        echo "<tr>";
        foreach ($this->columns as $key => $value) {
            echo "<th>" . $value["table-head-title"] . "</th>";
        }
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        foreach ($this->dataSet as $row) {
            echo "<tr>";
            foreach ($this->columns as $key => $value) {
                echo "<td>" . $row[$key] . "</td>";
            }
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "<br>";
        echo "Počet záznamů: " . sizeof($this->dataSet);
        echo "<br>";
    }
}