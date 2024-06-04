<?php
class MySQLSessionHandler implements SessionHandlerInterface {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function open($savePath, $sessionName): bool {
        return true;
    }

    public function close(): bool {
        return true;
    }

    public function read($id): string {
        $stmt = $this->conn->prepare("SELECT data FROM sessions WHERE id = ? LIMIT 1");
        $stmt->bind_param('s', $id);
        $stmt->execute();
        
        // Inisialisasi variabel $data
        $data = '';
        $stmt->bind_result($data);
        $stmt->fetch();
        $stmt->close();

        return $data;
    }

    public function write($id, $data): bool {
        $access = time();
        $stmt = $this->conn->prepare("REPLACE INTO sessions (id, access, data) VALUES (?, ?, ?)");
        $stmt->bind_param('sis', $id, $access, $data);
        $stmt->execute();
        $stmt->close();

        return true;
    }

    public function destroy($id): bool {
        $stmt = $this->conn->prepare("DELETE FROM sessions WHERE id = ?");
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $stmt->close();

        return true;
    }

    public function gc($maxlifetime): int {
        $old = time() - $maxlifetime;
        $stmt = $this->conn->prepare("DELETE FROM sessions WHERE access < ?");
        $stmt->bind_param('i', $old);
        $stmt->execute();
        $stmt->close();

        return true;
    }
}
?>
