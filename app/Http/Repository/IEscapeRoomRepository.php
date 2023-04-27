<?php

namespace App\Http\Repository;


interface IEscapeRoomRepository
{

	public function create($request);

	public function get($request, $per_page, $paginate = true);

	public function show($id);

	public function update($id, $data);

	public function delete($id);

    public function time_slots($id);
}
