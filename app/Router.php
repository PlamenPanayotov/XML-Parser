<?php
namespace App;

class Router
{
    private $service;

    private $bookRepository;

    private $template;

    public function __construct($service, $bookRepository, $template)
    {
        $this->service = $service;

        $this->bookRepository = $bookRepository;

        $this->template = $template;
    }

    public function index()
    {
        $this->bookRepository->createTable();
        
        return $this->template->render('table');
    }

    public function insert($dir)
    {
        $this->bookRepository->createTable();
        
        $xml = $this->service->getDirContents($dir);

        $xmlArr = $this->service->xmlReader($xml);

        $books = $this->service->extract($xmlArr);

        $list = $this->bookRepository->insert($books);

        if (count($list) == 1) {
            $message = count($list) . ' book has been added.';
        } elseif (count($list) > 0) {
            $message = count($list) . ' books have been added';
        } else {
            $message = 'There is no new data';
        }

        return $this->template->render('table', $list, null, $message);
    }

    public function allBooks()
    {
        $this->bookRepository->createTable();

        $books = $this->bookRepository->getAll();

        return $this->template->render('table', $books);
    }

    public function search()
    {
        if (isset($_GET['search'])) {
            $query = $_GET['search'];
            // var_dump($query);
            // exit;
            $query = htmlspecialchars($query);
            $result = $this->bookRepository->search($query);

            return $this->template->render('table', $result);
        }
    }
}
