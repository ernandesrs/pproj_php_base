<?php

namespace App\Controllers\Front;

use App\Controllers\FrontController;
use App\Core\Alert;
use App\Core\Mail;
use CoffeeCode\Router\Router;

class TestController extends FrontController
{
    public function __construct(Router $router)
    {
        parent::__construct($router);
    }

    public function index()
    {
        if ($test = filter_input(INPUT_GET, "test")) {
            if (method_exists($this, $test))
                $this->$test();
            else {
                Alert::warning("Ops. Método não encontrado.")->session();
                redirect($this->router->route("front.test"));
            }

            return;
        }

        echo $this->template->render("front/tests/index", [
            "head" => $this->seo->render("Testes | " . CONF_APP_NAME, "Página de testes", "", "", false)
        ]);
        return;
    }

    public function fixed_message()
    {
        Alert::info("Mensagem fixa de teste na sessão")->session();
        redirect($this->router->route("front.test"));
    }

    public function float_message()
    {
        Alert::info("Mensagem flutuante de teste na sessão")->floating()->session();
        redirect($this->router->route("front.test"));
    }

    /**
     * POST
     */
    public function indexPost()
    {
        if ($test = filter_input(INPUT_GET, "test")) {
            if (method_exists($this, $test))
                $this->$test();
            else {
                Alert::warning("Ops. Método não encontrado.")->session();
                redirect($this->router->route("front.test"));
            }

            return;
        }
    }

    public function form_errors()
    {
        sleep(4);
        echo json_encode([
            "success" => false,
            "message" => Alert::error("Erro ao validar dados")->get(),
            "errors" => [
                "name" => "Informe o nome",
                "username" => "Informe o usuário",
            ],
        ]);
        return;
    }

    public function send_mail()
    {
        if (empty($_POST["subject"]) || empty($_POST["message"]) || empty($_POST["to"])) {
            echo json_encode([
                "success" => false,
                "message" => Alert::error("Informe todos os campos!")->get()
            ]);
            return;
        }

        if (!filter_var($_POST["to"], FILTER_VALIDATE_EMAIL)) {
            echo json_encode([
                "success" => false,
                "message" => Alert::error("Informe um email válido!")->get()
            ]);
            return;
        }

        if (!empty($_FILES["attach"])) {
            $file = $_FILES["attach"];

            $validMimeTypes = ["image/png", "image/jpg"];
            if (!in_array($file["type"], $validMimeTypes)) {
                echo json_encode([
                    "success" => false,
                    "message" => Alert::error("Tipo de anexo não aceito. Anexar apenas: " . implode(",", $validMimeTypes))->get()
                ]);
                return;
            }
        }

        $mail = (new Mail($_POST["subject"], $_POST["message"]))
            ->addRecipient($_POST["to"]);

        if ($file ?? null) {
            $mail->addAttachment($file["tmp_name"], $file["name"]);
        }

        if (!$mail->send()) {
            echo json_encode([
                "success" => false,
                "message" => Alert::error("Falha ao enviar mensagem!")->get()
            ]);
            return;
        }

        echo json_encode([
            "success" => true,
            "message" => Alert::success("Mensagem enviada para " . $_POST['to'] . "!")->get()
        ]);
        return;
    }
}
