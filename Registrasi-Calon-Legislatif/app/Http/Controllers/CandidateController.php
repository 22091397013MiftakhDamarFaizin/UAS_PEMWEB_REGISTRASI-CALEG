<?php
namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CandidateController extends Controller
{
    public function index()
    {
        // Mendapatkan ID pengguna yang sedang masuk
        $userId = auth()->user()->id;
    
        // Hitung jumlah caleg yang diunggah oleh pengguna saat ini
        $userCalegCount = Candidate::where('user_id', $userId)->count();

        $candidates = Candidate::all();
        return view('beranda-parpol', compact('candidates', 'userCalegCount'));
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function daftarCalegRegistrasi()
    {
        // Dapatkan ID user yang sedang login
        $userId = Auth::id();

        // Ambil daftar caleg yang diupload oleh user yang sedang login
        $candidates = Candidate::where('user_id', $userId)->get();

        return view('daftar-caleg-registrasi', compact('candidates'));
    }

    
    public function create()
    {
        return view('candidates.create');
    }

    public function store(Request $request)
    {
        // Mendapatkan ID pengguna yang sedang masuk
        $userId = auth()->user()->id;
    
        // Hitung jumlah caleg yang diunggah oleh pengguna saat ini
        $userCalegCount = Candidate::where('user_id', $userId)->count();
    
        // Cek apakah jumlah caleg sudah mencapai batas maksimum
        if ($userCalegCount >= 5) {
            return redirect()->back()->with('error', 'Anda hanya bisa mengunggah maksimal 5 caleg.');
        }
    
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string',
            'formulir' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png',
            'ktp' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png',
            'ijazah' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png',
            'surat_pernyataan' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png',
            'surat_bebas_narkoba' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png',
        ]);
    
        $formulirPath = $request->file('formulir')->store('formulirs', 'public');
        $ktpPath = $request->file('ktp')->store('ktps', 'public');
        $ijazahPath = $request->file('ijazah')->store('ijazahs', 'public');
        $suratPernyataanPath = $request->file('surat_pernyataan')->store('surat_pernyataans', 'public');
        $suratBebasNarkobaPath = $request->file('surat_bebas_narkoba')->store('surat_bebas_narkobas', 'public');
    
        $candidate = new Candidate();
        $candidate->name = $request->name;
        $candidate->position = $request->position;
        $candidate->formulir = $formulirPath;
        $candidate->ktp = $ktpPath;
        $candidate->ijazah = $ijazahPath;
        $candidate->surat_pernyataan = $suratPernyataanPath;
        $candidate->surat_bebas_narkoba = $suratBebasNarkobaPath;
        $candidate->user_id = $userId; // Menyimpan 'user_id'
        $candidate->save();
    
        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }
    
}
