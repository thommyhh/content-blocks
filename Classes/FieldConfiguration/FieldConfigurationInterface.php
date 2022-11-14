<?php

declare(strict_types=1);

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

namespace TYPO3\CMS\ContentBlocks\FieldConfiguration;

use TYPO3\CMS\ContentBlocks\Enumeration\FieldType;

/**
 * Defines basic stuff for FieldConfigurations
 */
interface FieldConfigurationInterface
{

    private array $rawData = [];

    public ?FieldType $type;

    public string $identifier;

    public string $uniqueIdentifier;

    public array $path;

    public bool $useExistingField;

    public bool $isFileField;

    public function getSql(string $uniqueColumnName): string;

    public function getTca(array $contentBlock): array;

    public function toArray(): array;

    public function getTemplateHtml(string $indentation): string;


    public function combinedIdentifierToArray(string $combinedIdentifier): array;

    public function arrayToCombinedIdentifier(array $path): string;

    public function uniqueCombinedIdentifier(string $cType, string $combinedIdentifier): string;

    public function splitUniqueCombinedIdentifier($uniqueCombinedIdentifier): array;

    /**
     * Manage to have SQL compatible column names, prefixed with "cb_".
     * Result: cb_content_blockidentifier_column_path_column_name
     */
    public function uniqueColumnName(string $cType, string $combinedIdentifier): string;

    /** TODO:
     *  - getAllowedSettings: allowed properties and values for the backend module
     *  - (?) validateProperties: removes all not allowed properties from an array
     *  - (?) getXlfTemplate
     */
}