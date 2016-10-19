<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Content extends Model
{
    const CONTENT = 'content';
    const AUTHOR_ID = 'author_id';

    protected $fillable = [
        self::CONTENT
    ];

    /**
     * @return string
     */
    public function getContent() : string
    {
        return $this->{self::CONTENT};
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->{self::CONTENT} = $content;
    }

    /**
     * @return BelongsTo
     */
    public function author()
    {
        return $this->belongsTo('App\Author');
    }

    /**
     * @param Author $author
     */
    public function setAuthor(Author $author)
    {
        $this->{self::AUTHOR_ID} = $author->id;
        $this->save();
    }

    /**
     * @return Author
     */
    public function getAuthor() : Author
    {
        return $this->author;
    }
}
