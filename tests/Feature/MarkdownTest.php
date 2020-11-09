<?php

namespace zendzo\Press\Tests;

use Orchestra\Testbench\TestCase as TestbenchTestCase;
use zendzo\Press\MarkdownParser;

class MarkDownTest extends TestbenchTestCase
{
  /** @test */
  public function simple_markdown_is_parse()
  {
    $this->assertEquals(MarkdownParser::parse('# Heading'), '<h1>Heading</h1>');
  }
}
