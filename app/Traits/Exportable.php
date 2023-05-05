<?php

namespace App\Traits;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use League\Csv\CannotInsertRecord;
use League\Csv\Writer;
use SplTempFileObject;

trait Exportable
{
    /**
     * Exports a CSV from a provided resource collection
     * @param mixed $resource
     * @param string $filename
     * @return int
     * @throws CannotInsertRecord
     */
    public static function exportCSV($resource, $filename = 'export.csv'): int
    {
        $resourceCollection = new AnonymousResourceCollection($resource, static::class);
        $data = $resourceCollection->toArray(request());
        $csv = Writer::createFromFileObject(new SplTempFileObject());

        $i = 0;
        // Build the CSV
        foreach ($data as $key => $datum) {
            // Add the headers into the document
            $row = self::assocToFlat($datum);
            if ($i === 0) {
                $csv->insertOne(array_keys($row));
            }

            $csv->insertOne($row);
            $i++;
        }

        return $csv->output($filename);
    }

    /**
     * Turns an associative array into a flat array, with hierarchical key names joined by underscore
     * @param $dataRow
     * @param string $prefixKey
     * @return array
     */
    private static function assocToFlat($dataRow, $prefixKey = ''): array
    {
        $return = [];
        foreach ($dataRow as $key => $item) {
            if (!is_array($item)) {
                $return[$prefixKey . $key] = $item;
                continue;
            }

            $return = array_merge($return, self::assocToFlat($item, $prefixKey . $key . '_'));
        }

        return $return;
    }
}
