<?php

namespace zendzo\Press\Tests;

use Carbon\Carbon;
use zendzo\Press\PressFileParser;

class PressFileParserTest extends TestCase
{
  /** @test */
  public function test_the_head_and_body_split()
  {
      $fileParser = (new PressFileParser(__DIR__.'/../blogs/MarkFile1.md'));
      $data = $fileParser->getRawData();

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
  public function test_a_string_can_also_used()
  {
    $fileParser = (new PressFileParser("---\ntitle: My title\n---\nBlog body belongs here"));
    $data = $fileParser->getRawData();

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

  /** @test */
  public function test_extra_field_gets_saved()
  {
    $fileParser = (new PressFileParser("---\nauthor: Jhon Doe\n---\n"));
    $data = $fileParser->getData();

    $this->assertEquals(json_encode(['author' => 'Jhon Doe']), $data['extra']);
  }

  /** @test */
  public function test_add_two_extra_fields()
  {
    $fileParser = (new PressFileParser("---\nauthor: Jhon Doe\nimage: image/show.jpg---\n"));
    $data = $fileParser->getData();

    $this->assertEquals(json_encode(['author' => 'Jhon Doe', 'image' => 'image/show.jpg']), $data['extra']);
  }
}
