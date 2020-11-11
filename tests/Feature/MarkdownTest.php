<?php

namespace zendzo\Press\Tests;

use zendzo\Press\MarkdownParser;

class MarkDownTest extends TestCase
{
  /** @test */
  public function simple_markdown_is_parse()
  {
    $this->assertEquals(MarkdownParser::parse('# Heading'), '<h1>Heading</h1>');
  }
}
