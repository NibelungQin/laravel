<?php
/**
 * Created by PhpStorm.
 * User: Nibelung Qin
 * Date: 2018/3/15
 * Time: 21:25
 */

namespace App\Markdown;


class Markdown
{
    protected $parser;

    public function __construct(Parser $parser)
    {
        $this->parser=$parser;
    }

    public function markdown($text)
    {
        $html=$this->parser->makeHtml($text);
        return $html;
    }
}