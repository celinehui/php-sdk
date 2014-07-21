<?php
class TuisongbaoException extends Exception
  {
    public function __construct($message, $code = NUll)
    {
      parent::__construct($message, $code);
    }

    public function __toString()
    {
      $msg = __CLASS__.'{$this->message}';
      if (!is_null($this->code)) {
        $msg.', ack: {$this->code}';
      }

      return $msg.'\n';
    }
  }
?>
