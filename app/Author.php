<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Author extends Model
{
    const NAME = 'name';

    protected $fillable = [
        self::NAME
    ];

    /**
     * @return string
     */
    public function getName()
    {
        return $this->{self::NAME};
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->{self::NAME} = $name;
    }

    /**
     * @return HasMany
     */
    public function contents() : HasMany
    {
        return $this->hasMany('App\Content');
    }

    /**
     * @return Collection
     */
    public function getContents() : Collection
    {
        return Content::where('author_id', $this->id)->get();
    }

    /**
     * @param Content $content
     */
    public function addContent(Content $content)
    {
        $this->contents()->save($content);
    }
}
