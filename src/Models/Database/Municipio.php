<?php
declare(strict_types=1);

namespace CodigosPoblacion\Models\Database;

/**
 * @method static bool|Municipio first(array<string, mixed> $columnValues)
 * @method static bool|Municipio[] get(array<string, mixed> $columnValues = [], int $offset = 0, int $limit = 100, array $columns = []): bool|array
 */
class Municipio extends Model
{

    /**
     * @var string $tName
     */
    public static string $tName = 'municipio';

    /**
     * @var Dbms $dbms
     */
    protected static Dbms $dbms = Dbms::Sqlite;

    /**
     * @var array<string> $columns
     */
    protected static array $columns = [
        'id',
        'codigo',
        'codigo_control',
        'provincia',
        'nombre',
        'nombre_provincia',
    ];

    /**
     * @var ?int $id
     */
    public ?int $id;// phpcs:ignore Squiz.NamingConventions.ValidVariableName.MemberNotCamelCaps

    /**
     * @var string $codigo
     */
    public string $codigo;// phpcs:ignore Squiz.NamingConventions.ValidVariableName.MemberNotCamelCaps

    /**
     * @var string $codigo_control
     */
    public string $codigo_control;// phpcs:ignore Squiz.NamingConventions.ValidVariableName.MemberNotCamelCaps

    /**
     * @var string $provincia
     */
    public string $provincia;// phpcs:ignore Squiz.NamingConventions.ValidVariableName.MemberNotCamelCaps

    /**
     * @var string $nombre
     */
    public string $nombre;// phpcs:ignore Squiz.NamingConventions.ValidVariableName.MemberNotCamelCaps

    /**
     * @var string $nombre_provincia
     */
    public string $nombre_provincia;// phpcs:ignore Squiz.NamingConventions.ValidVariableName.MemberNotCamelCaps


}//end class
