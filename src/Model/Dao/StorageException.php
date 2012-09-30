<?php
namespace Zendor\Storage;
/**
 * Zendor
 *
 * LICENSE
 *
 * This source file is subject to the new LGPL 3.0 license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://zendor.tomascejka.eu/licence.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to dev.cejkatomas@gmail.com so we can send you a copy immediately.
 * 
 * @author tomascejka <dev.cejkatomas@gmail.com>
 * @category   Zendor
 * @package    Storage
 * @copyright  Copyright (c) 2012 Tomas Cejka (http://zendor.tomascejka.eu)
 * @license    http://www.gnu.org/licenses/gpl.html - GNU Lesser General Public License, version 3.0
 * 
 */
class StorageException extends Exception {
    public function __construct($message, $code, $previous) {
        parent::__construct($message, $code, $previous);
    }
}