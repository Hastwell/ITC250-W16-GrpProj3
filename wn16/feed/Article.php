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
    }


    public function getArticle(){

        return <<<ARTICLE

            <article>
                <h2>$this->title</h2>
                <h4>$this->date</h4>
                <p>$this->body</p>
            </article>
            
            
            <article>
                <a href=$this->link></a
            
            
            </article>
            

ARTICLE;


    }
}