<?php

namespace App\Http\Controllers;

use App\Http\Requests\Consultorio\StoreConsultorioRequest;
use App\Http\Requests\Consultorio\UpdateConsultorioRequest;
use App\Http\Resources\ConsultorioResource;
use App\Models\Consultorio;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ConsultorioController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 15);
        $search = $request->query('search');

        $consultorios = Consultorio::query()
            ->when($search, function ($query, $value) {
                $query->where('nombre', 'like', "%{$value}%")
                    ->orWhere('ubicacion', 'like', "%{$value}%");
            })
            ->orderBy('id', 'desc')
            ->paginate($perPage);

        return ConsultorioResource::collection($consultorios);
    }

    public function store(StoreConsultorioRequest $request)
    {
        $consultorio = Consultorio::create($request->validated());

        return ConsultorioResource::make($consultorio)
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Consultorio $consultorio)
    {
        return ConsultorioResource::make($consultorio);
    }

    public function update(UpdateConsultorioRequest $request, Consultorio $consultorio)
    {
        $consultorio->update($request->validated());

        return ConsultorioResource::make($consultorio);
    }

    public function destroy(Consultorio $consultorio)
    {
        $consultorio->delete();
        return response()->noContent();
    }
}
