<?php

namespace App\Helpers\Traits;

trait RecipeModelShortcuts
{
    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->toArray()['title_' . LANG()];
    }

    /**
     * @return string
     */
    public function getIngredients(): ?string
    {
        return $this->toArray()['ingredients_' . LANG()];
    }

    /**
     * @return string
     */
    public function getIntro(): ?string
    {
        return $this->toArray()['intro_' . LANG()];
    }

    /**
     * @return string
     */
    public function getText(): ?string
    {
        return $this->toArray()['text_' . LANG()];
    }

    /**
     * @return bool
     */
    public function isReady(): bool
    {
        return $this->toArray()['ready_' . LANG()] == 1 ? true : false;
    }

    /**
     * @return bool
     */
    public function isApproved(): bool
    {
        return $this->toArray()['approved_' . LANG()] == 1 ? true : false;
    }

    /**
     * @return bool
     */
    public function isDone(): bool
    {
        return ($this->isReady() && $this->isApproved()) ? true : false;
    }

    /**
     * @return bool
     */
    public function isPublished(): bool
    {
        return $this->toArray()['published_' . LANG()] == 1 ? true : false;
    }

    /**
     * @return string
     */
    public function getStatusText(): string
    {
        if ($this->isDone()) {
            return trans('users.checked');
        } elseif (!$this->isReady()) {
            return trans('users.not_ready');
        } else {
            return trans('users.is_checking');
        }
    }

    /**
     * @return string
     */
    public function getStatusIcon(): string
    {
        if ($this->isDone()) {
            return 'fa-check';
        } elseif (!$this->isReady()) {
            return 'fa-pen';
        } else {
            return 'fa-clock';
        }
    }

    /**
     * @return string
     */
    public function getStatusColor(): string
    {
        if ($this->isDone()) {
            return '#65b56e';
        } elseif (!$this->isReady()) {
            return '#ce7777';
        } else {
            return '#e2bd18';
        }
    }

    public function moveToDrafts()
    {
        return $this->update([
            'ready_' . LANG() => 0,
            'approved_' . LANG() => 0,
            LANG() . '_approver_id' => 0,
        ]);
    }
}
