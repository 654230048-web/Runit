<?php
class Event
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getEvents(?string $province = null, ?string $category = null): array
    {
        $sql = "SELECT * FROM events WHERE status = 'open'";
        $params = [];

        if ($province) {
            $sql .= " AND location_province = :province";
            $params[':province'] = $province;
        }
        if ($category) {
            $sql .= " AND category = :category";
            $params[':category'] = $category;
        }

        $sql .= " ORDER BY event_date ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function getById(int $eventId): array|false
    {
        $stmt = $this->conn->prepare("SELECT * FROM events WHERE event_id = :id LIMIT 1");
        $stmt->execute([':id' => $eventId]);
        return $stmt->fetch();
    }
}
