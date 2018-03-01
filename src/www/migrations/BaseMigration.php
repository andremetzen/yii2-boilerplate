<?php

namespace app\migrations;

use yii\db\Migration;

class BaseMigration extends Migration
{

    protected function importSql($path, $conn = null)
    {
        if (!$conn) {
            $conn = $this->db;
        }

        if (file_exists($path)) {
            $sql = explode(";\n", file_get_contents($path));

            foreach ($sql as $s) {
                if (trim($s) != "") {
                    $conn->createCommand($s)->execute();
                }
            }

            return true;
        } else {
            return false;
        }
    }

}