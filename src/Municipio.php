<?php

declare(strict_types=1);

namespace CodigosPoblacion;

class Municipio
{
    public string $codigo;
    public string $provincia;
    public string $municipio;

    public function __construct(array $data)
    {
        $this->codigo = $data['codigo'];
        $this->provincia = $data['provincia'];
        $this->nombre = $data['nombre'];
    }
}
