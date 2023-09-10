<?php

namespace Blinq\UI;

class NotifyBuilder
{
    public string $style = 'success';
    public string $type = 'overlay'; // or toast
    public string $title = '';
    public string $message = '';
    public string $icon = '';
    public array $buttons = [];
    public bool $closable = true;
    
    public function __construct()
    {
        
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }

    public function setIcon(string $icon): self
    {
        $this->icon = $icon;
        return $this;
    }

    public function setButtons(array $buttons): self
    {
        $this->buttons = $buttons;
        return $this;
    }

    public function clearButtons(): self
    {
        $this->buttons = [];
        return $this;
    }

    public function addButton(string $label, string $action, string $colors = '') {
        $this->buttons[] = (object) [
            'label' => $label,
            'action' => $action,
            'colors' => $colors,
        ];
        return $this;
    }


    public function setClosable(bool $boolean = true)
    {
        $this->closable = $boolean;
        return $this;
    }

    public function setStyle(string $style)
    {
        $this->style = $style;

        if ($style == 'success') {
            $this->icon = "material/twotone done";
        }

        if ($style == 'error') {
            $this->icon = "hero2/outline exclamation-triangle";
        }
        
        if ($style == 'warning') {
            $this->icon = "hero2/outline exclamation-triangle";
        }

        if ($style == 'confirm') {
            $this->icon = "material/twotone question_answer";
        }

        return $this;
    }

    public function setType(string $type)
    {
        $this->type = $type;
        return $this;
    }

    public function when($var, $callback)
    {
        if ($var) {
            $callback($this);
        }

        return $this;
    }
}
