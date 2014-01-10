<?php
/**
 * Test for \Magento\Filesystem\Driver\File
 *
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @copyright   Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
namespace Magento\Filesystem\Driver;

class FileTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \Magento\Filesystem\Driver\File
     */
    protected $driver;

    /**
     * @var string
     */
    protected $absolutePath;

    /**
     * get relative path for test
     *
     * @param $relativePath
     * @return string
     */
    protected function getTestPath($relativePath)
    {
        return $this->absolutePath . $relativePath;
    }

    /**
     * Set up
     */
    public function setUp()
    {
        $this->driver = new \Magento\Filesystem\Driver\File();
        $this->absolutePath = dirname(__DIR__) . '/_files/';
    }

    /**
     * test read recursively read
     */
    public function testReadDirectoryRecursively()
    {
        $expected = array(
            $this->getTestPath('recursively/directory'),
            $this->getTestPath('recursively/directory.txt'),
            $this->getTestPath('recursively/directory/read.txt')
        );
        $actual = $this->driver->readDirectoryRecursively($this->getTestPath('recursively'));
        sort($actual);
        $this->assertEquals($expected, $actual);
    }

    /**
     * test exception
     *
     * @expectedException \Magento\Filesystem\FilesystemException
     */
    public function testReadDirectoryRecursivelyFailure()
    {
        $this->driver->readDirectoryRecursively($this->getTestPath('not-existing-directory'));
    }
}