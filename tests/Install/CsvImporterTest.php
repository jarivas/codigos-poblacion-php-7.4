<?php

declare(strict_types=1);

namespace CodigosPoblacion\Tests\Install;

use PHPUnit\Framework\TestCase;
use CodigosPoblacion\Install\CsvImporter;
use CodigosPoblacion\Models\Database\Connection;

class CsvImporterTest extends TestCase
{
    public function test_import(): void
    {
        $result = CsvImporter::import();

        $this->assertIsInt($result);
        $this->assertGreaterThan(0, $result);
    }

    protected function setUp(): void
    {
        $connection = Connection::getInstance();

        $connection->exec('DELETE FROM municipio');
    }
}