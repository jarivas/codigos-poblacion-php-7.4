<?php

declare(strict_types=1);

namespace CodigosPoblacion\Install;

use CodigosPoblacion\Helpers\InstallHelper;
use CodigosPoblacion\Models\Provincia;
use CodigosPoblacion\Models\Municipio;
use CodigosPoblacion\Models\Database\Municipio as DbMunicipio;
use Exception;

class CsvImporter
{
    /**
     * Reads provincia from the csv file
     * @return Provincia[]|string
     */
    public static function readProvincias(): array|string
    {
        /**
         * @var Provincia[] $data
         */
        $data = self::readCsv('provincias.csv', Provincia::class);
        $result = [];

        foreach ($data as $item) {
            $result[$item->codigo] = $item;
        }

        return $result;
    }

    public static function import(): string|int
    {
        $count = 0;
        $provincias = self::readProvincias();

        if (is_string($provincias)) {
            return $provincias;
        }

        $municipios = self::readCsv('municipios.csv', Municipio::class);

        if (is_string($municipios)) {
            return $municipios;
        }

        try {
            foreach ($municipios as $municipio) {
                $codigo = $municipio->codigo;
                $provincia = $provincias[$codigo]->nombre;
                $nombre = $municipio->nombre;

                $data = [
                    'codigo' => $codigo . $municipio->codigo_municipio,
                    'codigo_control' => $municipio->codigo_control,
                    'provincia' => $provincia,
                    'nombre' => $nombre,
                    'nombre_provincia' => self::cleanString("$provincia $nombre")
                ];

                $dbModel = new DbMunicipio($data);
                $dbModel->save();
                ++$count;
            }

        } catch (Exception $e) {
            return $e->getMessage();
        }

        return $count;
    }

    private static function readCsv(string $fileName, string $modelClass): array|string
    {
        $result = [];

        try {
            $path = self::validateCsvFileExist($fileName);
            $handle = fopen($path, "r");
            $line = [];

            if ($handle === false) {
                throw new Exception("Fail opening CSV file $fileName");
            }

            $headers = self::getCsvHeaders($handle);

            while ($line = fgetcsv($handle, 1000, ',')) {
                $data = array_combine($headers, $line);

                $result[] = new $modelClass($data);
            }

        } catch (Exception $e) {
            return $e->getMessage();
        }

        return $result;
    }

    /**
     * Checks if the configured file exists throw an exception on case of error
     * @throws \Exception
     * @param string $fileName
     * @return string Path to the file
     */
    public static function validateCsvFileExist(string $fileName): string
    {
        $env = InstallHelper::getEnv();

        if (is_string(value: $env)) {
            throw new Exception($env);
        }

        $path = InstallHelper::getDataDir() . $fileName;

        if (!file_exists($path)) {
            throw new Exception("csv file does not exists: $path");
        }

        return $path;
    }

    /**
     * Read the first line to get cols or headers
     * @param mixed $handle
     * @throws \Exception
     * @return array
     */
    private static function getCsvHeaders(mixed $handle): array
    {
        $headers = fgetcsv($handle, 1000, ",");

        if (empty($headers)) {
            throw new Exception('The first line on the CSV is corrupt');
        }

        return $headers;
    }

    private static function cleanString(string $string): string
    {
        $string = trim($string);
        $string = strtolower($string);
        $string = iconv('UTF-8', 'ASCII//TRANSLIT', $string);

        return $string;
    }
}