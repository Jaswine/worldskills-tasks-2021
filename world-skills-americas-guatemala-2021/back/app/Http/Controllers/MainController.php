<?php

namespace App\Http\Controllers;

use App\Models\Competence;
use App\Models\Job;
use App\Models\Level as Level;
use App\Models\User;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class MainController extends Controller
{
    // all jobs
    public function jobIndicator(Request $request ) {
        $jobs = Job::all(); // get all jobs
        $levels = Level::all();

        $title = 'Job Indicator';
        // show all jobs
        return view('index', [
            'title' => $title,
            'jobs' => $jobs,
            'levels' => $levels,
        ]);
    }

    // Add new user
    public function jobIndicatorCreate(Request $request) {
        // get all data
        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;

        $levels = $request->levels;
        $types = $request->types;
        $heights = $request->heights;

        $job = $request->job;
        $points = 0;

        // create new massive for data
        $knowledges = [];

        // Create from 2 massives one massive
        for ($i = 0; $i < count($levels); $i++) {
            if ($levels[$i] == 'Beginner') {
                $points += 0.33 * intval($heights[$i]) ;
            } elseif ($levels[$i] == 'Full') {
                $points += 0.66 * intval($heights[$i] );
            } elseif ($levels[$i] == 'Expert') {
                $points += 1 * intval($heights[$i]) ;
            }

            $knowledges[$types[$i]] = $levels[$i];
        }

        // check user is created or not
        $emailIsHave = User::where('email', $email)->where('job_id', $job)->first();

        // if user is already we need to update data
        if ($emailIsHave) {
            $user = User::where('email', $email)->first();

            $user->name = $name;
            $user->phone = $phone;
            $user->knowledges = $knowledges;
            $user->points = $points;

            $user->save();
            return redirect('/XX_module05/');
        }

        # create new user
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'knowledges' => json_encode($knowledges),
            'job_id' => $job,
            'points' => $points,
        ]);

        return redirect('/XX_module05/');
    }

    # show page there we can show list of users
    public function jobIndicatorList(Request $request ) {
        $title = 'Job Indicator List';

        $jobs = Job::all(); // show all jobs
        
        return view('index', [
            'title' => $title,
            'jobs' => $jobs,
        ]);
    }

    // Show list of user
    public function jobIndicatorShowOneUser(Request $request) {
        $user = User::where('email', $request->email)->first();
    
        if ($user) {
            return response([
                'name' => $user->name,
                'phone' => $user->phone,
            ]);
        } else {
            return response([
                'message' => 'user not found'
            ]);
        }
    }

    public function createJobView(Request $request ) {
        $title = 'Create Job';
        
        return view('index', [
            'title' => $title,
        ]);
    }

    public function createJob(Request $request ) {
        $get_job = $request->job;

        $competences = $request->competence;

        $heights = $request->height;
        $heights_count = 0;

        for ($i=0; $i < count($heights); $i++) { 
           $heights_count += $heights[$i];
        }

        if ($heights_count == 100) {
            $job = Job::create([
                'job' => $get_job
            ]);
    
            for ($i=0; $i < count($competences); $i++) { 
                $comp = Competence::create([
                    'competence' => $competences[$i],
                    'height' => $heights[$i],
                    'job_id' => $job->id,
                ]);
            }
    
            return redirect('/XX_module05/');
        } else {
            return redirect()->back()->withErrors(['score' => 'Total score must be at least 100.']); 
        }
    }
}

