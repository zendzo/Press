<?php

namespace zendzo\Press\Feature;

use Carbon\Carbon;
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
      $this->assertContains('description: Here is description', $data[1]);
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

  /** @test */
  public function test_the_body_get_saved_and_trimmed()
  {
      $fileParser = (new PressFileParser(__DIR__ . '/../blogs/MarkFile1.md'));

      $data = $fileParser->getData();
      $this->assertEquals("<h1>Heading</h1>\n<p>Blog body belongs here</p>", $data['body']);
  }

  /** @test */
  public function test_a_sting_can_also_used()
  {
    $fileParser = (new PressFileParser("---\ntitle: My title\n---\nBlog body belongs here"));

    $data = $fileParser->getData();

    $this->assertContains('title: My title', $data[1]);
    $this->assertContains('Blog body belongs here', $data[2]);
  }

  /** @test */
  public function test_a_date_field_get_parsed()
  {
    $fileParser = (new PressFileParser("---\ndate: May 14, 1998\n---\n"));

    $data = $fileParser->getData();

    $this->assertInstanceOf(Carbon::class, $data['date']);
    $this->assertEquals('05/14/1998', $data['date']->format('m/d/Y'));
  }
}
