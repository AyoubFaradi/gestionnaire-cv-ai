<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JobOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobOfferController extends Controller
{
    public function index(Request $request)
    {
        $query = JobOffer::where('active', true);
        
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('company', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }
        
        if ($request->has('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }
        
        if ($request->has('contract_type')) {
            $query->where('contract_type', $request->contract_type);
        }
        
        $jobOffers = $query->orderBy('created_at', 'desc')->paginate(15);
        
        return response()->json($jobOffers);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'description' => 'required|string|max:5000',
            'location' => 'nullable|string|max:255',
            'contract_type' => 'nullable|string|max:100',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0|gt:salary_min',
            'date_limite' => 'nullable|date|after:today',
            'contact_email' => 'nullable|email',
            'active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $jobOffer = JobOffer::create([
            'title' => $request->title,
            'company' => $request->company,
            'description' => $request->description,
            'location' => $request->location,
            'contract_type' => $request->contract_type,
            'salary_min' => $request->salary_min,
            'salary_max' => $request->salary_max,
            'date_limite' => $request->date_limite,
            'contact_email' => $request->contact_email,
            'active' => $request->active ?? true,
        ]);

        return response()->json($jobOffer, 201);
    }

    public function show($id)
    {
        $jobOffer = JobOffer::findOrFail($id);
        
        return response()->json($jobOffer);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'company' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string|max:5000',
            'location' => 'nullable|string|max:255',
            'contract_type' => 'nullable|string|max:100',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0|gt:salary_min',
            'date_limite' => 'nullable|date|after:today',
            'contact_email' => 'nullable|email',
            'active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $jobOffer = JobOffer::findOrFail($id);
        $jobOffer->update($request->only([
            'title', 'company', 'description', 'location', 'contract_type',
            'salary_min', 'salary_max', 'date_limite', 'contact_email', 'active'
        ]));

        return response()->json($jobOffer);
    }

    public function destroy($id)
    {
        $jobOffer = JobOffer::findOrFail($id);
        $jobOffer->delete();

        return response()->json(['message' => 'Job offer deleted successfully']);
    }
}
