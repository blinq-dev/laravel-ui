<?php

namespace Blinq\UI;

class Notify
{
    public $queue = [];

    public function showAlert($title, $message = null, $style = 'error') : NotifyBuilder
    {
        $notifyObject = new NotifyBuilder();

        $this->queue[] = $notifyObject;

        return $notifyObject
            ->setType('overlay')
            ->setStyle($style)
            ->setTitle($title)
            ->setClosable(false)
            ->addButton('OK', $action ?? 'open = false', 'bg-yellow')
            ->when($message, fn($builder) => $builder->setMessage($message));
    }

    public function showConfirm($title, $message = null, $action = null) : NotifyBuilder
    {
        $notifyObject = new NotifyBuilder();

        $this->queue[] = $notifyObject;

        return $notifyObject
            ->setType('overlay')
            ->setStyle('confirm')
            ->setTitle($title)
            ->setClosable(false)
            ->addButton('Yes', $action ?? 'open = false', 'bg-yellow')
            ->addButton('No', 'open = false', '')
            ->when($message, fn($builder) => $builder->setMessage($message));
    }

    public function getQueued()
    {
        return count($this->queue) > 0;
    }

    public function getQueue($type = "overlay")
    {
        $overlays = collect($this->queue)->filter(function (NotifyBuilder $overlay) use ($type) {
            return $overlay->type == $type;
        });

        $this->queue = [];

        return $overlays;
    }
}