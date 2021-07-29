<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecordRequest;
use App\Models\Record;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use Throwable;

class RecordController extends Controller
{
    use ApiResponder;

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $records = Record::all();

        return $this->handleResponse([
            'records' => $records,
        ]);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  RecordRequest  $request
     * @return JsonResponse
     */
    public function store(RecordRequest $request): JsonResponse
    {
        try {
            $record = new Record($request->validated());

            $record->save();

            return $this->handleResponse([
                'record' => $record,
            ], 201);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $record = Record::findOrFail($id);

            return $this->handleResponse([
                'record' => $record->toArray(),
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  RecordRequest  $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(RecordRequest $request, int $id): JsonResponse
    {
        try {
            $record = Record::findOrFail($id);

            $data = $request->validated();

            $record->update($data);

            return $this->handleResponse([
                'record' => $record,
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        try {
            $record = Record::findOrFail($id);

            $record->delete();

            return $this->handleResponse([
                'record' => $record,
            ]);
        } catch (Throwable $e) {
            return $this->handleError($e->getCode(), $e->getMessage());
        }
    }
}
