<?php
/**
 * PaymentEmbedData
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
 * PaymentEmbedData Class Doc Comment
 *
 * @category Class
 * @package  belenka\Everifin\Client

 * 
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class PaymentEmbedData implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'payment_embed_data';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'amount' => 'float',
        'constant_symbol' => 'string',
        'currency' => 'string',
        'disable_hooks' => 'string',
        'instruction_id' => 'string',
        'payment_message' => 'string',
        'recipient_bank_bic' => 'string',
        'recipient_iban' => 'string',
        'redirect_url' => 'string',
        'sender_bank_id' => 'string',
        'specific_symbol' => 'string',
        'variable_symbol' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'amount' => null,
        'constant_symbol' => null,
        'currency' => null,
        'disable_hooks' => null,
        'instruction_id' => null,
        'payment_message' => null,
        'recipient_bank_bic' => null,
        'recipient_iban' => null,
        'redirect_url' => null,
        'sender_bank_id' => null,
        'specific_symbol' => null,
        'variable_symbol' => null
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
        'amount' => 'amount',
        'constant_symbol' => 'constantSymbol',
        'currency' => 'currency',
        'disable_hooks' => 'disableHooks',
        'instruction_id' => 'instructionId',
        'payment_message' => 'paymentMessage',
        'recipient_bank_bic' => 'recipientBankBic',
        'recipient_iban' => 'recipientIban',
        'redirect_url' => 'redirectUrl',
        'sender_bank_id' => 'senderBankId',
        'specific_symbol' => 'specificSymbol',
        'variable_symbol' => 'variableSymbol'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'amount' => 'setAmount',
        'constant_symbol' => 'setConstantSymbol',
        'currency' => 'setCurrency',
        'disable_hooks' => 'setDisableHooks',
        'instruction_id' => 'setInstructionId',
        'payment_message' => 'setPaymentMessage',
        'recipient_bank_bic' => 'setRecipientBankBic',
        'recipient_iban' => 'setRecipientIban',
        'redirect_url' => 'setRedirectUrl',
        'sender_bank_id' => 'setSenderBankId',
        'specific_symbol' => 'setSpecificSymbol',
        'variable_symbol' => 'setVariableSymbol'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'amount' => 'getAmount',
        'constant_symbol' => 'getConstantSymbol',
        'currency' => 'getCurrency',
        'disable_hooks' => 'getDisableHooks',
        'instruction_id' => 'getInstructionId',
        'payment_message' => 'getPaymentMessage',
        'recipient_bank_bic' => 'getRecipientBankBic',
        'recipient_iban' => 'getRecipientIban',
        'redirect_url' => 'getRedirectUrl',
        'sender_bank_id' => 'getSenderBankId',
        'specific_symbol' => 'getSpecificSymbol',
        'variable_symbol' => 'getVariableSymbol'
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
        $this->container['amount'] = $data['amount'] ?? null;
        $this->container['constant_symbol'] = $data['constant_symbol'] ?? null;
        $this->container['currency'] = $data['currency'] ?? null;
        $this->container['disable_hooks'] = $data['disable_hooks'] ?? null;
        $this->container['instruction_id'] = $data['instruction_id'] ?? null;
        $this->container['payment_message'] = $data['payment_message'] ?? null;
        $this->container['recipient_bank_bic'] = $data['recipient_bank_bic'] ?? null;
        $this->container['recipient_iban'] = $data['recipient_iban'] ?? null;
        $this->container['redirect_url'] = $data['redirect_url'] ?? null;
        $this->container['sender_bank_id'] = $data['sender_bank_id'] ?? null;
        $this->container['specific_symbol'] = $data['specific_symbol'] ?? null;
        $this->container['variable_symbol'] = $data['variable_symbol'] ?? null;
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
     * Gets amount
     *
     * @return float|null
     */
    public function getAmount()
    {
        return $this->container['amount'];
    }

    /**
     * Sets amount
     *
     * @param float|null $amount amount
     *
     * @return self
     */
    public function setAmount($amount)
    {
        $this->container['amount'] = $amount;

        return $this;
    }

    /**
     * Gets constant_symbol
     *
     * @return string|null
     */
    public function getConstantSymbol()
    {
        return $this->container['constant_symbol'];
    }

    /**
     * Sets constant_symbol
     *
     * @param string|null $constant_symbol constant_symbol
     *
     * @return self
     */
    public function setConstantSymbol($constant_symbol)
    {
        $this->container['constant_symbol'] = $constant_symbol;

        return $this;
    }

    /**
     * Gets currency
     *
     * @return string|null
     */
    public function getCurrency()
    {
        return $this->container['currency'];
    }

    /**
     * Sets currency
     *
     * @param string|null $currency currency
     *
     * @return self
     */
    public function setCurrency($currency)
    {
        $this->container['currency'] = $currency;

        return $this;
    }

    /**
     * Gets disable_hooks
     *
     * @return string|null
     */
    public function getDisableHooks()
    {
        return $this->container['disable_hooks'];
    }

    /**
     * Sets disable_hooks
     *
     * @param string|null $disable_hooks disable_hooks
     *
     * @return self
     */
    public function setDisableHooks($disable_hooks)
    {
        $this->container['disable_hooks'] = $disable_hooks;

        return $this;
    }

    /**
     * Gets instruction_id
     *
     * @return string|null
     */
    public function getInstructionId()
    {
        return $this->container['instruction_id'];
    }

    /**
     * Sets instruction_id
     *
     * @param string|null $instruction_id instruction_id
     *
     * @return self
     */
    public function setInstructionId($instruction_id)
    {
        $this->container['instruction_id'] = $instruction_id;

        return $this;
    }

    /**
     * Gets payment_message
     *
     * @return string|null
     */
    public function getPaymentMessage()
    {
        return $this->container['payment_message'];
    }

    /**
     * Sets payment_message
     *
     * @param string|null $payment_message payment_message
     *
     * @return self
     */
    public function setPaymentMessage($payment_message)
    {
        $this->container['payment_message'] = $payment_message;

        return $this;
    }

    /**
     * Gets recipient_bank_bic
     *
     * @return string|null
     */
    public function getRecipientBankBic()
    {
        return $this->container['recipient_bank_bic'];
    }

    /**
     * Sets recipient_bank_bic
     *
     * @param string|null $recipient_bank_bic recipient_bank_bic
     *
     * @return self
     */
    public function setRecipientBankBic($recipient_bank_bic)
    {
        $this->container['recipient_bank_bic'] = $recipient_bank_bic;

        return $this;
    }

    /**
     * Gets recipient_iban
     *
     * @return string|null
     */
    public function getRecipientIban()
    {
        return $this->container['recipient_iban'];
    }

    /**
     * Sets recipient_iban
     *
     * @param string|null $recipient_iban recipient_iban
     *
     * @return self
     */
    public function setRecipientIban($recipient_iban)
    {
        $this->container['recipient_iban'] = $recipient_iban;

        return $this;
    }

    /**
     * Gets redirect_url
     *
     * @return string|null
     */
    public function getRedirectUrl()
    {
        return $this->container['redirect_url'];
    }

    /**
     * Sets redirect_url
     *
     * @param string|null $redirect_url redirect_url
     *
     * @return self
     */
    public function setRedirectUrl($redirect_url)
    {
        $this->container['redirect_url'] = $redirect_url;

        return $this;
    }

    /**
     * Gets sender_bank_id
     *
     * @return string|null
     */
    public function getSenderBankId()
    {
        return $this->container['sender_bank_id'];
    }

    /**
     * Sets sender_bank_id
     *
     * @param string|null $sender_bank_id sender_bank_id
     *
     * @return self
     */
    public function setSenderBankId($sender_bank_id)
    {
        $this->container['sender_bank_id'] = $sender_bank_id;

        return $this;
    }

    /**
     * Gets specific_symbol
     *
     * @return string|null
     */
    public function getSpecificSymbol()
    {
        return $this->container['specific_symbol'];
    }

    /**
     * Sets specific_symbol
     *
     * @param string|null $specific_symbol specific_symbol
     *
     * @return self
     */
    public function setSpecificSymbol($specific_symbol)
    {
        $this->container['specific_symbol'] = $specific_symbol;

        return $this;
    }

    /**
     * Gets variable_symbol
     *
     * @return string|null
     */
    public function getVariableSymbol()
    {
        return $this->container['variable_symbol'];
    }

    /**
     * Sets variable_symbol
     *
     * @param string|null $variable_symbol variable_symbol
     *
     * @return self
     */
    public function setVariableSymbol($variable_symbol)
    {
        $this->container['variable_symbol'] = $variable_symbol;

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


