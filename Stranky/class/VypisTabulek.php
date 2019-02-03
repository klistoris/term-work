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

    .spravaUdalosti{
        width: 15em;
        background-color: steelblue;
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

    public function render_auto()
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
            $i = 0;
            foreach ($this->columns as $key => $value) {
                if (isset($row[$key])) {
                    echo "<td>" . $row[$key] . "</td>";
                } else {
                    if ($i == 0){
                        ?>
                        <td style='height: 3em' class="spravaUdalosti">
                            <a class="tabulka_tlacitko" href="<?= BASE_URL . "?page=uprav_auto&action=uprava&id={$row['idauto']}"?>">Uprav</a>
                        </td>
                        <?php
                    } else{
                        ?>
                        <td style='height: 3em' class="spravaUdalosti">
                            <a class="tabulka_tlacitko" href="<?= BASE_URL . "?page=odeber_auto&action=odebrat&id={$row['idauto']}" ?>">Odeber</a>
                        </td>
                        <?php
                    }
                    $i++;
                }

            }
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "<br>";
        ?>
        <a class="tabulka_tlacitko" href="<?= BASE_URL . "?page=pridej_auto" ?>">Přidat auto</a><br><br>
        <?php
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
            $i = 0;
            foreach ($this->columns as $key => $value) {
                if (isset($row[$key])) {
                    echo "<td>" . $row[$key] . "</td>";
                } else {
                    if ($i == 0){
                        ?>
                        <td style='height: 3em' class="spravaUdalosti">
                            <a class="tabulka_tlacitko"
                               href="<?= BASE_URL . "?page=uprav_uzivatele&action=uprava&id={$row['idOsoba']}" ?>">Uprav</a>
                        </td>

                        <?php
                    } else{
                        ?>
                        <td style='height: 3em' class="spravaUdalosti">
                            <a class="tabulka_tlacitko"
                           href="<?= BASE_URL . "?page=odeber_uzivatele&action=odebrat&id={$row['idOsoba']}" ?>">Odeber</a>
                        </td>
                        <?php
                    }
                    $i++;
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

    public function render_uzivatel_email()
    {
        if ($this->dataSet != null)
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
                                                           href="<?= BASE_URL . "?page=uprav_uzivatele&action=uprava&id={$row['idOsoba']}" ?>">Uprav</a>
                            </li>
                            <li style="display: inline"><a class="tabulka_tlacitko"
                                                           href="<?= BASE_URL . "?page=odeber_uzivatele&action=odebrat&id={$row['idOsoba']}" ?>">Odeber</a>
                            </li>
                        </ul></td><?php
                    }

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

            <td class="spravaUdalosti" colspan="5" style='height: 3em'>
            <ul>
                <li style="display: inline"><a class="tabulka_tlacitko"
                                               href="<?= BASE_URL . "?page=uprav_udalost&action=uprava&id={$row['id_udalost']}" ?>">Uprav</a></li>
                <li style="display: inline"><a class="tabulka_tlacitko"
                                               href="<?= BASE_URL . "?page=odeber_udalost&action=odeber&id={$row['id_udalost']}" ?>">Odeber</a></li>
            </ul></td><?php
            echo "</tr>";
            echo "</tbody>";
            echo "</table>";
            echo "<br>";

        }
        ?>
        <a class="tabulka_tlacitko" href="<?= BASE_URL . "?page=pridej_udalost" ?>">Přidat událost</a><br><br>
        <?php
        echo "Počet událostí: " . sizeof($this->dataSet);
        echo "<br>";

    }

    public function render_udalost_registrovany()
    {
        $uzivatel = new Uzivatel(Pripojeni::getPdoInstance());
        $i = 0;
        foreach ($this->dataSet as $row) {
            if ($uzivatel->ucastnimSeUdalosti($row['id_udalost'])) {

            }else{
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
                <td class="spravaUdalosti" colspan="5" style='height: 3em'>
                <ul>
                    <li style="display: inline"><a class="tabulka_tlacitko"
                                                   href="<?= BASE_URL . "?page=udalost_zucastnit_se&action=mam_auto&id={$row['id_udalost']}" ?>">Zúčastnit se</a></li>

                </ul></td><?php
                echo "</tr>";
                echo "</tbody>";
                echo "</table>";
                echo "<br>";
                $i++;
            }
        }
        if ($i==0){
            echo "<br>";
            echo "<h3>Nejsou žádné události k registraci</h3>";
            echo "<br>";
        }
        echo "<br>";

    }

    public function render_udalost_registrovany_ucast()
    {
        $uzivatel = new Uzivatel(Pripojeni::getPdoInstance());
        $i = 0;
        foreach ($this->dataSet as $row) {
            if($uzivatel->ucastnimSeUdalosti($row['id_udalost'])) {
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
                <td class="spravaUdalosti" colspan="5" style='height: 3em'>
                <ul>
                    <li style="display: inline"><a class="tabulka_tlacitko"
                                                   href="<?= BASE_URL . "?page=uprav_udalost&action=uprava&id={$row['id_udalost']}" ?>">Odhlásit
                            se z události</a></li>

                </ul></td><?php
                echo "</tr>";
                echo "</tbody>";
                echo "</table>";
                echo "<br>";
                $i++;
            }

        }
        if ($i==0){
            echo "<br>";
            echo "<h3>Nejste přihlášen k žádné události</h3>";
            echo "<br>";
        }

        echo "<br>";

    }

}