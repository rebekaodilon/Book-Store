<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;
use App\Repositories\BookRepository;

class BookService
{
    /**
     * @var BookRepository
     */
    private $bookRepository;

    /**
     * UserService constructor.
     * @param BookRepository $bookRepository
     *
     */

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function getBooks()
    {
        return $this->bookRepository->list();
    }

    public function show($id)
    {
        return $this->bookRepository->findById($id);
    }

    public function store($attributes)
    {
        // Verify if the book already exists
        $bookExists = $this->bookRepository->findBookByIsbn($attributes['isbn']);

        if (!$bookExists)
        {
            return $this->bookRepository->create($attributes);
        }

        return false;
    }

    public function update($id, $attributes)
    {
        $book = $this->bookRepository->update($id, $attributes);

        if ($book) {
            return $book;
        }

        return false;
    }

    public function delete($id)
    {
        $book = $this->bookRepository->delete($id);

        if ($book) {
            return $book;
        }

        return false;
    }


}
