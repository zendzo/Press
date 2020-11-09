<?php

namespace zendzo\Press\Feature;

use Orchestra\Testbench\TestCase;
use zendzo\Press\PressFileParser;

class PressFileParserTest extends TestCase
{
  /** @test */
  public function test_the_head_and_body_split()
  {
      $fileParser = (new PressFileParser(__DIR__.'/../blogs/MarkFile1.md'));

      $data = $fileParser->getData();

      $this->assertContains('title: My title', $data[1]);
      $this->assertContains('Description: Here is description', $data[1]);
      $this->assertContains('Blog body belongs here', $data[2]);
  }

  /** @test */
  public function test_each_head_get_split()
  {
      $fileParser = (new PressFileParser(__DIR__ . '/../blogs/MarkFile1.md'));

      $data = $fileParser->getData();
      $this->assertEquals('My title', $data['title']);
      $this->assertEquals('Here is description', $data['description']);
  }
}
