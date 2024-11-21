<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use SplFileObject;
use Symfony\Component\Console\Helper\ProgressBar;

class ImportCarsDbCommand extends Command
{
    private $tableName = 'car_db';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:import-cars-db {--filename=car-db.csv}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filename = $this->option('filename');
        if (!file_exists($filename)) {
            $this->error('File not found');
            return;
        }
        $this->info("\nGetting data from .csv");
        $lineCount = $this->getCsvLineCount($filename);
        $bar = $this->output->createProgressBar($lineCount);
        $bar->start();

        $file = fopen($filename, 'r');
        $columns = fgetcsv($file);
        $data = [];
        while (!feof($file)) {
            $data[] = fgetcsv($file);
            $bar->advance();
        }
        fclose($file);
        $bar->finish();

        $this->info("\nGetting column info");
        $columnInfo = $this->getColumnInfo($data);
        $this->info("\nCreating database table");
        $this->createTable($columns, $columnInfo);
        $this->info("\nAdding indexes");
        $this->addIndex('make');
        $this->addIndex('model');
        $this->addIndex('trim');
        $this->info("\nImporting data");
        $this->importData($data, $columns);
    }

    private function createTable($columns, $columnInfo)
    {
        DB::statement("DROP TABLE IF EXISTS {$this->tableName}");
        $sql = "CREATE TABLE {$this->tableName} (";
        foreach ($columns as $key => $column) {
            if ($key == 0) {
                $sql .= "`$column`";
            }
            else {
                $sql .= ", `$column`";
            }
            switch ($columnInfo[$key]['type']) {
                case 'integer':
                    $sql .= " integer";
                    break;
                case 'string':
                    $sql .= " varchar({$columnInfo[$key]['width']})";
            }

        }
        $sql .= ")";

        return DB::statement($sql);
    }

    private function addIndex(string $columnName)
    {
        $indexName = $this->tableName . "_" . $columnName . "_index";
        if ($this->indexExists($indexName)) {
            $this->info($indexName . ' already exists');
            return;
        }
        if (DB::statement("CREATE INDEX $indexName ON $this->tableName ($columnName);"))
        {
            $this->info($indexName . ' has been created');
        }

    }

    private function indexExists(string $indexName)
    {
        $database = env('DB_DATABASE');
        $qry = "
            SELECT COUNT(1) AS cnt
            FROM INFORMATION_SCHEMA.STATISTICS
            WHERE TABLE_NAME = '{$this->tableName}'
                AND INDEX_NAME = '$indexName'
                AND INDEX_SCHEMA='$database'";

        $result = DB::selectOne($qry);

        return $result->cnt > 0;
    }
    private function importData(array $data, $columns)
    {
        $bar = $this->output->createProgressBar(count($data));
        $bar->setFormat("%message%\n %current%/%max% [%bar%] %percent:3s%%");

        $bar->setMessage($this->getRemainingTime($bar));

        $bar->start();
        foreach ($data as $row) {
            $data = $this->getArrData($columns, $row);
            DB::table($this->tableName)->insert($data);
            $bar->setMessage($this->getRemainingTime($bar));
            $bar->advance();
        }
        $bar->finish();
    }

    private function getCsvLineCount($filename)
    {
        $file = new SplFileObject($filename, 'r');
        $file->seek(PHP_INT_MAX);

        return $file->key() + 1;
    }


    private function getArrData($columns, $line)
    {
        $result = [];
        foreach ($columns as $key => $column) {
            $result[$column] = $line[$key] ? $line[$key] :  null;
        }

        return $result;
    }

    function getColumnInfo(array $data): array
    {
        $bar = $this->output->createProgressBar(count($data));
        $bar->start();
        $columnInfo = [];

        foreach ($data as $row) {
            foreach ($row as $colIndex => $value) {
                // Initialize column information if not already set
                if (!isset($columnInfo[$colIndex])) {
                    $columnInfo[$colIndex] = [
                        'type' => 'integer',  // Assume integer initially
                        'width' => 0
                    ];
                }

                // Calculate the width of the current value
                $length = strlen((string) $value);
                if ($length > $columnInfo[$colIndex]['width']) {
                    $columnInfo[$colIndex]['width'] = $length;
                }

                // Skip empty strings when determining data type
                if ($value === "") {
                    continue;
                }

                // Determine the type: if any non-empty value is not an integer, mark column as string
                if (!is_numeric($value) || (int)$value != $value) {
                    $columnInfo[$colIndex]['type'] = 'string';
                }
            }
            $bar->advance();
        }
        $bar->finish();

        return $columnInfo;
    }

    private function getRemainingTime(ProgressBar $bar)
    {
        $remaining = $bar->getRemaining();
        $hours = floor($remaining / 3600);
        $minutes = floor(($remaining / 60) % 60);
        $seconds = $remaining % 60;

        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }

}
