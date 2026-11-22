<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PromotionController extends Controller
{
    public function edit()
    {
        $promotion = Promotion::query()->first() ?? new Promotion([
            'badge' => 'Promo hari ini',
            'title' => 'Promo spesial RasaKita',
            'description' => 'Nikmati promo menarik hari ini.',
            'is_active' => true,
        ]);

        return view('admin.promotions.form', compact('promotion'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'badge' => ['required', 'string', 'max:80'],
            'title' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string', 'max:1000'],
            'image' => ['nullable', 'image', 'max:4096'],
            'starts_on' => ['nullable', 'date'],
            'ends_on' => [
                'nullable',
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value && $request->filled('starts_on') && $value < $request->input('starts_on')) {
                        $fail('Tanggal selesai harus sama atau setelah tanggal mulai.');
                    }
                },
            ],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('promotions', 'public');
        }
        $data['is_active'] = $request->boolean('is_active');

        $promotion = Promotion::query()->first() ?? new Promotion();

        if (isset($data['image']) && $promotion->image && !Str::startsWith($promotion->image, ['http://', 'https://'])) {
            Storage::disk('public')->delete($promotion->image);
        }

        $promotion->fill($data);
        $promotion->save();

        return redirect()->route('admin.promotions.edit')->with('success', 'Promosi berhasil diperbarui.');
    }
}
