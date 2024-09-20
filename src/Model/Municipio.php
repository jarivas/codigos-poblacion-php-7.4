<?php

declare(strict_types=1);

namespace CodigosPoblacion\Model;


/**
 * @SuppressWarnings(PHPMD)
 */
class Municipio
{
    public int $id;
    public string $codigo;// phpcs:ignore Squiz.NamingConventions.ValidVariableName.MemberNotCamelCaps
    public string $condigo_control;// phpcs:ignore Squiz.NamingConventions.ValidVariableName.MemberNotCamelCaps
    public string $provincia;// phpcs:ignore Squiz.NamingConventions.ValidVariableName.MemberNotCamelCaps
    public string $nombre;// phpcs:ignore Squiz.NamingConventions.ValidVariableName.MemberNotCamelCaps
    public string $nombre_provincia;// phpcs:ignore Squiz.NamingConventions.ValidVariableName.MemberNotCamelCaps
}
