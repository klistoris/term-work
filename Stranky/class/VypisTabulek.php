<style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }

    th {
        background-color: rgb(0, 16, 83);
        color: white;
        height: 2em;
    }

    td {
        background-color: white;
        width: 10em;
        height: 1.25em;
        text-align: center;
    }
    .radek{
        height: 3em;
    }
</style>

<?php

class VypisTabulek
{
    private $dataSet;
    private $columns;

    /**
     * VypisTabulek constructor.
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

    public function render_uzivatel()
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
                if (isset($row[$key])) {
                    echo "<td>" . $row[$key] . "</td>";
                } else {
                    ?>
                    <td style='width: 20em'>
                    <ul>
                        <li style="display: inline"><a class="tabulka_tlacitko"
                                                       href="<?= BASE_URL . "?page=uprav_uzivatele" ?>">Uprav</a></li>
                        <li style="display: inline"><a class="tabulka_tlacitko"
                                                       href="<?= BASE_URL . "?page=odeber_uzivatele" ?>">Odeber</a></li>
                    </ul></td><?php
                }

            }
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "<br>";
        ?>
        <a class="tabulka_tlacitko" href="<?= BASE_URL . "?page=pridej_uzivatele" ?>">Přidat uživatele</a><br><br>
        <?php
        echo "Počet záznamů: " . sizeof($this->dataSet);
        echo "<br>";
    }

    public function render_udalost()
    {
        foreach ($this->dataSet as $row) {
            echo "<table>";
            echo "<thead>";
            echo "<tr>";
            foreach ($this->columns as $key => $value) {
                echo "<th>" . $value["table-head-title"] . "</th>";
            }
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            echo "<tr  class='radek'>";
            foreach ($this->columns as $key => $value) {
                if (isset($row[$key])) {
                    echo "<td>" . $row[$key] . "</td>";
                }
            }
            echo "</tr>";
            echo "<tr>";
            ?>
            <td style='width: 15em' colspan="4">
            <ul>
                <li style="display: inline"><a class="tabulka_tlacitko"
                                               href="<?= BASE_URL . "?page=uprav_uzivatele" ?>">Uprav</a></li>
                <li style="display: inline"><a class="tabulka_tlacitko"
                                               href="<?= BASE_URL . "?page=odeber_uzivatele" ?>">Odeber</a></li>
            </ul></td><?php
            echo "</tr>";
            echo "</tbody>";
            echo "</table>";
            echo "<br>";

        }
        ?>
        <a class="tabulka_tlacitko" href="<?= BASE_URL . "?page=pridej_uzivatele" ?>">Přidat událost</a><br><br>
        <?php
        echo "Počet událostí: " . sizeof($this->dataSet);
        echo "<br>";

    }

}