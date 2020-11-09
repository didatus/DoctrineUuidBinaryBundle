<?php

namespace Didatus\DoctrineUuidBinary\Types;

use Doctrine\DBAL\Types\BinaryType;
use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * UUID Binary Type for Doctrine
 */
class UuidType extends BinaryType
{
    /**
     * The UUID_TO_BIN function returns a VARBINARY(16)
     * @link https://dev.mysql.com/doc/refman/8.0/en/miscellaneous-functions.html#function_uuid-to-bin
     *
     * @param array $fieldDeclaration
     * @param AbstractPlatform $platform
     * @return string
     */
    public function getSqlDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return $platform->getBinaryTypeDeclarationSQL([
            'length' => '16',
            'fixed' => false,
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'uuid';
    }

    /**
     * The parent class has special handling for converting the MySQL data to PHP. As this class uses MySQL functions to
     * convert binary to text. Therefore this method should just return the value.
     *
     * @param mixed            $value
     * @param AbstractPlatform $platform
     * @return string
     */
    public function convertToPhpValue($value, AbstractPlatform $platform)
    {
        return $value;
    }

    /**
     * The MySQL functions UUID_TO_BIN and BIN_TO_UUID should be used, so we have to say Doctrine, that we want to use
     * custom SQL (Custom SQL provided by the methods convertToDatabaseValueSQL() and convertToPHPValueSQL()).
     *
     * @return bool
     */
    public function canRequireSQLConversion()
    {
        return true;
    }

    /**
     * The second parameter helps MySQL to create more efficient indexes for the binary uuid column.
     * See swap_flag of the UUID_TO_BIN function in the official documentation:
     * @link https://dev.mysql.com/doc/refman/8.0/en/miscellaneous-functions.html#function_uuid-to-bin
     *
     * @param string $sqlExpr
     * @param AbstractPlatform $platform
     * @return string
     */
    public function convertToDatabaseValueSQL($sqlExpr, AbstractPlatform $platform)
    {
        return sprintf('UUID_TO_BIN(%s, 1)', $sqlExpr);
    }

    /**
     * @param string $sqlExpr
     * @param AbstractPlatform $platform
     * @return string
     */
    public function convertToPHPValueSQL($sqlExpr, $platform)
    {
        return sprintf('BIN_TO_UUID(%s, 1)', $sqlExpr);
    }

    /**
     * This will add a necessary doctrine comment (e.g. COMMENT '(DC2Type:uuid)') to the MySQL table so that Doctrine is
     * able to reverse engineer from SQL to Doctrine Type (MySQL binary type is used in several Doctrine types and
     * therefore not unique)
     *
     * @param AbstractPlatform $platform
     * @return bool
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform)
    {
        return true;
    }
}
