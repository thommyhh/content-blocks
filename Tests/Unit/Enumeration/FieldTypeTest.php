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

namespace TYPO3\CMS\ContentBlocks\Tests\Unit\Enumeration;

use TYPO3\CMS\ContentBlocks\Enumeration\FieldType;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

class FieldTypeTest extends UnitTestCase
{
    /**
     * dataprovider for checking checkTcaType
     */
    public function checkTcaTypeDataProvider(): iterable
    {
        yield 'Check Enumaration getTcaType Category.' => [
            'status' => 'Category',
            'expected' => 'input',
        ];

        yield 'Check Enumaration getTcaType Checkbox.' => [
            'status' => 'Checkbox',
            'expected' => 'check',
        ];

        yield 'Check Enumaration getTcaType Collection.' => [
            'status' => 'Collection',
            'expected' => 'inline',
        ];

        yield 'Check Enumaration getTcaType Color.' => [
            'status' => 'Color',
            'expected' => 'input',
        ];

        yield 'Check Enumaration getTcaType DateTime.' => [
            'status' => 'DateTime',
            'expected' => 'input',
        ];

        yield 'Check Enumaration getTcaType Email.' => [
            'status' => 'Email',
            'expected' => 'input',
        ];

        // TODO: How to handle image fields in this case?
        yield 'Check Enumaration getTcaType File.' => [
            'status' => 'File',
            'expected' => 'inline',
        ];

        yield 'Check Enumaration getTcaType Link.' => [
            'status' => 'Link',
            'expected' => 'input',
        ];

        yield 'Check Enumaration getTcaType Number.' => [
            'status' => 'Number',
            'expected' => 'input',
        ];

        yield 'Check Enumaration getTcaType Radio.' => [
            'status' => 'Radio',
            'expected' => 'radio',
        ];

        yield 'Check Enumaration getTcaType Select.' => [
            'status' => 'Select',
            'expected' => 'select',
        ];

        yield 'Check Enumaration getTcaType Reference.' => [
            'status' => 'Reference',
            'expected' => 'input',
        ];

        yield 'Check Enumaration getTcaType Text.' => [
            'status' => 'Text',
            'expected' => 'input',
        ];

        yield 'Check Enumaration getTcaType Textarea.' => [
            'status' => 'Textarea',
            'expected' => 'text',
        ];
    }

    /**
     * Enumeration FieldType Test
     *
     * @test
     * @dataProvider checkTcaTypeDataProvider
     */
    public function checkTcaType($status, $expected)
    {
        $testEnum = FieldType::tryFrom($status);
        self::assertSame($expected, $testEnum->getTcaType());
    }

    public function checkGetFieldTypeConfigurationDataProvider(): iterable
    {
        yield 'Check Enumaration getFieldTypeConfiguration Email.' => [
            'fieldConfiguration' => [
                'identifier' => 'email',
                'type' => 'Email',
                'properties' =>
                    [
                        'autocomplete' => true,
                        'default' => 'developer@localhost',
                        'placeholder' => 'Placeholder text',
                        'size' => 20,
                        'required' => true,
                        'trim' => true,
                    ],
                '_path' =>
                    [
                        0 => 'email',
                    ],
                '_identifier' => 'email',
            ],
            'expected' => 'TYPO3\CMS\ContentBlocks\FieldConfiguration\EmailFieldConfiguration',
        ];

        yield 'Check Enumaration getFieldTypeConfiguration Text.' => [
            'fieldConfiguration' => [
                'identifier' => 'text',
                'type' => 'Text',
                'properties' =>
                    [
                        'autocomplete' => true,
                        'default' => 'Default value',
                        'max' => 15,
                        'placeholder' => 'Placeholder text',
                        'size' => 20,
                        'required' => false,
                        'trim' => true,
                    ],
                '_path' =>
                    [
                        0 => 'text',
                    ],
                '_identifier' => 'text',
            ],
            'expected' => 'TYPO3\CMS\ContentBlocks\FieldConfiguration\InputFieldConfiguration',
        ];

        yield 'Check Enumaration getFieldTypeConfiguration Textarea.' => [
            'fieldConfiguration' => [
                'identifier' => 'textarea',
                'type' => 'Textarea',
                'properties' =>
                    [
                        'cols' => 40,
                        'default' => 'Default value',
                        'enableRichtext' => true,
                        'max' => 150,
                        'placeholder' => 'Placeholder text',
                        'richtextConfiguration' => 'default',
                        'rows' => 15,
                        'required' => false,
                        'trim' => true,
                    ],
                '_path' =>
                    [
                        0 => 'textarea',
                    ],
                '_identifier' => 'textarea',
            ],
            'expected' => 'TYPO3\CMS\ContentBlocks\FieldConfiguration\TextareaFieldConfiguration',
        ];
    }

    /**
     * Enumeration FieldType Test
     *
     * @test
     * @dataProvider checkGetFieldTypeConfigurationDataProvider
     */
    public function checkGetFieldTypeConfiguration(array $fieldConfiguration, string $expected)
    {
        $testEnum = FieldType::tryFrom($fieldConfiguration['type']);
        self::assertSame($expected, get_class($testEnum->getFieldTypeConfiguration($fieldConfiguration)));
    }
}