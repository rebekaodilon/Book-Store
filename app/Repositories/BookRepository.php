<?php

namespace App\Repositories;

use App\Models\Book;
use App\Interfaces\UserInterface;

class BookRepository extends BaseRepository
{

    public function __construct()
    {
        parent::__construct(new Book());
    }

    public function list()
    {
        return parent::findAll();
    }

    public function create($attributes): Book
    {
        return parent::create($attributes);
    }

    public function update($id, $attributes)
    {
        return parent::update($id, $attributes);
    }

    public function findById($id)
    {
        return parent::find($id);
    }

    public function findBookByIsbn($isbn)
    {
        return parent::findByField('isbn', $isbn);
    }

    public function delete($id)
    {
        return parent::destroy($id);
    }
}
