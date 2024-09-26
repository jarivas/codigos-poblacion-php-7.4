<?php

declare(strict_types=1);

namespace CodigosPoblacion;


class SearchMunicipio
{
    private Connection $connection;

    /**
     * It requires $query length would be longer than 3, search on provincias name and municipio name
     * @param string $provinciaId
     * @param string $query
     * @return Municipio[]|null
     */
    public function search(string $provinciaId, string $query, int $offset = 0, int $limit = 100): ?array
    {
        if (strlen($query) < 3) {
            return null;
        }

        $this->setConnection();

        $sql = $this->getSql($provinciaId, $query, $offset, $limit);

        return $this->connection->query($sql, Municipio::class);
    }

    public function getProvincias(): ?array
    {
        $this->setConnection();

        return $this->connection->query('SELECT id, nombre, "fullText" FROM provincia', Provincia::class);
    }

    private function setConnection(): void
    {
        $dir = __DIR__;
        $path = "$dir/data/database.sqlite";

        $this->connection = new Connection($path);
    }

    private function getSql(string $provinciaId, string $query, int $offset, int $limit): string
    {
        return 'SELECT codigo, provincia, nombre ' .
            'FROM municipio ' .
            "WHERE fullText LIKE '$query%' " .
            "AND provincia = $provinciaId " .
            "LIMIT $limit OFFSET $offset ";
    }
}
