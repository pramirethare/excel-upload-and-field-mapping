<?php

namespace Modules\Product\Repositories;

interface ProductRepositoryInterface
{
    public function index();
    public function store($request);
    public function map();
    public function import($request);
    public function download();
}