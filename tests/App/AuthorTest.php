<?php

namespace UnitTests\App;

use App\Author;
use App\Content;
use TestCase;

/**
 * Class AuthorTest
 *
 */
class AuthorTest extends TestCase
{
    public function testCreateAuthor()
    {
        $author = new Author();
        $author->setName('Foo Bar');
        $author->save();


        $content = new Content();
        $content->setContent('This is a tester');
        $content->setAuthor($author);

        /** @var Author $reloadedAuthor */
        $reloadedAuthor = Author::findOrFail($author->id);

        $this->assertInstanceOf('App\Author', $reloadedAuthor);
        $this->assertEquals(1, $reloadedAuthor->getContents()->count());
        $this->assertEquals('Foo Bar', $author->getName());

        $this->assertEquals('This is a tester', $reloadedAuthor->getContents()->get(0)->getContent());
    }
}
