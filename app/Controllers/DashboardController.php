<?php

// Importa funções auxiliares de autenticação e sessão.
require_once __DIR__ . '/../Middleware/auth.php';


class DashboardController
{

    private PDO $pdo;
    public function __construct()
    {
        require __DIR__ . '/../../config/database.php';
        $this->pdo = $pdo;
    }



    public function resumo(): void
    {
        exigirAutenticacao();

        header('Content-Type: application/json; charset=utf-8'); 
        

        $sql = "SELECT COUNT(*) AS total FROM pessoas";
        $stmt = $this->pdo->query($sql);
        $totalPessoas = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

        $sql = 'SELECT COUNT(*) AS total FROM tipos_atendimentos';
        $stmt = $this->pdo->query($sql);
        $totalTipos = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

        $sql = 'SELECT COUNT(*) AS total  FROM atendimentos';
        $stmt = $this->pdo->query($sql);
        $totalAtendimentos = $stmt->fetch(PDO::FETCH_ASSOC)['total'];


        $dados = [
            'totalPessoas' => $totalPessoas, 
            'totalTipos' => $totalTipos,
            'totalAtendimentos' => $totalAtendimentos
  
        ];

        echo json_encode($dados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

}