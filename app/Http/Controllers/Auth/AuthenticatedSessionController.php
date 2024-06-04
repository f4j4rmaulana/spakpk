<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Session;

class AuthenticatedSessionController extends Controller
{

    private string $uri;

    /**
     * get data sdm
     */
    public function getData($nip, $url, $method, $username, $password)
    {
        $client = new Client();

        try {
            $response = $client->request($method, $url, [
                'auth' => [$username, $password],
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    // tambahkan header tambahan sesuai kebutuhan
                ],
                'query' => [
                    'namaornip' => $nip, // Menambahkan query parameter namaornip
                ],
                // opsi tambahan seperti timeout, proxy, ssl options, dan lainnya bisa ditambahkan di sini
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            return response()->json($data);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $errorResponse = json_decode($e->getResponse()->getBody(), true);
                return response()->json($errorResponse, $e->getResponse()->getStatusCode());
            } else {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
    }

    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $userId = auth()->user()->nomor_id;
        session(['userId' => $userId]);
        // dd(session('userId'));

        $response = AuthenticatedSessionController::getData(
            $userId,
            'https://egov.big.go.id/sdm/siap.php/rest/Daftarpegawai/get_pegawai_big',
            'GET',
            'dat4aks3s',
            'c1b1n0ng')->getData();
        // ambil data
        $responseData = $response->data;
        $data = json_decode($responseData, true);
        //dd($data[0]);

        // Pecah Variabel untuk update
        $satker = $data[0]['Satker'];
        $parts = explode(" - ", $satker);

        $instansi = $parts[0]; // Badan Informasi Geospasial

        // Unit kerja sisanya
        array_shift($parts); // Hapus elemen pertama
        $unit_kerja = implode(" - ", $parts); // Gabungkan kembali elemen-elemen sisanya
        $jabatan = $data[0]['NamaJabatan'];

        // Update single row
        User::where('nomor_id', $userId)->update([
            'instansi' => $instansi,
            'unit_kerja' => $unit_kerja,
            'jabatan' => $jabatan,
        ]);

        toast("Anda berhasil login", 'success');

        return redirect()->intended(RouteServiceProvider::INTERNAL_DASHBOARD);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        toast('Anda berhasil logout', 'success');

        return redirect('/');
    }
}
