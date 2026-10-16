<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatalogController extends Controller
{
    // Временное хранилище: в ЛПР № 9 его заменит база данных
    private function apartments(): array
    {
        return [
            ['id' => 1, 'code' => 'ES-11', 'address' => 'ул. Кунаева, 12, кв. 45',      'district' => 'Есиль',       'area' => 54.30,  'rooms' => 2, 'price' => 38500000.00, 'is_new_building' => true],
            ['id' => 2, 'code' => 'ES-12', 'address' => 'пр. Мангилик Ел, 27, кв. 108', 'district' => 'Есиль',       'area' => 82.10,  'rooms' => 3, 'price' => 61200000.00, 'is_new_building' => true],
            ['id' => 3, 'code' => 'AL-21', 'address' => 'ул. Бейбитшилик, 5, кв. 12',   'district' => 'Алматинский', 'area' => 38.00,  'rooms' => 1, 'price' => 21900000.00, 'is_new_building' => false],
            ['id' => 4, 'code' => 'AL-22', 'address' => 'ул. Достык, 18, кв. 77',       'district' => 'Алматинский', 'area' => 66.75,  'rooms' => 3, 'price' => 34700000.00, 'is_new_building' => false],
            ['id' => 5, 'code' => 'SA-31', 'address' => 'ул. Сарыарка, 3, кв. 9',       'district' => 'Сарыарка',    'area' => 45.50,  'rooms' => 2, 'price' => 25300000.00, 'is_new_building' => false],
            ['id' => 6, 'code' => 'SA-32', 'address' => 'ул. Богенбай батыра, 40, кв. 150', 'district' => 'Сарыарка', 'area' => 120.40, 'rooms' => 4, 'price' => 74800000.00, 'is_new_building' => true],
            ['id' => 7, 'code' => 'BA-41', 'address' => 'ул. Орынбор, 8, кв. 33',       'district' => 'Байконур',    'area' => 29.90,  'rooms' => 1, 'price' => 17600000.00, 'is_new_building' => true],
        ]; // ровно ITEMS = 7
    }

    // GET /catalog?q=...&sort=...
    public function index(Request $request)
    {
        $apartments = collect($this->apartments());

        $search = $request->query('q');
        if ($search) {
            $apartments = $apartments->filter(fn ($a) => mb_stripos($a['address'], $search) !== false);
        }

        $sort = $request->query('sort', 'address');
        if (in_array($sort, ['address', 'area', 'price'])) {
            $apartments = $apartments->sortBy($sort);
        }

        return view('catalog.index', [
            'title'      => 'Каталог квартир',
            'apartments' => $apartments,
            'search'     => $search,
            'sort'       => $sort,
        ]);
    }

    // GET /catalog/3
    public function show(int $id)
    {
        $apartment = collect($this->apartments())->firstWhere('id', $id);
        abort_if(! $apartment, 404);

        return view('catalog.show', ['title' => $apartment['address'], 'apartment' => $apartment]);
    }

    // GET /catalog/code/ES-11
    public function byCode(string $code)
    {
        $apartment = collect($this->apartments())->firstWhere('code', $code);
        abort_if(! $apartment, 404);

        return view('catalog.show', ['title' => $apartment['address'], 'apartment' => $apartment]);
    }

    // GET /catalog/district/Есиль  или  /catalog/district
    public function byDistrict(?string $district = null)
    {
        $apartments = collect($this->apartments());

        // ⭐ без параметра — список районов, а не все записи
        if (! $district) {
            return view('catalog.districts', [
                'title'     => 'Все районы',
                'districts' => $apartments->pluck('district')->unique(),
                'counts'    => $apartments->countBy('district'),
            ]);
        }

        return view('catalog.index', [
            'title'      => "Квартиры: {$district}",
            'apartments' => $apartments->where('district', $district),
            'search'     => null,
            'sort'       => 'address',
        ]);
    }

    // ⭐ GET /catalog/stats
    public function stats()
    {
        $apartments = collect($this->apartments());

        return view('catalog.stats', [
            'title' => 'Статистика',
            'count' => $apartments->count(),
            'avg'   => $apartments->avg('price'),
            'min'   => $apartments->min('price'),
            'max'   => $apartments->max('price'),
        ]);
    }
}
