<?php

namespace App\Http\Repository;


interface IBookingRepository
{

	public function create($request);

	public function get($request, $per_page, $paginate = true);

	public function show($id, $request);

	public function update($id, $data);

	public function delete($id);

    public function time_slot($id);
}
