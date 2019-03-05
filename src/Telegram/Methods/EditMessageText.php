<?php


namespace TelegramBot\Telegram\Methods;

use TelegramBot\Exception\TelegramBotException;
use TelegramBot\Telegram\Types\InlineKeyboardMarkup;

/**
 * Class EditMessageText
 * @package TelegramBot\Telegram\Methods
 */
class EditMessageText implements MethodInterface
{

    /**
     *
     */
    private const METHOD_NAME = "editMessageText";
    /**
     *
     */
    private const RESULT_TYPE = "Message";
    /**
     *
     */
    private const MULTIPLE_RESULTS = false;

    /**
     * @var null
     */
    private $chat_id;
    /**
     * @var null
     */
    private $message_id;
    /**
     * @var null|string
     */
    private $inline_message_id;
    /**
     * @var string
     */
    private $text;
    /**
     * @var string
     */
    private $parse_mode;
    /**
     * @var bool
     */
    private $disable_web_page_preview;
    /**
     * @var InlineKeyboardMarkup
     */
    private $reply_markup;

    /**
     * @var bool
     */
    private $multipart = false;

    /**
     * EditMessageText constructor.
     * @param null|string $chat_id
     * @param int|null $message_id
     * @param null|string $inline_message_id
     * @param string $text
     * @param string|null $parse_mode
     * @param bool $disable_web_page_preview
     * @param InlineKeyboardMarkup|null $reply_markup
     * @throws TelegramBotException
     */
    function __construct(?string $chat_id, ?int $message_id, ?string $inline_message_id, string $text, string $parse_mode = null, bool $disable_web_page_preview = false, InlineKeyboardMarkup $reply_markup = null)
    {
        if (!isset($inline_message_id)) {
            if (isset($chat_id) and isset($message_id)) {
                $this->chat_id = $chat_id;
                $this->message_id = $message_id;
            } else {
                throw new TelegramBotException("Too few arguments");
            }
        } else {
            $this->chat_id = null;
            $this->message_id = null;
            $this->inline_message_id = $inline_message_id;
        }
        $this->text = $text;
        $this->parse_mode = $parse_mode;
        $this->disable_web_page_preview = $disable_web_page_preview;
        $this->reply_markup = $reply_markup;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
            'message_id' => $this->message_id,
            'inline_message_id' => $this->inline_message_id,
            'text' => $this->text,
            'parse_mode' => $this->parse_mode,
            'disable_web_page_preview' => $this->disable_web_page_preview,
            'reply_markup' => $this->reply_markup
        ];
    }

    /**
     * @return string
     */
    public function getMethodName(): string
    {
        return self::METHOD_NAME;
    }

    /**
     * @return bool
     */
    public function isMultipart(): bool
    {
        return $this->multipart;
    }

    /**
     * @return array
     */
    public function getResultParams(): array
    {
        return [
            'type' => self::RESULT_TYPE,
            'multiple' => self::MULTIPLE_RESULTS
        ];
    }

}