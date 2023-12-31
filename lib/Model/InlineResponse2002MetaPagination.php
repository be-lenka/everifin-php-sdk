<?php
/**
 * InlineResponse2002MetaPagination
 *
 * PHP version 7.3
 *
 * @category Class
 * @package  belenka\Everifin\Client

 * 
 */





namespace belenka\Everifin\Client\Model;

use \ArrayAccess;
use \belenka\Everifin\Client\ObjectSerializer;

/**
 * InlineResponse2002MetaPagination Class Doc Comment
 *
 * @category Class
 * @package  belenka\Everifin\Client

 * 
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class InlineResponse2002MetaPagination implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'inline_response_200_2_meta_pagination';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'count_per_page' => 'float',
        'count_total' => 'float',
        'first' => 'float',
        'first_page_url' => 'string',
        'last' => 'float',
        'last_page_url' => 'string',
        'next_page_url' => 'mixed',
        'page' => 'float',
        'previous_page_url' => 'mixed'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'count_per_page' => null,
        'count_total' => null,
        'first' => null,
        'first_page_url' => null,
        'last' => null,
        'last_page_url' => null,
        'next_page_url' => null,
        'page' => null,
        'previous_page_url' => null
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'count_per_page' => 'countPerPage',
        'count_total' => 'countTotal',
        'first' => 'first',
        'first_page_url' => 'firstPageUrl',
        'last' => 'last',
        'last_page_url' => 'lastPageUrl',
        'next_page_url' => 'nextPageUrl',
        'page' => 'page',
        'previous_page_url' => 'previousPageUrl'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'count_per_page' => 'setCountPerPage',
        'count_total' => 'setCountTotal',
        'first' => 'setFirst',
        'first_page_url' => 'setFirstPageUrl',
        'last' => 'setLast',
        'last_page_url' => 'setLastPageUrl',
        'next_page_url' => 'setNextPageUrl',
        'page' => 'setPage',
        'previous_page_url' => 'setPreviousPageUrl'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'count_per_page' => 'getCountPerPage',
        'count_total' => 'getCountTotal',
        'first' => 'getFirst',
        'first_page_url' => 'getFirstPageUrl',
        'last' => 'getLast',
        'last_page_url' => 'getLastPageUrl',
        'next_page_url' => 'getNextPageUrl',
        'page' => 'getPage',
        'previous_page_url' => 'getPreviousPageUrl'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }


    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['count_per_page'] = $data['count_per_page'] ?? null;
        $this->container['count_total'] = $data['count_total'] ?? null;
        $this->container['first'] = $data['first'] ?? null;
        $this->container['first_page_url'] = $data['first_page_url'] ?? null;
        $this->container['last'] = $data['last'] ?? null;
        $this->container['last_page_url'] = $data['last_page_url'] ?? null;
        $this->container['next_page_url'] = $data['next_page_url'] ?? null;
        $this->container['page'] = $data['page'] ?? null;
        $this->container['previous_page_url'] = $data['previous_page_url'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets count_per_page
     *
     * @return float|null
     */
    public function getCountPerPage()
    {
        return $this->container['count_per_page'];
    }

    /**
     * Sets count_per_page
     *
     * @param float|null $count_per_page count_per_page
     *
     * @return self
     */
    public function setCountPerPage($count_per_page)
    {
        $this->container['count_per_page'] = $count_per_page;

        return $this;
    }

    /**
     * Gets count_total
     *
     * @return float|null
     */
    public function getCountTotal()
    {
        return $this->container['count_total'];
    }

    /**
     * Sets count_total
     *
     * @param float|null $count_total count_total
     *
     * @return self
     */
    public function setCountTotal($count_total)
    {
        $this->container['count_total'] = $count_total;

        return $this;
    }

    /**
     * Gets first
     *
     * @return float|null
     */
    public function getFirst()
    {
        return $this->container['first'];
    }

    /**
     * Sets first
     *
     * @param float|null $first first
     *
     * @return self
     */
    public function setFirst($first)
    {
        $this->container['first'] = $first;

        return $this;
    }

    /**
     * Gets first_page_url
     *
     * @return string|null
     */
    public function getFirstPageUrl()
    {
        return $this->container['first_page_url'];
    }

    /**
     * Sets first_page_url
     *
     * @param string|null $first_page_url first_page_url
     *
     * @return self
     */
    public function setFirstPageUrl($first_page_url)
    {
        $this->container['first_page_url'] = $first_page_url;

        return $this;
    }

    /**
     * Gets last
     *
     * @return float|null
     */
    public function getLast()
    {
        return $this->container['last'];
    }

    /**
     * Sets last
     *
     * @param float|null $last last
     *
     * @return self
     */
    public function setLast($last)
    {
        $this->container['last'] = $last;

        return $this;
    }

    /**
     * Gets last_page_url
     *
     * @return string|null
     */
    public function getLastPageUrl()
    {
        return $this->container['last_page_url'];
    }

    /**
     * Sets last_page_url
     *
     * @param string|null $last_page_url last_page_url
     *
     * @return self
     */
    public function setLastPageUrl($last_page_url)
    {
        $this->container['last_page_url'] = $last_page_url;

        return $this;
    }

    /**
     * Gets next_page_url
     *
     * @return mixed|null
     */
    public function getNextPageUrl()
    {
        return $this->container['next_page_url'];
    }

    /**
     * Sets next_page_url
     *
     * @param mixed|null $next_page_url next_page_url
     *
     * @return self
     */
    public function setNextPageUrl($next_page_url)
    {
        $this->container['next_page_url'] = $next_page_url;

        return $this;
    }

    /**
     * Gets page
     *
     * @return float|null
     */
    public function getPage()
    {
        return $this->container['page'];
    }

    /**
     * Sets page
     *
     * @param float|null $page page
     *
     * @return self
     */
    public function setPage($page)
    {
        $this->container['page'] = $page;

        return $this;
    }

    /**
     * Gets previous_page_url
     *
     * @return mixed|null
     */
    public function getPreviousPageUrl()
    {
        return $this->container['previous_page_url'];
    }

    /**
     * Sets previous_page_url
     *
     * @param mixed|null $previous_page_url previous_page_url
     *
     * @return self
     */
    public function setPreviousPageUrl($previous_page_url)
    {
        $this->container['previous_page_url'] = $previous_page_url;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param int|null $offset Offset
     * @param mixed    $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value
     * of any type other than a resource.
     */
    public function jsonSerialize()
    {
       return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}


