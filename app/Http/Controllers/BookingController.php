<?php

namespace App\Http\Controllers;

use App\Services\BookingService;

class BookingController
{
    public function __construct(private BookingService $service)
    {
        $this->service = new BookingService();
    }

    public function update($id): void
    {

        $data = json_decode(file_get_contents('php://input'), true);
        $success = $this->service->update($id, $data);
        echo json_encode([
            'success' => $success,
            'message' => $success ? 'Booking created' : 'Failed to create booking'
        ]);
    }

    public function store(): void
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (!$data['name'] || !$data['email'] || !$data['date']) {
            http_response_code(422);
            echo json_encode(['error' => 'Missing required fields']);
            return;
        }


        $success = $this->service->create($data);

        echo json_encode([
            'success' => $success,
            'message' => $success ? 'Booking created' : 'Failed to create booking'
        ]);
    }

    public function index(): void
    {

        $filters = [

            'name' => $_GET['name'] ?? null,
            'email' => $_GET['email'] ?? null,
        ];

        $limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 20;
        $offset = isset($_GET['offset']) ? (int) $_GET['offset'] : 0;

        $data = $this->service->list($filters, $limit, $offset);
        echo json_encode($data);
    }
}
