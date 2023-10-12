<?php

namespace App\Http\Controllers;

use App\Http\Resources\MotherBoardResource;
use App\Models\Brand;
use App\Models\GraphicCard;
use App\Models\Machine;
use App\Models\Motherboard;
use App\Models\PowerSupply;
use App\Models\Processor;
use App\Models\RamMemory;
use App\Models\StorageDevice;
use App\Models\User;
use Illuminate\Http\Request;

class DetailsController extends Controller
{
    public function all_details(Request $request) {
        # Auth Checking
        // $token = $request->bearerToken();
        // $user = User::where('accessToken', $token)->first();

        // if (!$token) {
        //     return response()->json(['message' => 'Invalid Token'], 403);
        // }
        // if (!$user) {
        //     return response()->json(['message' => 'Authentication required'], 401);
        // }

        $motherboards = Motherboard::all();
        $processors = Processor::all();
        $rammemories = RamMemory::all();
        $storagedevices = StorageDevice::all();
        $graphiccards = GraphicCard::all();
        $machines = Machine::all();
        $power_supplies = PowerSupply::all();
        $brands = Brand::all();

        return response()->json([
            'motherboards' => MotherBoardResource::collection($motherboards),
            'processors' => $processors,
            'rammemories' => $rammemories,
            'storagedevices' => $storagedevices,
            'graphiccards' => $graphiccards,
            'machines' => $machines,
            'power_supplies' => $power_supplies,
            'brands' => $brands
        ], 200);
    }

    public function motherboards(Request $request) {
        # Auth Checking
        $token = $request->bearerToken();
        $user = User::where('accessToken', $token)->first();

        if (!$token) {
            return response()->json(['message' => 'Invalid Token'], 403);
        }
        if (!$user) {
            return response()->json(['message' => 'Authentication required'], 401);
        }

        $motherboards = Motherboard::all();

        return response()->json( MotherBoardResource::collection($motherboards), 200);
    }


    public function processors(Request $request) {
        # Auth Checking
        $token = $request->bearerToken();
        $user = User::where('accessToken', $token)->first();

        if (!$token) {
            return response()->json(['message' => 'Invalid Token'], 403);
        }
        if (!$user) {
            return response()->json(['message' => 'Authentication required'], 401);
        }

        $processors = Processor::all();


        return response()->json( $processors,200);
    }

    public function rammemories(Request $request) {
        # Auth Checking
        $token = $request->bearerToken();
        $user = User::where('accessToken', $token)->first();

        if (!$token) {
            return response()->json(['message' => 'Invalid Token'], 403);
        }
        if (!$user) {
            return response()->json(['message' => 'Authentication required'], 401);
        }

        $rammemories = RamMemory::all();

        return response()->json([
            'rammemories' => $rammemories,
        ], 200);
    }

    public function storagedevices(Request $request) {
        # Auth Checking
        $token = $request->bearerToken();
        $user = User::where('accessToken', $token)->first();

        if (!$token) {
            return response()->json(['message' => 'Invalid Token'], 403);
        }
        if (!$user) {
            return response()->json(['message' => 'Authentication required'], 401);
        }

        $storagedevices = StorageDevice::all();

        return response()->json($storagedevices, 200);
    }

    # graphiccards
    public function graphiccards(Request $request) {
        # Auth Checking
        $token = $request->bearerToken();
        $user = User::where('accessToken', $token)->first();

        if (!$token) {
            return response()->json(['message' => 'Invalid Token'], 403);
        }
        if (!$user) {
            return response()->json(['message' => 'Authentication required'], 401);
        }

        $graphiccards = GraphicCard::all();

        return response()->json( $graphiccards, 200);
    }

    # machines
    public function machines(Request $request) {
        # Auth Checking
        $token = $request->bearerToken();
        $user = User::where('accessToken', $token)->first();

        if (!$token) {
            return response()->json(['message' => 'Invalid Token'], 403);
        }
        if (!$user) {
            return response()->json(['message' => 'Authentication required'], 401);
        }
        $machines = Machine::all();

        return response()->json( $machines, 200);
    }

    # power supplies
    public function power_supplies(Request $request) {
        # Auth Checking
        $token = $request->bearerToken();
        $user = User::where('accessToken', $token)->first();

        if (!$token) {
            return response()->json(['message' => 'Invalid Token'], 403);
        }
        if (!$user) {
            return response()->json(['message' => 'Authentication required'], 401);
        }
        $power_supplies = PowerSupply::all();

        return response()->json( $power_supplies, 200);
    }

    # brands
    public function brands(Request $request) {
        # Auth Checking
        $token = $request->bearerToken();
        $user = User::where('accessToken', $token)->first();

        if (!$token) {
            return response()->json(['message' => 'Invalid Token'], 403);
        }
        if (!$user) {
            return response()->json(['message' => 'Authentication required'], 401);
        }
        $brands = Brand::all();

        return response()->json($brands, 200);
    }

    # search
    public function search(Request $request) {
        # Auth Checking
        // $token = $request->bearerToken();
        // $user = User::where('accessToken', $token)->first();

        // if (!$token) {
        //     return response()->json(['message' => 'Authentication required'], 401);
        // }
        // if (!$user) {
        //     return response()->json([
        //         'message' => 'Invalid Token', 
        //         // 'token' =>  $token
        //     ], 403);
        // }

        $query = $request->q;
        $category = $request->category;

        $result = 'not found';

        if ($category == 'motherboards') {
            $result = Motherboard::where('name', 'like', "%{$query}%")->get();
        } else if ($category == 'processors') {
            $result = Processor::where('name', 'like', "%{$query}%")->get();
        } else if ($category == 'brands') {
            $result = Brand::where('name', 'like', "%{$query}%")->get();
        } else if ($category == 'power_supplies' || $category == 'powersupplies' ) {
            $result = PowerSupply::where('name', 'like', "%{$query}%")->get();
        } else if ($category == 'rammemories') {
            $result = RamMemory::where('name', 'like', "%{$query}%")->get();
            $result = RamMemory::all();
        } else if ($category == 'storagedevices') {
            $result = StorageDevice::where('name', 'like', "%{$query}%")->get();
        } else if ($category == 'graphiccards') {
            $result = GraphicCard::where('name', 'like', "%{$query}%")->get();
        } else if ($category == 'machina') {
            $result = Machine::where('name', 'like', "%{$query}%")->get();
        }
       
        return response()->json($result, 200);
    }
}