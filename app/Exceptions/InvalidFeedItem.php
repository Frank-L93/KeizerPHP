<?php

namespace App\Exceptions;

use Handler;
use App\FeedItem;

class InvalidFeedItem extends Handler
{
    /** @var \Spatie\Feed\FeedItem|null */
    public $subject;

    public static function notFeedable($subject)
    {
        return (new static('Object doesn\'t implement `Spatie\Feed\Feedable`'))->withSubject($subject);
    }

    public static function notAFeedItem($subject)
    {
        return (new static('`toFeedItem` should return an instance of `Spatie\Feed\Feedable`'))->withSubject($subject);
    }

    public static function missingField(FeedItem $subject, $field)
    {
        return (new static("Field `{$field}` is required"))->withSubject($subject);
    }

    protected function withSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }
}
