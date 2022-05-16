<?php

namespace App\Http\Controllers;

use App\Models\{Categoria, Zona, CategoriaZona};

class CategoriaZonaController extends Controller
{
    public function anexandoZona(int $zonaId, $categorias)
    {
        $CZs = CategoriaZona::query()->get();
        $this->validandoZona($zonaId, $categorias, $CZs);

        foreach ($categorias as $categoria) {
            $categoria = Categoria::findOrFail($categoria);
            $zona = Zona::findOrFail($zonaId);
            $categoria->zonas()->attach($zona);
        }   
    }

    public function validandoZona(int $zonaId, array $categorias, $CZs)
    {
        foreach ($CZs as $CZ) {
            foreach ($categorias as $categoria) {
                if ($CZ->zona_id == $zonaId && $CZ->categoria_id == $categoria) {
                    $categoria = Categoria::findOrFail($categoria);
                    $zona = Zona::findOrFail($zonaId);
                    $categoria->zonas()->detach($zona);
                    break;
                }
            }
        }
    }

    public function desanexandoZona(int $zonaId)
    {
        $CZs = CategoriaZona::query()->get();
        foreach ($CZs as $CZ) {
            if ($CZ->zona_id == $zonaId) {
                $categoria = Categoria::findOrFail($CZ->categoria_id);
                $zona = Zona::findOrFail($zonaId);
                $categoria->zonas()->detach($zona);
            }
        }
    }

    public function anexandoCategoria(int $categoriaId, $zonas)
    {
        $CZs = CategoriaZona::query()->get();
        $this->validandoCategoria($categoriaId, $zonas, $CZs);

        foreach ($zonas as $zona) {
            $zona = Zona::findOrFail($zona);
            $categoria = Categoria::findOrFail($categoriaId);
            $categoria->zonas()->attach($zona);
        }   
    }

    public function validandoCategoria(int $categoriaId, array $zonas, $CZs)
    {
        foreach ($CZs as $CZ) {
            foreach ($zonas as $zona) {
                if ($CZ->categoria_id == $categoriaId && $CZ->zona_id == $zona) {
                    $categoria = Categoria::findOrFail($categoriaId);
                    $zona = Zona::findOrFail($zona);
                    $categoria->zonas()->detach($zona);
                    break;
                }
            }
        }
    }

    public function desanexandoCategoria(int $categoriaId)
    {
        $CZs = CategoriaZona::query()->get();
        foreach ($CZs as $CZ) {
            if ($CZ->categoria_id == $categoriaId) {
                $zona = Zona::findOrFail($CZ->zona_id);
                $categoria = Categoria::findOrFail($categoriaId);
                $categoria->zonas()->detach($zona);
            }
        }
    }
}
