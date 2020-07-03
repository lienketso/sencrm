<?php

/**
 * LICENSE: The MIT License (the "License")
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * https://github.com/azure/azure-storage-php/LICENSE
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * 
 * PHP version 5
 *
 * @category  Microsoft
 * @package   MicrosoftAzure\Storage\Queue\Model
 * @author    Azure Storage PHP SDK <dmsh@microsoft.com>
 * @copyright 2016 Microsoft Corporation
 * @license   https://github.com/azure/azure-storage-php/LICENSE
 * @link      https://github.com/azure/azure-storage-php
 */
 
namespace MicrosoftAzure\Storage\Queue\Models;
use MicrosoftAzure\Storage\Common\Internal\Utilities;
use MicrosoftAzure\Storage\Common\Internal\Serialization\XmlSerializer;

/**
 * Wrappers queue message text.
 *
 * @category  Microsoft
 * @package   MicrosoftAzure\Storage\Queue\Model
 * @author    Azure Storage PHP SDK <dmsh@microsoft.com>
 * @copyright 2016 Microsoft Corporation
 * @license   https://github.com/azure/azure-storage-php/LICENSE
 * @version   Release: 0.10.2
 * @link      https://github.com/azure/azure-storage-php
 */
class QueueMessage
{
    private $_messageText;
    public static $xmlRootName = 'QueueMessage';
    
    /**
     * Gets message text field.
     * 
     * @return string.
     */
    public function getMessageText()
    {
        return $this->_messageText;
    }
    
    /**
     * Sets message text field.
     * 
     * @param string $messageText message contents.
     * 
     * @return string.
     */
    public function setMessageText($messageText)
    {
        $this->_messageText = $messageText;
    }
    
    /**
     * Converts this current object to XML representation.
     * 
     * @param XmlSerializer $xmlSerializer The XML serializer.
     * 
     * @return string. 
     */
    public function toXml($xmlSerializer)
    {
        $array      = array('MessageText' => $this->_messageText);
        $properties = array(XmlSerializer::ROOT_NAME => self::$xmlRootName);
        
        return $xmlSerializer->serialize($array, $properties);
    }
}


