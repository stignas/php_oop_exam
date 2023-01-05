<?php
declare(strict_types=1);

namespace eas\Handlers;

class FileHandler
{
    private const PATH = __DIR__ . '/../Files/pendingPayments.json';


    public function getData(): array
    {
        $array = [];
        if (json_decode(file_get_contents(self::PATH), true)) {
            $array = json_decode(file_get_contents(self::PATH), true);
        }
        return $array;
    }

    public function updateJsonPaymentStatus(array $data): void
    {
        file_put_contents(self::PATH, json_encode($data, JSON_PRETTY_PRINT));
    }

    public function addEntryToFile(array $data): void
    {
        $array = $this->getData();
        $array[] = $data;
        file_put_contents(self::PATH, json_encode($array, JSON_PRETTY_PRINT));
    }
}