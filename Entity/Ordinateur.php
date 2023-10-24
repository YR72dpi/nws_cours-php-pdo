<?php
require_once ("./Lib/PDOManagerClass.php");
class Ordinateur extends PDOManagerClass {
    private $table = "ordinateur";

    public function __construct(){}

    private function setup() {
        parent::__construct("ordinateur");
    }

    public function showTable() {
        $this->setup();
        $allData = $this->findAll($this->table);
        $columnHTML = "";
        $valueHTML = "";
        if(isset($allData[0])) foreach($allData[0] as $index => $value) $columnHTML .= "<th>$index</th>";
        foreach ($allData as $key => $value) {
            $trData = "";
            foreach ($value as $data) {
                $trData .= "<td>$data</td>";
            }
            $valueHTML .= '
                <tr>
                    '.$trData.'
                </tr>
            ';
        }
        echo '
            <table>
                <thead>
                    <tr>
                        '.$columnHTML.'
                    </tr>
                </thead>
                <tbody>
                    '.$valueHTML.'
                </tbody>
            </table>
        ';
    }

}