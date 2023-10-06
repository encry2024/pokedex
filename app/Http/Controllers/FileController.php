<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FileController extends Controller
{
    const TIME_INTERVAL = 5;
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse|array
     */
    public function pokemonJson() : JsonResponse|array
    {
        $filePath = storage_path('pokedex.json');

        if (file_exists($filePath)) {
            $fileContents = str_replace("\n", '', file_get_contents($filePath));
            $pokemonArray = json_decode($fileContents, true);
            $pokemonArray = $this->modifyPokemonTypeKey($pokemonArray);
            $pokemonImageArray = $this->pokemonImageArray();

            return $this->mergeDataAndImages($pokemonArray, $pokemonImageArray);
        } else {
            return response()->json(['error' => 'File not found'], 404);
        }
    }

    private function pokemonImageArray() : array
    {
        $imagePath = public_path('/pokemon_data/images/'); // Change this path to your image folder location
        $imageArray = [];

        if (File::isDirectory($imagePath)) {
            $files = File::allFiles($imagePath);

            foreach ($files as $file) {
                $imageArray[] = asset('/pokemon_data/images/' . $file->getFilename());
            }
        }

        return $imageArray;
    }

    private function mergeDataAndImages(array $pokemons, array $pokemonImage): array
    {
        $newPokemonArray = $pokemons;

        foreach ($newPokemonArray as $key => $pokemon) {
            $newPokemonArray[$key]['image'] = $pokemonImage[$key];
        }

        return $newPokemonArray;
    }

    private function modifyPokemonTypeKey(array $pokemons): array
    {
        $newPokemonArrays = $pokemons;

        foreach ($newPokemonArrays as &$newPokemonArray) {
            $updatedTypeArray = [];

            foreach ($newPokemonArray['type'] as $key => $value) {
                switch ($value) {
                    case "Grass":
                        $updatedTypeArray['green'] = $value;
                        break;
                    case "Poison":
                        $updatedTypeArray['purple'] = $value;
                        break;
                    case "Fire":
                        $updatedTypeArray['red'] = $value;
                        break;
                    case "Bug":
                        $updatedTypeArray['bug'] = $value;
                        break;
                    case "Water":
                        $updatedTypeArray['water'] = $value;
                        break;
                    case "Flying":
                        $updatedTypeArray['teal'] = $value;
                        break;
                    case "Normal":
                        $updatedTypeArray['secondary'] = $value;
                        break;
                    case "Ground":
                        $updatedTypeArray['walnut_shell'] = $value;
                        break;
                    case "Fairy":
                        $updatedTypeArray['fairy'] = $value;
                        break;
                    case "Electric":
                        $updatedTypeArray['electric'] = $value;
                        break;
                    default:
                        $updatedTypeArray[$key] = $value;
                }
            }

            $newPokemonArray['type'] = $updatedTypeArray;
        }

        return $newPokemonArrays;
    }
}
