<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CandidateController extends Controller
{
    /**
     * @description Permet de récupérer les commentaires sur un candidat
     */
    public function all() {
        $candidates = Candidate::all();

        return view('candidate', compact('candidates'));
    }

    public function findById($id) {
        /*
        $name = "Ottis Cremin";
        Candidate::where('name', '=', $name)->first();
        */

        $candidate = Candidate::where('id', '=', $id)->first();
        return view('update', compact('candidate'));
        //return Candidate::find($id);
    }

    public function create(Request $request) {
        if(!$this->isValid($request)) {
            return  "Incorrecte";
        }

        /*
        $candidate = new Candidate([
            'name' => $request->get('name')
        ]);
        */

        //Identique aux trois lignes de codes supérieures
        $candidate = new Candidate();
        $candidate->name = $request->get('name');
        $candidate->save();

        return back();
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:2', 'max:30']
        ]);

        if($validator->fails()) { return $validator->errors();}

        $candidate = Candidate::where('id', '=', $id)->first();
        if ($candidate == null) {
            dd($candidate->name);
            return "Le candidat n'existe pas";
        }

        $candidate->name = $request->get('name');
        $candidate->save();

        return $this->all();
    }

    public function delete($id) {
        $candidate = Candidate::where('id', '=', $id)->first();

        if($candidate == null) {
            return "Le candidat n'existe pas";
        }

        $candidate->delete();

        return "...";
    }

    private function exist($id) {
        $candidate = Candidate::where('id', '=', $id)->get();
        if ($candidate == null) {
            return false;
        }
        return true;
    }

    private function isValid(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:2', 'max:30']
        ]);

        return !$validator->fails();
    }
}
