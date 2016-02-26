<?php

/**
 * Created by PhpStorm.
 * User: ahand
 * Date: 2/18/16
 * Time: 10:51 AM
 */
class Article
{

    private $story;
    private $title;
    private $date;
    private $body;
    private $link;

    /**
     * Feed constructor.
     * @param $story
     */
    public function __construct($story)
    {
        $this->story = $story;

        $this->title = $story->title;
        $this->date = $story->pubDate;
        $this->body = $story->description;
        $this->link = $story->link;
    }


    public function getArticle(){

        return <<<ARTICLE

            <article>
                <a href="$this->link"><h2>$this->title</h2></a>
                <h4>$this->date</h4>
                <p>$this->body</p>
            </article>

ARTICLE;


    }
}