<?php

namespace App\Jobs;

use App\Author;
use App\Content;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StoreContent implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var string
     */
    private $authorName;
    /**
     * @var string
     */
    private $content;

    /**
     * Create a new job instance.
     *
     * @param string $authorName
     * @param string $content
     */
    public function __construct(string $authorName, string $content)
    {
        $this->authorName = $authorName;
        $this->content    = $content;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $author = new Author();
        $author->setName($this->authorName);
        $author->save();

        $content = new Content();
        $content->setContent($this->content);
        $content->setAuthor($author);
        $content->save();

        return;
    }

    /**
     * @param string $json
     *
     * @return StoreContent
     */
    public static function fromApiJson(string $json) : StoreContent
    {
        $contents = json_decode($json, true);

        $storeContent = new StoreContent(
            $contents['author']['name'],
            $contents['content']['content']
        );

        return $storeContent;
    }
}
