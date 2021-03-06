<?php

namespace App\Helpers\Traits;

trait RecipeModelShortcuts
{
    /**
     * Get title column from db
     *
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->toArray()['title_' . LANG()];
    }

    /**
     * Get ingredients column from db
     *
     * @return string
     */
    public function getIngredients(): ?string
    {
        return $this->toArray()['ingredients_' . LANG()];
    }

    /**
     * Get intro column from db
     *
     * @return string
     */
    public function getIntro(): ?string
    {
        return $this->toArray()['intro_' . LANG()];
    }

    /**
     * Get text column from db
     *
     * @return string
     */
    public function getText(): ?string
    {
        return $this->toArray()['text_' . LANG()];
    }

    /**
     * Check if this recipe has ready column set to 1
     *
     * @return boolean
     */
    public function isReady(): bool
    {
        return $this->toArray()['ready_' . LANG()] == 1 ? true : false;
    }

    /**
     * Check if this recipe has approved column set to 1
     *
     * @return boolean
     */
    public function isApproved(): bool
    {
        return $this->toArray()['approved_' . LANG()] == 1 ? true : false;
    }

    /**
     * Check if this recipe has approved column set to 1
     * and ready column set to 1
     *
     * @return boolean
     */
    public function isDone(): bool
    {
        return ($this->isReady() && $this->isApproved()) ? true : false;
    }

    /**
     * Check if this recipe has published column set to 1
     *
     * @return boolean
     */
    public function isPublished(): bool
    {
        return $this->toArray()['published_' . LANG()] == 1 ? true : false;
    }

    /**
     * Returns status of the current recipe
     *
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
     * Returns font awesome icon of the current recipe,
     * dipending of the current recipe status
     *
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
     * Returns color of the current recipe,
     * dipending of the current recipe status
     *
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

    /**
     * This method will update recipe and set ready,
     * approved and approver_id field to 0
     */
    public function moveToDrafts()
    {
        return $this->update([
            'ready_' . LANG() => 0,
            'approved_' . LANG() => 0,
            LANG() . '_approver_id' => 0,
        ]);
    }
}
