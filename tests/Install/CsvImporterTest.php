<?php

declare(strict_types=1);

namespace CodigosPoblacion\Tests\Install;

use PHPUnit\Framework\TestCase;
use CodigosPoblacion\Install\CsvImporter;

class CsvImporterTest extends TestCase
{
    public function test_import(): void
    {
        $result = CsvImporter::import();

        $this->assertNull($result);
    }
}