<?php

declare(strict_types=1);

namespace CodigosPoblacion;

class Provincia
{
    public int $id;
    public string $nombre;
    public string $fullText;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->nombre = $data['nombre'];
        $this->fullText = $data['fullText'];
    }
}
