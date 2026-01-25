<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use Illuminate\Http\Request;

class EmployeController extends Controller
{
    public function index(Request $request)
    {
        $query = Employe::query();

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('nom', 'like', "%{$s}%")
                    ->orWhere('prenom', 'like', "%{$s}%")
                    ->orWhere('email', 'like', "%{$s}%")
                    ->orWhere('poste', 'like', "%{$s}%")
                    ->orWhere('telephone', 'like', "%{$s}%");
            });
        }

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        if ($request->filled('type_contrat')) {
            $query->where('type_contrat', $request->type_contrat);
        }

        $employes = $query->orderBy('nom')->orderBy('prenom')->paginate(15)->withQueryString();

        return view('employes.index', compact('employes'));
    }

    public function create()
    {
        return view('employes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'poste' => 'nullable|string|max:255',
            'type_contrat' => 'nullable|string|max:100',
            'salaire' => 'nullable|numeric|min:0',
            'salaire_type' => 'nullable|in:mensuel,journalier,horaire',
            'date_embauche' => 'nullable|date',
            'telephone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'adresse' => 'nullable|string',
            'statut' => 'required|in:actif,inactif',
        ]);

        Employe::create($validated);

        return redirect()->route('employes.index')->with('success', 'Employé créé avec succès.');
    }

    public function edit(Employe $employe)
    {
        return view('employes.edit', compact('employe'));
    }

    public function update(Request $request, Employe $employe)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'poste' => 'nullable|string|max:255',
            'type_contrat' => 'nullable|string|max:100',
            'salaire' => 'nullable|numeric|min:0',
            'salaire_type' => 'nullable|in:mensuel,journalier,horaire',
            'date_embauche' => 'nullable|date',
            'telephone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'adresse' => 'nullable|string',
            'statut' => 'required|in:actif,inactif',
        ]);

        $employe->update($validated);

        return redirect()->route('employes.index')->with('success', 'Employé mis à jour avec succès.');
    }

    public function destroy(Employe $employe)
    {
        $employe->delete();
        return redirect()->route('employes.index')->with('success', 'Employé supprimé avec succès.');
    }
}
