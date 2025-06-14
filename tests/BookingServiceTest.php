<?php

use PHPUnit\Framework\TestCase;
use App\Services\BookingService;
use App\Repositories\BookingRepository;
use Domain\Booking;

class BookingServiceTest extends TestCase
{
    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testCreateBookingReturnsTrue()
  {
    $mockRepo = $this->createMock(BookingRepository::class);

    // Setup dummy response
    $mockRepo->expects($this->once())
      ->method('create')
      ->willReturn(true);

    $service = new BookingService($mockRepo);

    $data = [
      'name' => 'Bob',
      'email' => 'bob@example.com',
      'date' => '2025-06-15',
    ];

    $this->assertTrue($service->create($data));
  }


    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testListReturnsArray()
  {
    $mockRepo = $this->createMock(BookingRepository::class);

    $mockRepo->expects($this->once())
      ->method('all')
      ->willReturn([
        ['id' => 1, 'name' => 'Bob', 'email' => 'bob@example.com', 'date' => '2025-06-15']
      ]);

    $service = new BookingService($mockRepo);
    $result = $service->list();

    $this->assertIsArray($result);
    $this->assertEquals('Bob', $result[0]['name']);
  }
}
