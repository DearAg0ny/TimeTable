<?php

namespace App\Http\Controllers;

use App\Models\CompletedJobs;
use App\Models\Service;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;

class CompletedJobsController extends Controller
{

    public function index()
    {
        $services = DB::table('services')
            ->select('date','company_name','service_name','description','from','to')
            ->join('completed_jobs','completed_jobs.id','=','services.service_id')
            ->get();

        return response()->json($services);

    }

    public function addCompletedJob(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'company' => 'required',
            'service' => 'required',
            'description' => 'required',
            'from' => 'required',
            'to' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        CompletedJobs::create([
            'date' => request('date'),
            'company' => request('company'),
            'service' => request('service'),
            'description' => request('description'),
            'from' => request('from'),
            'to' => request('to')
        ]);
    }

    public function deleteCompletedJob($id)
    {
        $task = CompletedJobs::find($id);
        $task->delete();
        return response()->json(['message'=>'Completed job deleted']);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CompletedJobs  $completedJobs
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, CompletedJobs $completedJobs, $id)
    {
        $completedJobs = CompletedJobs::find($id);
        $completedJobs->update($request->all());
        return response()
            ->json(['message'=>'Completed job updated']);
    }
}
