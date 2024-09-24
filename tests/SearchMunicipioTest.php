<?php

declare(strict_types=1);

namespace CodigosPoblacion\Tests;

use PHPUnit\Framework\TestCase;
use CodigosPoblacion\SearchMunicipio;

class SearchMunicipioTest extends TestCase
{
    public function test_search(): void
    {
        $search = new SearchMunicipio();

        $result = $search->search('31', 'mal');
        
        $this->assertIsArray($result);

        $this->assertGreaterThan(1, count($result));

        $data = $result[0];

        $this->assertObjectHasAttribute('codigo', $data);
        $this->assertObjectHasAttribute('provincia', $data);
        $this->assertObjectHasAttribute('nombre', $data);
    }

    public function test_get_provincias(): void
    {
        $search = new SearchMunicipio();

        $result = $search->getProvincias();
        
        $this->assertIsArray($result);

        $data = $result[0];
        

        $this->assertObjectHasAttribute('id', $data);
        $this->assertObjectHasAttribute('nombre', $data);
        $this->assertObjectHasAttribute('fullText', $data);

    }
}
