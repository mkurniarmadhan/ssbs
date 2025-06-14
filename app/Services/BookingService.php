<?php

namespace App\Services;

use App\Repositories\BookingRepository;
use Domain\Booking;

class BookingService
{

    public function __construct(private ?BookingRepository $repository = null)
    {
        $this->repository = $repository ?? new BookingRepository();
    }


    public function create(array $data): bool
    {

        $booking = new Booking($data['name'], $data['email'], $data['date']);
        return $this->repository->create($booking);
    }

    public function list(array $filters = [], int $limit = 20, int $offset = 0): array
    {

        return $this->repository->all($filters, $limit, $offset);
    }

    public function
        update(
        int $id,
        array $data
    ): bool {
        return $this->repository->update($id, $data);
    }


}
