<?php

namespace App\Http\Controllers;

use App\Http\Requests\Job\UpdateJobRequest;
use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Resources\JobResource;
use App\Http\Requests\Jobs\CreateJobRequest;

class JobController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		return JobResource::collection(
			Job::query()->orderBy('id')->paginate()
		);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(CreateJobRequest $request)
	{
		$data = $request->validated();
		$job = Job::create($data);
		return response(new JobResource($job), 201);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Job $job)
	{
		return response(new JobResource($job), 201);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateJobRequest $request, Job $job)
	{
		$data = $request->validated();
		$job->update($data);
		return new JobResource($job);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Job $job)
	{
		$job->delete();
		return response('', 204);
	}
}
