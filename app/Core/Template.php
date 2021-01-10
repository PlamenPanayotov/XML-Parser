<?php
namespace App\Core;

class Template
{
    const TEMPLATE_FOLDER = "app/View/";
    const TEMPLATE_EXTENSION = ".php";

    public function render(string $templateName, $data = null, string $error = null, string $message = null): void
    {
        require_once self::TEMPLATE_FOLDER
            . $templateName
            . self::TEMPLATE_EXTENSION;
    }
}