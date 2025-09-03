<?php

namespace App\Http\Controllers;

use App\Models\AgenceTransfert;
use App\Models\TransfertArgent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Support\Facades\Validator;

class TransfertController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transferts = TransfertArgent::all();
        return view('transfert.list_transfert', [
            "transferts" => $transferts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = User::where('role', 'client')->get();
        $agences = AgenceTransfert::all();

        $mois = now()->format('m');
        $annee = now()->format('y');
        $dernierId = TransfertArgent::max('id') + 1;
        $numeroDeControle = str_pad($dernierId, 3, '0', STR_PAD_LEFT) . '-JSA-' . $mois . $annee;

        return view('transfert.forms_transfert', [
            'numeroDeControle' => $numeroDeControle,
            'clients' => $clients,
            'agences' => $agences,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'client_id' => 'required|exists:users,id',
            'montant_a_envoyer' => 'required|numeric',
            'montant_a_recevoir' => 'required|numeric',
            'taxe' => 'required|numeric',
            'taux_de_change' => 'required|numeric',
            'destinateur_nom' => 'required|string',
            'destinateur_prenom' => 'required|string',
            'destinateur_telephone' => 'required|string',
            'destinateur_email' => 'nullable|email',
            'type_piece_identite' => 'required|string',
            'numero_piece_identite' => 'required|string',
            'motif_du_transfert' => 'nullable|string',
            'numero_de_controle' => 'required|string',
            'agence_transfert_id' => 'required|exists:agences_transfert,id',
        ]);

        $mois = now()->format('m');
        $annee = now()->format('y');
        $dernierId = TransfertArgent::max('id') + 1;
        $numeroDeControle = str_pad($dernierId, 3, '0', STR_PAD_LEFT) . '-JSA-' . $mois . $annee;

        // Création du transfert
        TransfertArgent::create([
            'user_id' => Auth::id(),
            'client_id' =>  $request->client_id,
            'agence_transfert_id' => $request->agence_transfert_id,
            'montant_a_envoyer' => $request->montant_a_envoyer,
            'montant_a_recevoir' => $request->montant_a_recevoir,
            'taxe' => $request->taxe,
            'statut' => 'En_attente',
            'taux_de_change' => $request->taux_de_change,
            'destinateur_nom' => $request->destinateur_nom,
            'destinateur_prenom' => $request->destinateur_prenom,
            'destinateur_telephone' => $request->destinateur_telephone,
            'destinateur_email' => $request->destinateur_email,
            'type_piece_identite' => $request->type_piece_identite,
            'numero_piece_identite' => $request->numero_piece_identite,
            'motif_du_transfert' => $request->motif_du_transfert,
            'numero_de_controle' => $numeroDeControle,
        ]);

        return redirect('transfert/list_transfert')->with('success', 'Transfert effectué avec succès.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transfert = TransfertArgent::with('agenceTransfert', 'user')->findOrFail($id);
        return view('transfert.edit_transfert', compact('transfert'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'montant_a_envoyer' => 'required|numeric|min:0',
            'montant_a_recevoir' => 'required|numeric|min:0',
            'taux_de_change' => 'required|numeric|min:0',
            'taxe' => 'required|numeric|min:0',
            'motif_du_transfert' => 'nullable|string',
            'type_piece_identite' => 'required|string',
            'numero_piece_identite' => 'nullable|string',
            'destinateur_nom' => 'required|string',
            'destinateur_prenom' => 'required|string',
            'destinateur_telephone' => 'required|string',
            'destinateur_email' => 'nullable|email',
        ]);

        $transfert = TransfertArgent::findOrFail($id);

        $transfert->update([
            'montant_a_envoyer' => $request->montant_a_envoyer,
            'montant_a_recevoir' => $request->montant_a_recevoir,
            'taux_de_change' => $request->taux_de_change,
            'taxe' => $request->taxe,
            'motif_du_transfert' => $request->motif_du_transfert,
            'type_piece_identite' => $request->type_piece_identite,
            'numero_piece_identite' => $request->numero_piece_identite,
            'destinateur_nom' => $request->destinateur_nom,
            'destinateur_prenom' => $request->destinateur_prenom,
            'destinateur_telephone' => $request->destinateur_telephone,
            'destinateur_email' => $request->destinateur_email,
            'statut'  => $request->statut,
        ]);

        return redirect()->back()->with('success', 'Transfert modifié avec succès.');
    }

    public function imprimer($id)
    {
        $transfert = TransfertArgent::with('client', 'user', 'AgenceTransfert')->findOrFail($id);
        return view('transfert.imprimer', compact('transfert')); // Crée une vue propre à l'impression
    }

    public function searchByNumero(Request $request)
    {
        $numero = $request->query('numero');

        $transfert = TransfertArgent::where('numero_de_controle', $numero)->first();

        if ($transfert) {
            return response()->json([
                'success' => true,
                'transfert' => $transfert,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Aucun transfert trouvé',
            ]);
        }
    }
}
