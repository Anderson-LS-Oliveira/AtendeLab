<?php

require_once __DIR__ . '/app/Controllers/UsuariosController.php';
require_once __DIR__ . '/app/Controllers/PessoasController.php';
require_once __DIR__ . '/app/Controllers/AtendimentosController.php';
require_once __DIR__ . '/app/Controllers/TiposAtendimentosController.php';
require_once __DIR__ . '/app/Controllers/AuthController.php';
require_once __DIR__ . '/app/Middleware/auth.php';
require_once __DIR__ . '/app/Controllers/FrontendController.php';
require_once __DIR__ . '/app/Controllers/DashboardController.php';


$controller = $_GET['controller'] ?? 'auth';
$action = $_GET['action'] ?? 'login';

switch ($controller) {

    case 'auth':
        $auth = new AuthController();
        switch ($action) {
            case 'login':
                $auth->exibirLogin();
                break;

            case 'entrar':
                $auth->entrar();
                break;

            case 'dashboard':
                exigirAutenticacao();
                $auth->dashboard();
                break;

            case 'logout':
                $auth->logout();
                break;

            default:
                http_response_code(404);
                echo 'Ação de autenticação não encontrada.';
        }
        break;


    case 'frontend':
    $frontend = new FrontendController();

    switch ($action) {

        case 'pessoas':
            $frontend->pessoas();
            break;

        case 'tipos':
            $frontend->tiposAtendimentos();
            break;

        case 'atendimentos':
            $frontend->atendimentos();
            break;

        default:
            http_response_code(404);
            echo 'Página não encontrada.';
    }

    break;


    case 'dashboard':
    $dashboard = new DashboardController();

    switch ($action) {
        case 'resumo':
            $dashboard->resumo();
            break;

        default:
            http_response_code(404);
            echo 'Página não encontrada.';
    }

    break;


    case 'usuarios':
        exigirAutenticacao();

        $usuarios = new UsuariosController();

        switch ($action) {

            case 'listar':
                $usuarios->listar();
                break;

            case 'buscarPorId':
                $usuarios->buscarPorId();
                break;

            case 'criar':
                $usuarios->criar();
                break;

            case 'atualizar':
                $usuarios->atualizar();
                break;

            case 'excluir':
                exigirAdministrador();
                $usuarios->excluir();
                break;

            default:
                http_response_code(404);
                echo 'Ação de usuários não encontrada.';
        }
        break;


    case 'pessoas':
        exigirAutenticacao();

        $pessoas = new PessoasController();

        switch ($action) {

            case 'listar':
                $pessoas->listar();
                break;

            case 'buscarPorId':
                $pessoas->buscar();
                break;

            case 'criar':
                $pessoas->criar();
                break;

            case 'atualizar':
                $pessoas->atualizar();
                break;

            case 'inativar':
                $pessoas->inativar();
                break;

            case 'excluir':
                exigirAdministrador();
                $pessoas->excluir();
                break;

            default:
                http_response_code(404);
                echo 'Ação de pessoas não encontrada.';
        }
        break;



    case 'tipos':
        exigirAutenticacao();

        $tipos = new TiposAtendimentosController();

        switch ($action) {

            case 'listar':
                $tipos->listar();
                break;

            case 'buscarPorId':
                $tipos->buscar();
                break;

            case 'criar':
                $tipos->criar();
                break;

            case 'atualizar':
                $tipos->atualizar();
                break;

            case 'inativar':
                $tipos->inativar();
                break;

            default:
                http_response_code(404);
                echo 'Ação de tipos não encontrada.';
        }
        break;


    case 'atendimentos':
        exigirAutenticacao();

        $atendimentos = new AtendimentosController();

        switch ($action) {

            case 'listar':
                $atendimentos->listar();
                break;

            case 'visualizar':
                $atendimentos->visualizar();
                break;

            case 'criar':
                $atendimentos->criar();
                break;

            case 'alterarStatus':
                $atendimentos->alterarStatus();
                break;

            case 'opcoesFormulario':
                $atendimentos->opcoesFormulario();
                break;

            case 'excluir':
                exigirAdministrador();
                $atendimentos->excluir();
                break;

            default:
                http_response_code(404);
                echo 'Ação de atendimentos não encontrada.';
        }
        break;

    default:
        http_response_code(404);
        echo 'Controller não encontrado.';
}