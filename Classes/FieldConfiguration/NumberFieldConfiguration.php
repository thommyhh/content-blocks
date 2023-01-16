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

final class NumberFieldConfiguration implements FieldConfigurationInterface
{
    private FieldType $fieldType = FieldType::NUMBER;
    private int|float $default = 0;
    private bool $readOnly = false;
    private int $size = 0;
    private bool $required = false;
    private bool $nullable = false;
    private string $mode = '';
    private string $placeholder = '';
    private array $valuePicker = [];
    private ?bool $autocomplete = null;
    private array $range = [];
    private array $slider = [];
    private string $format = '';

    public static function createFromArray(array $settings): NumberFieldConfiguration
    {
        $self = new self();
        $properties = $settings['properties'] ?? [];
        $self->format = (string)($properties['format'] ?? $self->format);
        $default = $properties['default'] ?? $self->default;
        $self->default = $self->format === 'decimal' ? (float)$default : (int)$default;
        $self->readOnly = (bool)($properties['readOnly'] ?? $self->readOnly);
        $self->size = (int)($settings['properties']['size'] ?? $self->size);
        $self->required = (bool)($properties['required'] ?? $self->required);
        $self->nullable = (bool)($properties['nullable'] ?? $self->nullable);
        $self->mode = (string)($properties['mode'] ?? $self->mode);
        $self->placeholder = (string)($properties['placeholder'] ?? $self->placeholder);
        $self->valuePicker = (array)($properties['valuePicker'] ?? $self->valuePicker);
        if (isset($properties['autocomplete'])) {
            $self->autocomplete = (bool)($properties['autocomplete'] ?? $self->autocomplete);
        }
        $self->range = (array)($properties['range'] ?? $self->range);
        $self->slider = (array)($properties['slider'] ?? $self->slider);

        return $self;
    }

    public function getTca(string $languagePath, bool $useExistingField): array
    {
        if (!$useExistingField) {
            $tca['exclude'] = true;
        }
        $tca['label'] = 'LLL:' . $languagePath . '.label';
        $tca['description'] = 'LLL:' . $languagePath . '.description';
        $config['type'] = $this->fieldType->getTcaType();
        if ($this->size !== 0) {
            $config['size'] = $this->size;
        }
        if ($this->default !== 0 && $this->default !== 0.0) {
            $config['default'] = $this->default;
        }
        if ($this->readOnly) {
            $config['readOnly'] = true;
        }
        if ($this->nullable) {
            $config['nullable'] = true;
        }
        if ($this->mode !== '') {
            $config['mode'] = $this->mode;
        }
        if ($this->placeholder !== '') {
            $config['placeholder'] = $this->placeholder;
        }
        if ($this->required) {
            $config['required'] = true;
        }
        if (isset($this->autocomplete)) {
            $config['autocomplete'] = $this->autocomplete;
        }
        if (($this->valuePicker['items'] ?? []) !== []) {
            $config['valuePicker'] = $this->valuePicker;
        }
        if ($this->range !== []) {
            $config['range'] = $this->range;
        }
        if ($this->slider !== []) {
            $config['slider'] = $this->slider;
        }
        if ($this->format !== '') {
            $config['format'] = $this->format;
        }
        $tca['config'] = $config;
        return $tca;
    }

    public function getSql(string $uniqueColumnName): string
    {
        if ($this->format === 'decimal') {
            return "`$uniqueColumnName` float DEFAULT '0' NOT NULL";
        }

        return "`$uniqueColumnName` int(11) DEFAULT '0' NOT NULL";
    }

    public function toArray(): array
    {
        return [];
    }

    public function getHtmlTemplate(int $indentation, string $uniqueIdentifier): string
    {
        return str_repeat(' ', $indentation * 4) . '<p>{' . $uniqueIdentifier . '}</p>' . "\n";
    }

    public function getFieldType(): FieldType
    {
        return $this->fieldType;
    }
}