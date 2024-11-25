<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MerchantController extends Controller
{
    public function accept(Request $request, $id)
    {
        try {
            $merchant = Merchant::findOrFail($id);

            if ($merchant->status === 'active') {
                return redirect()->route('admin.merchants.index')->with('sweetalert', [
                    'title' => 'Info',
                    'text' => 'Merchant ini sudah diterima sebelumnya.',
                    'icon' => 'info',
                ]);
            }

            // Update merchant status to active
            $merchant->update(['status' => 'active']);

            // Assign 'merchant' role to the user
            $merchant->owner->syncRoles(['merchant']);

            return redirect()->route('admin.merchants.index')->with('sweetalert', [
                'title' => 'Berhasil',
                'text' => 'Merchant berhasil diterima dan pengguna dipromosikan ke peran Merchant.',
                'icon' => 'success',
            ]);
        } catch (\Exception $e) {
            return redirect()->route('admin.merchants.index')->with('sweetalert', [
                'title' => 'Error',
                'text' => 'Terjadi kesalahan saat menerima merchant. Silakan coba lagi.',
                'icon' => 'error',
            ]);
        }
    }

    public function reject(Request $request, $id)
    {
        try {
            $merchant = Merchant::findOrFail($id);

            if ($merchant->status === 'rejected') {
                return redirect()->route('admin.merchants.index')->with('sweetalert', [
                    'title' => 'Info',
                    'text' => 'Merchant ini sudah ditolak sebelumnya.',
                    'icon' => 'info',
                ]);
            }

            // Update merchant status to rejected
            $merchant->update(['status' => 'rejected']);

            return redirect()->route('admin.merchants.index')->with('sweetalert', [
                'title' => 'Berhasil',
                'text' => 'Merchant berhasil ditolak.',
                'icon' => 'success',
            ]);
        } catch (\Exception $e) {
            return redirect()->route('admin.merchants.index')->with('sweetalert', [
                'title' => 'Error',
                'text' => 'Terjadi kesalahan saat menolak merchant. Silakan coba lagi.',
                'icon' => 'error',
            ]);
        }
    }

    public function homeIndex(Request $request) {
        $search = $request->get('search', '');
        $filterType = $request->get('type', 'all');

        $query = Merchant::query()->where('status', 'active');

        // Apply search filter
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        // Filter by delivery type (Delivery, Takeaway)
        if ($filterType === 'delivery') {
            $query->whereHas('products', function ($q) {
                $q->where('delivery_available', true);
            });
        } elseif ($filterType === 'takeaway') {
            $query->whereHas('products', function ($q) {
                $q->where('takeaway_available', true);
            });
        }

        $merchants = $query->paginate(12);

        return view('merchants.index', compact('merchants', 'search', 'filterType'));
    }

    public function index()
    {
        $merchants = Merchant::latest()->paginate(10);
        $totalMerchants = Merchant::count();
        $pendingMerchants = Merchant::where('status', 'pending')->count();

        return view('admin.merchants.index', compact('merchants', 'totalMerchants', 'pendingMerchants'));
    }

    public function show($id)
    {
        $merchant = Merchant::findOrFail($id);

        return view('admin.merchants.show', compact('merchant'));
    }


    /**
     * Show the merchant registration form.
     *
     * @return \Illuminate\View\View
     */
    public function registerForm()
    {
        if (!Auth::check()) {
            return view('merchant.register', ['authRequired' => true]);
        }

        $user = Auth::user();

        // Eager-load the merchant relationship
        $user->load('merchant');

        if ($user->merchant) {
            return redirect()->route('dashboard')
                ->with('sweetalert', [
                    'title' => 'Info',
                    'text' => 'Anda sudah memiliki akun merchant.',
                    'icon' => 'info'
                ]);
        }

        return view('merchant.register', ['authRequired' => false]);
    }

    /**
     * Handle the merchant registration submission.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'description' => 'nullable|string|max:1000',
        ]);

        // Create the merchant record
        $merchant = Merchant::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'description' => $request->description,
            'status' => 'pending', // Default status as pending
            'rating' => 0, // Default rating
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Pendaftaran merchant Anda telah dikirim dan menunggu persetujuan.');
    }
}
