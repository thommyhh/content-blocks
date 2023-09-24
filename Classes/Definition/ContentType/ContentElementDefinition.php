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

namespace TYPO3\CMS\ContentBlocks\Definition\ContentType;

/**
 * @internal Not part of TYPO3's public API.
 */
final class ContentElementDefinition extends ContentTypeDefinition implements ContentTypeInterface
{
    private string $description = '';
    private string $contentElementIcon = '';
    private string $contentElementIconOverlay = '';
    private bool $saveAndClose = false;
    private string $wizardGroup = '';
    private string $wizardIconPath = '';

    public static function createFromArray(array $array, string $table): ContentElementDefinition
    {
        $self = new self();
        return $self
            ->withTable($table)
            ->withIdentifier($array['identifier'])
            ->withTypeName($array['typeName'])
            ->withLabel($array['label'] ?? '')
            ->withColumns($array['columns'] ?? [])
            ->withShowItems($array['showItems'] ?? [])
            ->withOverrideColumns($array['overrideColumns'] ?? [])
            ->withVendor($array['vendor'] ?? '')
            ->withPackage($array['package'] ?? '')
            ->withPriority($array['priority'] ?? 0)
            ->withDescription($array['description'] ?? '')
            ->withContentElementIcon($array['contentElementIcon'] ?? '')
            ->withContentElementIconOverlay($array['contentElementIconOverlay'] ?? '')
            ->withSaveAndClose(!empty($array['saveAndClose']))
            ->withWizardGroup($array['wizardGroup'])
            ->withTypeIconPath($array['typeIconPath'] ?? null)
            ->withIconProviderClassName($array['iconProvider'] ?? null)
            ->withTypeIconIdentifier($array['typeIconIdentifier'] ?? null);
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getContentElementIcon(): string
    {
        return $this->contentElementIcon;
    }

    public function getContentElementIconOverlay(): string
    {
        return $this->contentElementIconOverlay;
    }

    public function getWizardGroup(): string
    {
        return $this->wizardGroup;
    }

    public function getWizardIconPath(): string
    {
        return $this->wizardIconPath;
    }

    public function getWizardIconIdentifier(): string
    {
        return $this->getTypeIconIdentifier();
    }

    public function hasSaveAndClose(): bool
    {
        return $this->saveAndClose;
    }

    public function withDescription(string $description): self
    {
        $clone = clone $this;
        $clone->description = $description;
        return $clone;
    }

    public function withContentElementIcon(string $contentElementIcon): self
    {
        $clone = clone $this;
        $clone->contentElementIcon = $contentElementIcon;
        return $clone;
    }

    public function withContentElementIconOverlay(string $contentElementIconOverlay): self
    {
        $clone = clone $this;
        $clone->contentElementIconOverlay = $contentElementIconOverlay;
        return $clone;
    }

    public function withSaveAndClose(bool $saveAndClose): self
    {
        $clone = clone $this;
        $clone->saveAndClose = $saveAndClose;
        return $clone;
    }

    public function withWizardGroup(string $wizardGroup): self
    {
        $clone = clone $this;
        $clone->wizardGroup = $wizardGroup;
        return $clone;
    }
}
