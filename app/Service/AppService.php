<?php
namespace App\Service;

use App\Model\Book;

class AppService
{
    private $template;

    public function __construct($template)
    {
        $this->template = $template;
    }
    public function getDirContents($dir): array
    {
        $arr = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($dir)
        );

        $files = [];

        foreach ($arr as $file) {
            if ($file->isDir()) {
                continue;
            }

            $files[] = $file->getPathname();
        }
        return $files;
    }

    public function xmlReader(array $files)
    {
        $xmlArr = [];
        foreach ($files as $file) {
            libxml_use_internal_errors(true);
            ($xml = simplexml_load_file($file));
            if (!$xml) {
                $error = 'Broken XML file!';
                $this->template->render('table', null, $error);
                exit;
            }
            libxml_clear_errors();
            $xmlArr[] = $xml;
        }

        return $xmlArr;
    }

    public function extract($xml)
    {
        $books = [];
        foreach ($xml as $key) {
            foreach ($key as $value) {
                $book = new Book();
                $book->setName($value->name);
                $book->setAuthor($value->author);
                $books[] = $book;
            }
        }

        return $books;
    }
}
